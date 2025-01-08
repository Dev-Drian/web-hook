<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

Route::get('/', function () {
    return redirect('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {

        $users = User::where('rol', 'client')->get();
        $numUsuarios = $users->count();
        $numUsuariosPremium = User::where('is_premium', true)->count();
        $u = UserDetail::get();
        $numRequests = $u->sum('canti_request');
        return view('dashboard', compact('users', 'numUsuarios', 'numUsuariosPremium', 'numRequests'));
    })->name('dashboard');



    Route::get('/register-user', function (Request $request) {
        $users = User::where('rol', 'client')->with('tokens')->get();
        return view('user.crete', compact('users'));
    })->name('register.user');

    Route::post('/register-user', [UserController::class, 'store'])->name('user.store');


    Route::post('/generate-token/{user}', [UserController::class, 'generateToken'])->name('generate.token');
    Route::delete('/delete-token/{user}', [UserController::class, 'deleteToken'])->name('delete.token');
});
