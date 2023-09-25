<?php

/**
 * @author      Adres Pranata
 * @email       adrespranata0201@gmail.com
 * @copyright   2023
 */

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $response = [
                'token' => $user->createToken('myApp')->plainTextToken,
                'user' => $user,
                'message'=> 'Login Berhasil'
            ];
            return response()->json($response, 201);
        }

        return response()->json([
            'message' => 'Login gagal',
        ], 401);
    }

}
