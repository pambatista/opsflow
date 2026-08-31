<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();

        return response()->json($orders, 200);
    }

    public function show(int $id)
    {
        // $order = Order::find($id);

        // if (!$order) {
        //     return response()->json(['message' => 'Order not found'], 404);
        // }

        // $order = Order::findOrFail($id);

        $order = Order::with('customer')->findOrFail($id);

        return response()->json($order, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $order = Order::create([
            'customer_id' => $validated['customer_id'],
            'quantity' => $validated['quantity'],
            'status' => 'pending',
        ]);

        return response()->json($order, 201);
    }

    public function update(Request $request, int $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'quantity' => ['sometimes', 'integer', 'min:1'],
            'status' => ['sometimes', 'string', 'in:pending,completed,cancelled'],
        ]);

        $order->update($validated);

        return response()->json($order, 200);
    }

    public function destroy(int $id)
    {
        $order = Order::findOrFail($id);

        $order->delete();

        return response()->noContent();
    }
}
