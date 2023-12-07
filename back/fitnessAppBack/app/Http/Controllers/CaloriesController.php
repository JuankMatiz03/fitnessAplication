<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CaloriesLog;
use Illuminate\Validation\ValidationException;

class CaloriesController extends Controller
{
    public function addCalories(Request $request)
     {
        try {
            $caloriesLog = CaloriesLog::create([
                'number_document' => $request->input('number_document'),
                'food' => $request->input('food'),
                'amount' => $request->input('amount'),
                'average_calories' => $request->input('average_calories'),
                'time_hour' => $request->input('time_hour'),
                'off_line' => $request->input('off_line'),
            ]);

            return response()->json([
                'status' => 200,
                'response' => 'Registro de calorías exitoso',
                'data' => $caloriesLog,
            ]);
        }catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'response' => 'Error al registrar calorías',
                'error' => $exception->getMessage(),
            ], 500);
        }
    }

    public function getCalories($number_document)
     {
        try {
            $calories = CaloriesLog::where('number_document', $number_document)->get();

            return response()->json([
                'status' => 200,
                'response' => 'Calorías recuperadas exitosamente',
                'data' => $calories,
            ]);
        }catch (\Exception $exception) {
            return response()->json([
                'status' => 500,
                'response' => 'Error al registrar calorías',
                'error' => $exception->getMessage(),
            ], 500);
        }
    }
}
