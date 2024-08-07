<?php

namespace App\Repositories;

use App\Interfaces\CourseRepositoryInterface;
use App\Models\Course;
use Illuminate\Support\Facades\Log;

class CourseRepository implements CourseRepositoryInterface
{
    public function getAll()
    {
        return Course::all();
    }

    public function getById($id)
    {
        return Course::findOrFail($id);
    }

    public function store(array $data)
    {
        return Course::create($data);
    }

    public function update(array $data, $id)
    {
        $course = Course::findOrFail($id);
        $course->update($data);
        return $course;
    }

    public function delete($id, bool $force = false)
    {
        $course = Course::findOrFail($id);
        if ($force) {
            $course->forceDelete();
        } else {
            $course->delete();
        }
    }

    public function getAllWithEnrollmentAndCompletionCount()
    {
        $courses = Course::withCount(['enrollments', 'completedEnrollments'])->get();
        Log::info('Courses with counts:', $courses->toArray());

        return $courses;
    }

    public function getAllWithEnrollmentStatusAndLessonProgress($userId)
    {
        return Course::with(['topics' => function($query) {
            $query->withCount('lessons');
        }])
        ->withCount([
            'enrollments as is_enrolled' => function ($query) use ($userId) {
                $query->where('user_id', $userId);
            }
        ])->get()->map(function ($course) {
            $course->is_enrolled = $course->is_enrolled > 0;
            $course->lessons_count = $course->topics->sum('lessons_count');
            return $course;
        });
    }

    public function getCourseWithTopicsAndLessonsCompletionCount($courseId)
    {
        return Course::with(['topics.lessons', 'enrollments.completedLessons'])->findOrFail($courseId);
    }

    public function getCourseWithTopicsAndLessonCompletionStatus($courseId, $userId)
    {
        return Course::with(['topics.lessons' => function ($query) use ($userId) {
            $query->with(['lessonProgress' => function ($query) use ($userId) {
                $query->where('user_id', $userId)->where('status', 'completed');
            }]);
        }])->findOrFail($courseId);
    }
}

