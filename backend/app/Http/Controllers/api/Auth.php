<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Auth extends Controller
{
    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas.'], 401);
        }

        // Cria um token para o usuário autenticado
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer']);
    }

    public function verify(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Desconectado com sucesso.'], 200);
    }

    // public function verify(Request $request)
    // {
    //     return Jwt::validate();
    // }

    // public function auth(Request $request)
    // {
    //     $user = User::where('email', $request->email)->first();
    //     if(!$user){
    //        return ApiResponseHelper::error('LOGIN: Acesso negado Email: '.$request->email, 'Não autorizado', 401);
    //     }

    //     if(!password_verify($request->password, $user->password)){
    //         return ApiResponseHelper::error('LOGIN: Acesso negado Senha', 'Não autorizado', 401);
    //     }

    //     $token = Jwt::create($user);
    //     return response()->json([
    //         'token'=>$token,
    //         'user' =>[
    //             'name'=> $user->name
    //         ]
    //     ]);
    // }
}
