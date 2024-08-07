<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEnrollmentRequest;
use App\Http\Resources\EnrollmentResource;
use App\Interfaces\EnrollmentRepositoryInterface;
use App\Classes\ApiResponseHelper;

class EnrollmentController extends Controller
{
    private $enrollmentRepositoryInterface;

    public function __construct(EnrollmentRepositoryInterface $enrollmentRepositoryInterface)
    {
        $this->enrollmentRepositoryInterface = $enrollmentRepositoryInterface;
    }

    public function index(string $courseId)
    {
        $user = auth()->user();

        if ($user->role === 'manager') {
            // Lista todas as inscrições para o curso especificado, incluindo detalhes do usuário
            $enrollments = EnrollmentResource::collection($this->enrollmentRepositoryInterface->getEnrollmentDetailsForCourse($courseId));
            return ApiResponseHelper::sendResponse($enrollments, '', 200);
        } elseif ($user->role === 'employee') {
            // Verifica se o usuário está inscrito no curso
            $isEnrolled = $this->enrollmentRepositoryInterface->isUserEnrolled($courseId, $user->id);
            return ApiResponseHelper::sendResponse(['isEnrolled' => $isEnrolled], '', 200);
        }

        return ApiResponseHelper::sendResponse(null, 'Não autorizado', 403);
    }


    public function store(StoreEnrollmentRequest $request, string $courseId)
    {
        $user = auth()->user();

        if ($user->role === 'manager') {
            // Inscrever ou remover usuários em lote
            $this->enrollmentRepositoryInterface->batchEnrollOrUnenrollUsers($courseId, $request->userIds, $request->action);
            return ApiResponseHelper::sendResponse(null, 'Ações ' . $request->action . ' realizadas com sucesso', 200);
        } elseif ($user->role === 'employee' && empty($request->userIds)) {
            // Inscrever o próprio usuário autenticado no curso
            $isEnrolled = $this->enrollmentRepositoryInterface->isUserEnrolled($courseId, $user->id);
            if ($isEnrolled) {
                return ApiResponseHelper::sendResponse(null, 'Usuário já está inscrito', 400);
            }

            $this->enrollmentRepositoryInterface->enrollUser($courseId, $user->id);
            return ApiResponseHelper::sendResponse(null, 'Usuário inscrito com sucesso', 201);
        }

        return ApiResponseHelper::sendResponse(null, 'Não autorizado', 403);
    }


    public function destroy($courseId, $enrollmentId)
    {
        $user = auth()->user();
        $enrollment = $this->enrollmentRepositoryInterface->getById($enrollmentId);

        if (!$enrollment) {
            return ApiResponseHelper::sendResponse(null, 'Inscrição não encontrada', 404);
        }

        if ($user->role === 'manager' || ($user->role === 'employee' && $enrollment->user_id == $user->id)) {
            $this->enrollmentRepositoryInterface->delete($enrollmentId);
            return ApiResponseHelper::sendResponse(null, 'Inscrição removida com sucesso', 200);
        }

        return ApiResponseHelper::sendResponse(null, 'Não autorizado', 403);
    }

}
