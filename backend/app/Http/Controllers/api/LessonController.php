<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Http\Resources\LessonResource;
use App\Interfaces\LessonRepositoryInterface;
use App\Classes\ApiResponseHelper;

class LessonController extends Controller
{
    private $lessonRepositoryInterface;

    public function __construct(LessonRepositoryInterface $lessonRepositoryInterface)
    {
        $this->lessonRepositoryInterface = $lessonRepositoryInterface;
    }

    public function index()
    {
        $lessons = $this->lessonRepositoryInterface->getAll();
        return LessonResource::collection($lessons);
    }

    public function store(StoreLessonRequest $request)
    {
        $lesson = $this->lessonRepositoryInterface->store($request->validated());
        return new LessonResource($lesson);
    }

    public function show($id)
    {
        $lesson = $this->lessonRepositoryInterface->getById($id);
        return new LessonResource($lesson);
    }

    public function update(UpdateLessonRequest $request, $id)
    {
        $lesson = $this->lessonRepositoryInterface->update($request->validated(), $id);
        return new LessonResource($lesson);
    }

    public function destroy($id)
    {
        $lesson = $this->lessonRepositoryInterface->getById($id);

        if ($lesson->progress()->count() > 0) {
            // Realiza o soft delete
            $this->lessonRepositoryInterface->delete($id);
        } else {
            // Realiza o hard delete
            $this->lessonRepositoryInterface->delete($id, true);
        }

        return ApiResponseHelper::sendResponse(null, 'Aula removida com sucesso');
    }
}
