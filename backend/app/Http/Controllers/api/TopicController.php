<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Http\Resources\TopicResource;
use App\Interfaces\TopicRepositoryInterface;
use App\Models\Course;
use App\Classes\ApiResponseHelper;

class TopicController extends Controller
{
    private $topicRepositoryInterface;

    public function __construct(TopicRepositoryInterface $topicRepositoryInterface)
    {
        $this->topicRepositoryInterface = $topicRepositoryInterface;
    }

    public function index(Course $course)
    {
        $topics = $course->topics;
        return TopicResource::collection($topics);
    }

    public function store(StoreTopicRequest $request, Course $course)
    {
        $data = array_merge($request->validated(), ['course_id' => $course->id]);
        $topic = $this->topicRepositoryInterface->store($data);
        return new TopicResource($topic);
    }

    public function show(Course $course, $id)
    {
        $topic = $course->topics()->findOrFail($id);
        return new TopicResource($topic);
    }

    public function update(UpdateTopicRequest $request, $courseId, $id)
    {
        $course = Course::findOrFail($courseId);
        $topic = $course->topics()->findOrFail($id);
        $updatedTopic = $this->topicRepositoryInterface->update($request->validated(), $id);
        return new TopicResource($topic->refresh());
    }


    public function destroy(Course $course, $id)
    {
        $topic = $course->topics()->findOrFail($id);

        if ($topic->lessons()->count() > 0) {
            // Realiza o soft delete
            $this->topicRepositoryInterface->delete($id);
        } else {
            // Realiza o hard delete
            $this->topicRepositoryInterface->delete($id, true);
        }

        return ApiResponseHelper::sendResponse(null, 'Tópico removido com sucesso');
    }
}
