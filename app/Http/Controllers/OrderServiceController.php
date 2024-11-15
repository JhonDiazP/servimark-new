<?php

namespace App\Http\Controllers;

use App\Models\OrderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $order_service = OrderService::get()->toArray();
        
        return response()->json([
            'status' => true,
            'message' => 'Detalle de las ordenes obtenidas exitosamente.',
            'data' => ['order_service' => $order_service]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'order_id' => 'required|exists:order,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $order_service = OrderService::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Detalle de las ordenes creada exitosamente.',
            'data' => $order_service
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $order_service = OrderService::find($id);

        return response()->json([
            'status' => true,
            'message' => 'Detalle de la orden obtenida exitosamente.',
            'data' => $order_service
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'order_id' => 'required|exists:order,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $order_service = OrderService::find($id);
        $order_service->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Detalle de la orden actualizada exitosamente.',
            'data' => $order_service
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $order_service = OrderService::find($id);
        $order_service->delete();

        return response()->json([
            'status' => true,
            'message' => 'Detalle de la orden eliminada exitosamente.',
        ]);
    }
}
