<?php
// StoreUserRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Apenas o usuário autenticado pode atualizar seu próprio perfil
        $user = $this->route('user'); // Obtém o usuário da rota, se estiver disponível

        // Verifica se o usuário autenticado é o mesmo que está sendo atualizado
        if ($user && $user->id !== Auth::id()) {
            return false; // Bloqueia se não for o mesmo usuário
        }

        return true; // Permite se for o mesmo usuário
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->route('user')->id,
            'password' => 'required|string|min:3|confirmed',
            'role' => 'nullable|in:manager,employee',
        ];
    }
}

