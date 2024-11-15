<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Logs;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use JWTAuth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;

class AuthController extends Controller
{

    protected $guard;
    //
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);//login, register methods won't go through the api guard
        $this->guard = "api";
    }
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth($this->guard)->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request->email)
            ->select('id')
            ->get()->first();

        return $this->respondWithToken($token, $user->id);
    }

    public function register(UserRequest $request): JsonResponse
    {
        $request->validated();

        DB::beginTransaction();
            $user = User::create([
                'id' => Uuid::generate()->string,
                'user_status_id' => 1,
                'identification_type_id' => $request->get('identification_type_id'),
                'identification' => $request->get('identification'),
                'first_name' => $request->get('first_name'),
                'middle_first_name' => $request->get('middle_first_name'),
                'last_name' => $request->get('last_name'),
                'middle_last_name' => $request->get('middle_last_name'),
                'username' => $request->get('email'),
                'phone' => $request->get('phone'),
                'municipality_id' => $request->get('municipality_id'),
                'email' => $request->get('email'),
                'gender_id' => $request->get('gender_id'),
                'password' => Hash::make($request->get('password')),
            ]);

            if($request->has('roles')){
                $roles = $request->get('roles');

                foreach ($roles as $role) {
                    UserRole::create([
                        'user_id' => $user->id,
                        'role_id' => $role,
                    ]);
                }
            }else{
                UserRole::create([
                    'user_id' => $user->id,
                    'role_id' => 2,
                ]);
            }
            
        DB::commit();
        
        $token = JWTAuth::fromUser($user);

        return response()->json([
            'status' => true,
            'message' => 'Usuario registrado exitosamente',
            'user' => $user,
            'token' => $token,
        ], 200);
    }

    public function getaccount()
    {
        return response()->json(auth()->user());
    }


    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }
    protected function respondWithToken($token, $user_id)
    {
        return response()->json([
            'access_token' => $token,
            'user_id' => $user_id,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60 //mention the guard name inside the auth fn
        ]);
    }
}