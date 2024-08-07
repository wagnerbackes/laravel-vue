<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnrollmentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'userIds' => 'array',
            'userIds.*' => 'exists:users,id', // Verifica se os IDs de usuários existem
            'action' => 'in:enroll,unenroll', // Define ações válidas
        ];
    }
}
