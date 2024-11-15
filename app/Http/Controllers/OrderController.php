<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $order = Order::get()->toArray();
        
        return response()->json([
            'status' => true,
            'message' => 'Transacciones obtenidas exitosamente.',
            'data' => ['order' => $order]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $order = Order::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Transaccion creada exitosamente.',
            'data' => $order
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $order = Order::find($id);

        return response()->json([
            'status' => true,
            'message' => 'Orden obtenida exitosamente.',
            'data' => $order
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $order = Order::find($id);
        $order->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Orden actualizada exitosamente.',
            'data' => $order
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $order = Order::find($id);
        $order->delete();

        return response()->json([
            'status' => true,
            'message' => 'Orden eliminada exitosamente.',
            'data' => $order
        ]);
    }
}
