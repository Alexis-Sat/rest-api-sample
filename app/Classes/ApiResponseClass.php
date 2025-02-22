<?php

namespace App\Classes;

class ApiResponseClass
{

    public static function errorResponse($message = "Error", $code = 400)
    {
       return response()->json(["message" => $message], $code);
    }

    public static function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'success' => true,
            'data' => $result
        ];
        if (!empty($message)) {
            $response['message'] = $message;
        }
        return response()->json($response, $code);
    }

}
