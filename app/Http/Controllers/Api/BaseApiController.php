<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseApiController extends Controller
{
    public function return_success($message, $data): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message'   => $message,
            'validation'=> [],    
            'data'      => $data,
            'code'      => 200
        ], 200);
    }

    public function return_fail($message, $validation): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'message'   => $message,
            'validation'=> $validation,    
            'data'      => [],
            'code'      => 400
        ], 400);
    }
}
