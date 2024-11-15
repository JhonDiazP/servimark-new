<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::select('*', 'first_name as firstname', 'last_name as lastname');

        if (isset($filters['search']) && $filters['search'] != 'null' && !empty($filters['search'])) {
            $search = $filters['search'];
            $users->where(function ($query) use ($search) {
                $query->where('users.firstname', 'like', '%' . $search . '%')
                    ->orWhere('users.lastname', 'like', '%' . $search . '%')
                    ->orWhere('users.email', 'like', '%' . $search . '%');
            });
        }

        $users = $users->paginate(10);

        return response()->json([
            'message' => 'Usuarios obtenidos exitosamente.',
            'data' => ['users' => $users]
        ], 200);
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
        $user = User::with('roles', 'municipality.departament')->find($id);

        return response()->json([
            'message' => 'Usuario obtenido exitosamente.',
            'data' => ['user' => $user]
        ], 200);
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
        $user = User::find($id);

        $user->identification_type_id = $request->get('identification_type_id');
        $user->identification = $request->get('identification');
        $user->first_name = $request->get('first_name');
        $user->middle_first_name = $request->get('middle_first_name');
        $user->last_name = $request->get('last_name');
        $user->middle_last_name = $request->get('middle_last_name');
        $user->phone = $request->get('phone');
        $user->municipality_id = $request->get('municipality_id');
        $user->email = $request->get('email');
        $user->gender_id = $request->get('gender_id');

        $user->save();

        return response()->json([
            'message' => 'Usuario actualizado exitosamente.',
            'data' => ['user' => $user]
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        $user->user_status_id = 2;

        $user->save();

        return response()->json([
            'message' => 'Usuario eliminado exitosamente.',
            'data' => ['user' => $user]
        ], 200);
    }

    public function enable(string $id): JsonResponse
    {
        $user = User::find($id);

        $user->user_status_id = 1;

        $user->save();

        return response()->json([
            'message' => 'Usuario habilitado exitosamente.',
            'data' => ['user' => $user]
        ], 200);
    }

    public function getRoles(): JsonResponse
    {
        $role = Role::all();

        return response()->json([
            'message' => 'Roles obtenidos exitosamente.',
            'data' => ['roles' => $role]
        ], 200);
    }
}
