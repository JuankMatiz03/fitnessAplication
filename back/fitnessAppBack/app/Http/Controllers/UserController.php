<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{

    public function getUserByNumberDocument($numberDocument)
    {
        try {
            $user = User::where('number_document', $numberDocument)->first();

            if ($user) {
                return response()->json([
                    'status' => 200,
                    'data' => $user,
                    'message' => 'Usuario encontrado correctamente.'
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'No se encontró ningún usuario con el número de documento proporcionado.'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error al buscar el usuario.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $userId)
    {
        $user = User::find($userId);

        if (!$user) {
            return response()->json([
                'error' => 'Usuario no encontrado',
                'status' => '404'
            ], 404);
        }

        $data = $request->all();

        $user->update($data);

        return response()->json([
            'status' => 200,
            'message' => 'Usuario actualizado correctamente',
            'user' => $user
        ]);
    }
}
