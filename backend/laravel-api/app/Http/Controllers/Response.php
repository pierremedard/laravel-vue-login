<?php

namespace App\Http\Controllers;
use Illuminate\Http\JsonResponse;

trait Response {
    public function returnSuccess($data, $status_code = 200): JsonResponse
    {
        $response = [
            'success'   => true,
            'data'      => $data
        ];
        return response()->json($response, $status_code);
    }

    public function returnError($data, $status_code = 400): JsonResponse
    {
        $response = [
            'success'   => false,
            'data'      => $data
        ];
        return response()->json($response, $status_code);
    }
}