<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $token = $user->createToken('MyAppToken')->accessToken;

        return response(['user' => $user, 'access_token' => $token]);
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            return response()->json(['error' => 'Неправильний email або пароль'], 401);
        }

        $user = Auth::user();

        // Створення токена
        //$token = Auth::user()->createToken('MyAppToken')->plainTextToken;

        //return response()->json(['user' => $user, 'access_token' => $token]);
    }
}
