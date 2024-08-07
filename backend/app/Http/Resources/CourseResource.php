<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CourseResource extends JsonResource
{
    public function toArray($request)
    {
        $user = $request->user();

        $array = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        if ($user->role === 'manager') {
            $array['topics'] = TopicResource::collection($this->topics);
            $array['lessons_count'] = $this->lessons()->count();
            $array['enrollments_count'] = $this->enrollments()->count();
            $array['completed_enrollments_count'] = $this->completedEnrollments()->count();
        } elseif ($user->role === 'employee') {
            $array['is_enrolled'] = $this->is_enrolled;
            $array['lessons_count'] = $this->lessons_count;
            $array['topics'] = TopicResource::collection($this->topics->load(['lessons' => function ($query) use ($user) {
                $query->with(['lessonProgress' => function ($query) use ($user) {
                    $query->where('user_id', $user->id)->where('status', 'completed');
                }]);
            }]));
        }

        return $array;
    }
}
