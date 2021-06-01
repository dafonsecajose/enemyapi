<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ResponseApi
{

    public function coreResponse($message, $data = null, $statusCode = null, $isSucess = true): JsonResponse
    {
        //Checar os parametros
        if (!$message) {
            return response()->json(['message' => 'Message is required'], 500);
        }

        //enviar mensagem
        if ($isSucess) {
            return response()->json([
                'message' => $message,
                'error' => false,
                'code' => $statusCode,
                'results' => $data
            ], $statusCode);
        } else {
            return response()->json([
                'message' => $message,
                'error' => true,
                'code' => $statusCode
            ], $statusCode);
        }
    }

    public function success($message, $data, $statusCode = 200)
    {
        return $this->coreResponse($message, $data, $statusCode);
    }

    public function error($message, $statusCode = 500)
    {
        return $this->coreResponse($message, null, $statusCode, false);
    }
}
