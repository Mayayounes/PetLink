<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
  public function index(Request $request)
{
    $query = Product::query();

    // Filter by categories
    if ($request->has('categories')) {
        $query->whereIn('Category', $request->input('categories'));
    }

    // Filter by price_of_single_product
    if ($request->has('price_of_single_product')) {
        $query->where(function ($q) use ($request) {
            foreach ($request->input('price_of_single_product') as $range) {
                switch ($range) {
                    case '<50':
                        $q->orWhere('price_of_single_product', '<', 50);
                        break;
                    case '50-150':
                        $q->orWhereBetween('price_of_single_product', [50, 150]);
                        break;
                    case '151-300':
                        $q->orWhereBetween('price_of_single_product', [151, 300]);
                        break;
                    case '301-700':
                        $q->orWhereBetween('price_of_single_product', [301, 700]);
                        break;
                }
            }
        });
    }

    // Include quantity field in the select to check stock status
    $products = $query->select('*')->get();

    // Return to the view with products
    return view('products.index', compact('products'));
}


    // public function store(Request $request)
    // {
    //     $validated = $request->validate([
    //         'name' => 'required|string',
    //         'price_of_single_product' => 'required|numeric|min:0',
    //         'category' => 'required|string',
    //         'quantity' => 'required|integer|min:0',
    //         'image' => 'nullable|string',
    //     ]);

    //     return Product::create($validated);
    // }

    // public function show($id)
    // {
    //     return Product::with('orderDetails')->findOrFail($id);
    // }

    // public function update(Request $request, $id)
    // {
    //     $product = Product::findOrFail($id);

    //     $validated = $request->validate([
    //         'name' => 'sometimes|string',
    //         'price_of_single_product' => 'sometimes|numeric|min:0',
    //         'category' => 'sometimes|string',
    //         'quantity' => 'sometimes|integer|min:0',
    //         'image' => 'nullable|string',
    //     ]);

    //     $product->update($validated);

    //     return $product;
    // }

    // public function destroy($id)
    // {
    //     $product = Product::findOrFail($id);
    //     $product->delete();

    //     return response()->json(['message' => 'Product deleted']);
    // }
}