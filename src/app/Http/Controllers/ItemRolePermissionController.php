<?php

namespace App\Http\Controllers;

use App\Models\ItemRolePermission;
use Illuminate\Http\Request;

class ItemRolePermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function getByRole(Int $roleId)
    {
        $itemRolePermission = ItemRolePermission::where('role_id', $roleId)->with('item', 'role', 'permission')->get();

        return response()->json([
            'status' => true,
            'message' => 'Permisos de roles obtenidos exitosamente.',
            'data' => ['itemRolePermission' => $itemRolePermission]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
