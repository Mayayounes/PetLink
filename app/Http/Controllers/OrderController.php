<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            // If product already exists in cart, update quantity
            $cart[$request->product_id]['quantity'] += $request->quantity;
        } else {
            // Add new product to cart
            $cart[$request->product_id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price_of_single_product,
                'quantity' => $request->quantity,
                'category' => $product->category
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'cart_count' => $this->getCartItemCount()
        ]);
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('products.cart', compact('cart', 'total'));
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);
        
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully!'
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$request->product_id])) {
            unset($cart[$request->product_id]);
            session()->put('cart', $cart);
        }

        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart!'
        ]);
    }

    public function clearCart()
    {
        session()->forget('cart');
        
        return response()->json([
            'success' => true,
            'message' => 'Cart cleared successfully!'
        ]);
    }

    public function getCartCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return response()->json(['count' => $count]);
    }

    private function getCartItemCount()
    {
        $cart = session()->get('cart', []);
        $count = 0;
        
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return $count;
    }

    public function showCheckout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('products.checkout', compact('cart', 'total'));
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'zip' => 'required|string|max:20'
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Your cart is empty.']);
            }
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Check if user is authenticated
        if (!auth()->check()) {
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Please login to place an order.']);
            }
            return redirect()->route('login')->with('error', 'Please login to place an order.');
        }

        try {
            DB::beginTransaction();

            // Check product availability and calculate totals
            $total = 0;
            $totalQuantity = 0;
            $productUpdates = [];

            foreach ($cart as $productId => $item) {
                $product = Product::findOrFail($productId);
                
                // Check if enough quantity is available
                if ($product->quantity < $item['quantity']) {
                    DB::rollBack();
                    $message = "Sorry, only {$product->quantity} units of {$product->name} are available.";
                    if ($request->expectsJson()) {
                        return response()->json(['success' => false, 'message' => $message]);
                    }
                    return redirect()->back()->with('error', $message);
                }

                $total += $item['price'] * $item['quantity'];
                $totalQuantity += $item['quantity'];
                
                // Prepare product quantity updates
                $productUpdates[] = [
                    'product' => $product,
                    'new_quantity' => $product->quantity - $item['quantity']
                ];
            }

            // Create the order
            $order = Order::create([
                'user_id' => auth()->id(),
                'date' => now(),
                'total_price' => number_format($total, 2, '.', ''),
                'total_quantity' => $totalQuantity,
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'zip_code' => $request->input('zip'),
            ]);

            // Create order details and update product quantities
            foreach ($cart as $productId => $item) {
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }

            // Update product quantities
            foreach ($productUpdates as $update) {
                $update['product']->update(['quantity' => $update['new_quantity']]);
            }

            // Clear the cart
            session()->forget('cart');

            DB::commit();

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true, 
                    'message' => 'Order placed successfully!',
                    'order_id' => $order->id
                ]);
            }

            return redirect()->route('orders.success')->with('success', 'Order placed successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            
            if ($request->expectsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to place order. Please try again.']);
            }
            
            return redirect()->back()->with('error', 'Failed to place order. Please try again.');
        }
    }

    public function orderSuccess()
    {
        return view('orders.success');
    }
}