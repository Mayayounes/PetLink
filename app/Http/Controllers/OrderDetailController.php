<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        return OrderDetail::with(['order', 'product'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        return OrderDetail::create($validated);
    }

    public function show($id)
    {
        return OrderDetail::with(['order', 'product'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $detail = OrderDetail::findOrFail($id);

        $validated = $request->validate([
            'order_id' => 'sometimes|exists:orders,id',
            'product_id' => 'sometimes|exists:products,id',
            'quantity' => 'sometimes|integer|min:1',
            'price' => 'sometimes|numeric|min:0',
        ]);

        $detail->update($validated);

        return $detail;
    }

    public function destroy($id)
    {
        $detail = OrderDetail::findOrFail($id);
        $detail->delete();

        return response()->json(['message' => 'Order detail deleted']);
    }
}
