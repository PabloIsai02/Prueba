<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);

        $user = \App\Models\User::where('email', $loginData['email'])->first();

        // Verificar si el usuario tiene level_id 2 o 3
        // if (!$user || !in_array($user->level, [2, 3])) {
        //     return response([
        //         'message' => 'Invalid Credentials',
        //         'error' => 'Error',
        //     ]);
        // }


        if (!Hash::check($loginData['password'], $user->password)) {
            return response([
                'message' => 'Invalid Credentials',
                'error' => 'Error',
            ]);
        }

        $accessToken = $user->createToken('authToken')->accessToken;
        return response([
            'profile' => $user,
            'access_token' => $accessToken,
            'message' => 'success',
        ]);
    }

    public function register(Request $request) {
        $registerData = $request->validate([
            'name' => 'required|string',
            'surname' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:10',
            'password' => 'required|string|min:8',
        ]);

        $userController = new UserController();
        $registerData['password'] = bcrypt($registerData['password']);
        $user = $userController->createUser($registerData);

        $accessToken = $user->createToken('authToken')->accessToken;

        return response([
            'profile' => $user,
            'access_token' => $accessToken,
            'message' => 'success',
        ]);
    }
}