<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $category = Category::get()->toArray();

        return response()->json([
            'status' => true,
            'message' => 'Categorías obtenidas exitosamente.',
            'data' => ['category' => $category]
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

        $category = Category::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Categoría creada exitosamente.',
            'data' => $category
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $category = Category::find($id);

        return response()->json([
            'status' => true,
            'message' => 'Categoría obtenida exitosamente.',
            'data' => $category
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

        $category = Category::find($id);
        $category->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Categoría actualizada exitosamente.',
            'data' => $category
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Categoría eliminada exitosamente.',
            'data' => $category
        ]);
    }
}
