<?php

namespace App\Http\Controllers;

use App\Models\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user_service = UserService::get()->toArray();

        return response()->json([
            'status' => true,
            'message' => 'Detalle de los usuarios obtenidos exitosamente.',
            'data' => ['user_service' => $user_service]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $user_service = UserService::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Detalle de los usuarios creada exitosamente.',
            'data' => $user_service
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $user_service = UserService::find($id);

        return response()->json([
            'status' => true,
            'message' => 'Detalle del usuario obtenido exitosamente.',
            'data' => $user_service
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'service_id' => 'required|exists:services,id',
        ]);

        $user_service = UserService::find($id);
        $user_service->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Detalle del usuario actualizado exitosamente.',
            'data' => $user_service
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $user_service = UserService::find($id);
        $user_service->delete();

        return response()->json([
            'status' => true,
            'message' => 'Detalle del usuario eliminado exitosamente.'
        ]);
    }
}
