<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLessonProgressRequest;
use App\Http\Requests\UpdateLessonProgressRequest;
use App\Http\Resources\LessonProgressResource;
use App\Interfaces\LessonProgressRepositoryInterface;
use App\Classes\ApiResponseHelper;

class LessonProgressController extends Controller
{
    private $lessonProgressRepositoryInterface;

    public function __construct(LessonProgressRepositoryInterface $lessonProgressRepositoryInterface)
    {
        $this->lessonProgressRepositoryInterface = $lessonProgressRepositoryInterface;
    }

    public function index()
    {
        $progress = $this->lessonProgressRepositoryInterface->getAll();
        return LessonProgressResource::collection($progress);
    }

    public function store(StoreLessonProgressRequest $request)
    {
        $progress = $this->lessonProgressRepositoryInterface->store($request->validated());
        return new LessonProgressResource($progress);
    }

    public function show($id)
    {
        $progress = $this->lessonProgressRepositoryInterface->getById($id);
        return new LessonProgressResource($progress);
    }

    public function update(UpdateLessonProgressRequest $request, $id)
    {
        $progress = $this->lessonProgressRepositoryInterface->update($request->validated(), $id);
        return new LessonProgressResource($progress);
    }

    public function destroy($id)
    {
        $progress = $this->lessonProgressRepositoryInterface->getById($id);

        // Realiza o soft delete (progresso é um registro transitório e pode ser sempre soft deleted)
        $this->lessonProgressRepositoryInterface->delete($id);

        return ApiResponseHelper::sendResponse(null, 'Progresso da aula removido com sucesso');
    }
}
