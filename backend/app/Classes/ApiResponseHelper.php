<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Exceptions\HttpResponseException;

class ApiResponseHelper
{
    /**
     * Realiza um rollback na transação atual, registra o erro nos logs e lança uma exceção HTTP com uma mensagem de erro.
     *
     * @param \Exception $e A exceção que causou a falha.
     * @param string $message A mensagem de erro a ser retornada na resposta HTTP.
     */
    public static function rollback($e, $message = 'Falha de processamento')
    {
        DB::rollBack();
        Log::error('Rollback executed: ' . $message, ['exception' => $e]);
        self::throw($e, $message);
    }

    /**
     * Registra uma exceção nos logs e lança uma exceção HTTP com uma mensagem de erro.
     *
     * @param \Exception $e A exceção que causou a falha.
     * @param string $message A mensagem de erro a ser retornada na resposta HTTP.
     */
    public static function throw($e, $message = 'Falha de processamento')
    {
        Log::error('Exception thrown: ' . $message, ['exception' => $e]);
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $message
        ], 500));
    }

    /**
     * Registra um erro nos logs e lança uma exceção HTTP com uma mensagem de erro.
     *
     * @param \Exception|string $e A exceção ou mensagem de erro que causou a falha.
     * @param string $message A mensagem de erro a ser retornada na resposta HTTP.
     * @param int $code O código de status HTTP da resposta.
     */
    public static function error($e, $message = 'Falha de processamento', $code = 404)
    {
        Log::error('Error: ' . $message, ['error' => $e]);
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $message
        ], $code));
    }

    /**
     * Envia uma resposta HTTP JSON com os dados e uma mensagem opcional.
     *
     * @param mixed $result Os dados a serem incluídos na resposta.
     * @param string $message Uma mensagem opcional a ser incluída na resposta.
     * @param int $code O código de status HTTP da resposta.
     * @return \Illuminate\Http\JsonResponse A resposta HTTP JSON.
     */
    public static function sendResponse($result, $message = '', $code = 200)
    {
        if ($code === 204) {
            Log::info('Response with no content sent.');
            return response()->noContent();
        }

        $response = [
            'success' => true,
            'data' => $result
        ];

        if (!empty($message)) {
            $response['message'] = $message;
        }

        Log::info('Response sent.', ['response' => $response]);

        return response()->json($response, $code);
    }
}
