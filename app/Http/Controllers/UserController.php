<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request  $request)
    {
        $input = $request->all();

        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ])->validate();

        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make('password'),
            'rol' => 'client'
        ]);


        // Generar el token para el usuario
        $token = $user->createToken('Personal Access Token')->plainTextToken;
        $user->token = $token;
        $user->save();

        // Retornar el usuario y el token
        return  redirect()->back()->with('success', 'Usuario creado correctamente');
    }

    public function generateToken(User $user)
    {
        // Eliminar tokens existentes
        $user->tokens()->delete();

        // Generar un nuevo token
        $token = $user->createToken('Personal Access Token')->plainTextToken;
        $user->token = $token;
        $user->save();


        return redirect()->back()->with('success', 'Token generado correctamente');
    }

    public function deleteToken(User $user)
    {
        // Eliminar todos los tokens del usuario
        $user->tokens()->delete();
        $user->token = "";
        $user->save();

        return  redirect()->back()->with('success', 'Token eliminado correctamente');

    }
}
