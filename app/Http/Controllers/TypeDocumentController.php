<?php

namespace App\Http\Controllers;

use App\Models\TypeDocument;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TypeDocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $document = TypeDocument::get()->toArray();

        return response()->json([
            'status' => true,
            'message' => 'Documentos obtenidos exitosamente.',
            'data' => ['document' => $document]
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

        $document = TypeDocument::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Documento creado exitosamente.',
            'data' => $document
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $document = TypeDocument::find($id);

        return response()->json([
            'status' => true,
            'message' => 'Documento obtenido exitosamente.',
            'data' => $document
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

        $document = TypeDocument::find($id);
        $document->update($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Documento actualizado exitosamente.',
            'data' => $document
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        $document = TypeDocument::find($id);
        $document->delete();

        return response()->json([
            'status' => true,
            'message' => 'Documento eliminado exitosamente.',
            'data' => $document
        ]);
    }
}
