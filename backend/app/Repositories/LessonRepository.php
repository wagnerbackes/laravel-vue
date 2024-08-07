<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'topic_id',
        'title',
        'content',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function completedBy()
    {
        return $this->belongsToMany(User::class, 'lesson_progress')
            ->withPivot('status')
            ->wherePivot('status', 'completed');
    }
}
