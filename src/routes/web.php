<?php

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});
 
Route::get('/google-auth/callback', function () {
    $user = Socialite::driver('google')->user();
    
    $firstname = $user->user['given_name'];

    $lastname = $user->user['family_name'];

    DB::beginTransaction();

    $user =  User::firstOrCreate([
        'email' => $user->getEmail()
    ], [
        'id' => $user->getId(),
        'user_status_id' => 1,
        'first_name' => $firstname,
        'last_name' => $lastname,
        'username' => $user->getEmail(),
        'email' => $user->getEmail(),
    ]);

    auth()->login($user, true);

    UserRole::firstOrCreate([
        'user_id' => $user->id,
        'role_id' => 2
    ]);

    DB::commit();

    return $user;
});

Route::get('/', function () {
    return view('welcome');
});
