<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {

        $users = User::get();
        return view('dashboard', compact('users'));
    })->name('dashboard');



    Route::post('/register-user', function (Request $request) {

        $input = $request->all();

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make('password'),
            'rol' => 'client',
        ]);

        // Generar el token para el usuario
        $token  = $user->createToken('Personal Access Token')->accessToken;

        // Retornar el usuario y el token
        return [
            'user' => $user,
            'token' => $token,
        ];
    })->name('token');
});
