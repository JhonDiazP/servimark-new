<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $review = Review::get()->toArray();
        
        return response()->json([
            'status' => true,
            'message' => 'Calificaciones obtenidas exitosamente.',
            'data' => ['review' => $review]
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
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $review = Review::create($request->all());
        
        return response()->json([
            'status' => true,
            'message' => 'Calificaciones creadas exitosamente.',
            'data' => $review
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $review = Review::find($id);

        return response()->json([
            'status' => true,
            'message' => 'Calificación obtenida exitosamente.',
            'data' => $review
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
            'rating' => 'required|numeric|min:1|max:5',
        ]);

        $review = Review::find($id);
        $review->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Calificación actualizada exitosamente.',
            'data' => $review
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $review = Review::find($id);
        $review->delete();

        return response()->json([
            'status' => true,
            'message' => 'Calificación eliminada exitosamente.',
            'data' => $review
        ]);
    }
}
