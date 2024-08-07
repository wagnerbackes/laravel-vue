<?php

namespace Database\Factories;

use App\Models\Topic;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

class TopicFactory extends Factory
{
    protected $model = Topic::class;

    public function definition()
    {
        return [
            'course_id' => Course::factory(),
            'name' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
        ];
    }
}
