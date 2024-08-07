<?php
namespace App\Classes;

use App\Models\User;
use Firebase\JWT\JWT as JWTFirebase;
use Firebase\JWT\Key;

class Jwt
{
    public static function validate()
    {
        $authorization = $_SERVER['HTTP_AUTHORIZATION'];
        $key = $_ENV['JWT_KEY'];
        $token = str_replace('Bearer ', '', $authorization);
        try {
           $decoded = JWTFirebase::decode($token, new Key($key, 'HS256'));
           return response()->json($decoded, 200);
        } catch (\Throwable $th) {
           return response()->json($th->getMessage(), 401);
        }

    }

    public static function create(User $data)
    {
        $key = $_ENV['JWT_KEY'];

        $payLoad = [
            'exp'=>time() + 1800,
            'iat'=>time(),
            'data'=>$data
        ];

        return JWTFirebase::encode($payLoad, $key, 'HS256');
    }

}
