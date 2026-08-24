<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
{
    $orders = [
        [
            'id' => 1,
            'customer_id' => 10,
            'status' => 'pending',
        ],
        [
            'id' => 2,
            'customer_id' => 20,
            'status' => 'completed',
        ],
    ];

    return response()->json($orders, 200);
}

public function show(int $id)
{
    $order = [
        'id' => $id,
        'customer_id' => 10,
        'status' => 'pending',
    ];

    return response()->json($order, 200);
}

public function store(Request $request)
{
    $validated = $request->validate([
        'customer_id' => ['required', 'integer'],
        'quantity' => ['required', 'integer', 'min:1'],
    ]);

    $order = [
        'id' => 3,
        'customer_id' => $validated['customer_id'],
        'quantity' => $validated['quantity'],
        'status' => 'pending',
    ];

    return response()->json($order, 201);
}
}
