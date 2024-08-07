<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Interfaces\CourseRepositoryInterface;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    private CourseRepositoryInterface $courseRepositoryInterface;

    public function __construct(CourseRepositoryInterface $courseRepositoryInterface)
    {
        $this->courseRepositoryInterface = $courseRepositoryInterface;
    }

    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'manager') {
            $courses = $this->courseRepositoryInterface->getAllWithEnrollmentAndCompletionCount();
        } elseif ($user->role === 'employee') {
            $courses = $this->courseRepositoryInterface->getAllWithEnrollmentStatusAndLessonProgress($user->id);
        } else {
            $courses = $this->courseRepositoryInterface->getAll();
        }

        return ApiResponseHelper::sendResponse(CourseResource::collection($courses), '', 200);
    }

    public function show(string $id)
    {
        $user = auth()->user();

        try {
            if ($user->role === 'manager') {
                $course = $this->courseRepositoryInterface->getCourseWithTopicsAndLessonsCompletionCount($id);
            } elseif ($user->role === 'employee') {
                $course = $this->courseRepositoryInterface->getCourseWithTopicsAndLessonCompletionStatus($id, $user->id);
            } else {
                $course = $this->courseRepositoryInterface->getById($id);
            }

            return ApiResponseHelper::sendResponse(new CourseResource($course), '', 200);
        } catch (\Exception $e) {
            return ApiResponseHelper::rollback($e, 'Erro ao exibir curso');
        }
    }

    public function store(StoreCourseRequest $request)
    {
        $user = auth()->user();
        if ($user->role !== 'manager') {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $data = $request->validated();

        DB::beginTransaction();
        try {
            $course = $this->courseRepositoryInterface->store($data);
            DB::commit();
            return ApiResponseHelper::sendResponse(new CourseResource($course), 'Curso criado com sucesso', 201);
        } catch (\Exception $e) {
            return ApiResponseHelper::rollback($e, 'Erro ao criar curso');
        }
    }

    public function update(UpdateCourseRequest $request, string $id)
    {
        $user = auth()->user();
        if ($user->role !== 'manager') {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $data = $request->validated();

        DB::beginTransaction();
        try {
            $course = $this->courseRepositoryInterface->update($data, $id);
            DB::commit();
            return ApiResponseHelper::sendResponse(new CourseResource($course), 'Curso atualizado com sucesso', 200);
        } catch (\Exception $e) {
            return ApiResponseHelper::rollback($e, 'Erro ao atualizar curso');
        }
    }

    public function destroy($id)
    {
        $user = auth()->user();
        if ($user->role !== 'manager') {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        DB::beginTransaction();
        try {
            $course = $this->courseRepositoryInterface->getById($id);

            if ($course->enrollments()->count() > 0) {
                $this->courseRepositoryInterface->delete($id);
            } else {
                $this->courseRepositoryInterface->delete($id, true);
            }

            DB::commit();
            return ApiResponseHelper::sendResponse(null, 'Curso removido com sucesso', 200);
        } catch (\Exception $e) {
            return ApiResponseHelper::rollback($e, 'Erro ao remover curso');
        }
    }
}
