<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('number_document', 'password');

        try {
            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => 200,
                    'response' => 'Login correcto',
                ]);
            } else {
                return response()->json([
                    'status' => 401,
                    'response' => 'Credenciales inválidas',
                ]);
            }
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'response' => 'Error al realizar el Login',
                'error' => $exception->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        return response()->json([
            'status' => 200,
            'response' => 'Logout exitoso'
        ]);
    }
}
