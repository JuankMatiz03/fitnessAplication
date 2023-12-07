<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Validation\ValidationException;

use App\Models\User;

class RegisterController extends Controller
{

    public function getProfiles()
    {
        $profiles = User::all();

        return response()->json([
            'status' => 200,
            'data' => $profiles,
        ]);
    }

    public function createUser(Request $request)
     {
        try {

            $user = User::create([
                'number_document' => $request->input('number_document'),
                'first_name' => $request->input('first_name'),
                'second_name' => $request->input('second_name'),
                'last_name' => $request->input('last_name'),
                'type_document' => $request->input('type_document'),
                'gender' => $request->input('gender'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'photo_id_front' => $request->input('photo_id_front'),
                'photo_id_back' => $request->input('photo_id_back'),
                'photo_profile' => $request->input('photo_profile'),
                'password' => Hash::make($request->input('password'))
            ]);

            $user->save();

            return response()->json([
                'status' => 200,
                'response' => '¡Usario creado exitosamente!'
            ]);
        }catch (ValidationException $exception) {
            return response()->json([
                'status' => 422,
                'response' => 'Error de validación',
                'error' => $exception->errors(),
            ], 422);
        } catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'response' => 'Error al insertar datos en la base de datos',
                'error' => $exception->getMessage(),
            ], 500);
        }

    }
}
