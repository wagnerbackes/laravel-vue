<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description', 'status'];

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Topic::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function completedEnrollments()
    {
        return $this->enrollments()->where('status', 'completed');
    }
}
