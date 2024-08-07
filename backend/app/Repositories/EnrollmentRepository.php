<?php

namespace App\Repositories;

use App\Interfaces\EnrollmentRepositoryInterface;
use App\Models\Enrollment;

class EnrollmentRepository implements EnrollmentRepositoryInterface
{
    public function getEnrollmentDetailsForCourse($courseId)
    {
        // Retorna todos os registros de inscrições para um curso, incluindo informações de progresso
        return Enrollment::with(['user', 'course'])
            ->where('course_id', $courseId)
            ->get();
    }

    public function isUserEnrolled($courseId, $userId)
    {
        // Verifica se um usuário está inscrito em um curso específico
        return Enrollment::where('course_id', $courseId)
            ->where('user_id', $userId)
            ->exists();
    }

    public function batchEnrollOrUnenrollUsers($courseId, $userIds, $action)
    {
        if ($action === 'enroll') {
            // Inscrever usuários
            foreach ($userIds as $userId) {
                if (!$this->isUserEnrolled($courseId, $userId)) {
                    Enrollment::create([
                        'course_id' => $courseId,
                        'user_id' => $userId,
                        'status' => 'enrolled',
                        'enrollment_date' => now(),
                    ]);
                }
            }
        } elseif ($action === 'unenroll') {
            // Desinscrever usuários
            Enrollment::where('course_id', $courseId)
                ->whereIn('user_id', $userIds)
                ->delete();
        }
    }

    public function enrollUser($courseId, $userId)
    {
        // Inscrever um usuário em um curso
        return Enrollment::create([
            'course_id' => $courseId,
            'user_id' => $userId,
            'status' => 'enrolled',
            'enrollment_date' => now(),
        ]);
    }

    public function delete($id)
    {
        // Remover uma inscrição
        $enrollment = Enrollment::find($id);
        if ($enrollment) {
            $enrollment->delete(); // Soft delete
        }
    }

    public function getById($id)
    {
        // Buscar uma inscrição por ID
        return Enrollment::findOrFail($id);
    }
}

