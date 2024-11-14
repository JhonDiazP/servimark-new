<?php

namespace App\Http\Controllers;

use App\Models\Region;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $region = Region::select('departaments.*');

        if(isset($request->country_id)) {
            $region = Region::where('country_id', $request->country_id);
        }

        $region = $region->get();
        
        return response()->json([
            'status' => true,
            'message' => 'Departamentos obtenidas exitosamente.',
            'data' => ['region' => $region]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);

        $region = Region::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Departamento creada exitosamente.',
            'data' => $region
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $region = Region::find($id);

        return response()->json([
            'status' => true,
            'message' => 'Departamento obtenida exitosamente.',
            'data' => $region
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
        ]);

        $region = Region::find($id);
        $region->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Departamento actualizada exitosamente.',
            'data' => $region
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $region = Region::find($id);
        $region->delete();

        return response()->json([
            'status' => true,
            'message' => 'Departamento eliminada exitosamente.',
            'data' => $region
        ]);
    }
}
