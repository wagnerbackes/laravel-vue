<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['course_id', 'user_id', 'status', 'enrollment_date', 'completion_date'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function completedLessons()
    {
        return $this->hasManyThrough(
            Lesson::class,
            LessonProgress::class,
            'enrollment_id',
            'id',
            'id',
            'lesson_id'
        )->where('lesson_progress.status', 'completed');
    }
}
