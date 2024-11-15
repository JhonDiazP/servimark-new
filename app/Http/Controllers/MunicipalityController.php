<?php

namespace App\Http\Controllers;

use App\Models\Municipality;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class MunicipalityController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $municipality = Municipality::select('municipalities.*');

        if(isset($request->region_id)) {
            $municipality = Municipality::where('departament_id', $request->region_id);
        }

        $municipality = $municipality->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Ciudades obtenidas exitosamente.',
            'data' => ['municipality' => $municipality]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'region_id' => 'required|exists:regions,id',
        ]);

        $municipality = Municipality::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Ciudad creada exitosamente.',
            'data' => $municipality
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $municipality = Municipality::find($id);

        return response()->json([
            'status' => true,
            'message' => 'Ciudad obtenida exitosamente.',
            'data' => $municipality
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'region_id' => 'required|exists:regions,id',
        ]);

        $municipality = Municipality::find($id);
        $municipality->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Ciudad actualizada exitosamente.',
            'data' => $municipality
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $municipality = Municipality::find($id);
        $municipality->delete();

        return response()->json([
            'status' => true,
            'message' => 'Ciudad eliminada exitosamente.',
            'data' => $municipality
        ]);
    }
}
