<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLessonProgressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lesson_id' => 'required|exists:lessons,id',
            'user_id' => 'required|exists:users,id',
            'status' => 'required|in:pending,completed',
            'completion_date' => 'nullable|date',
        ];
    }
}
