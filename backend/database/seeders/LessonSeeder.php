<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topic;
use App\Models\Lesson;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtenha todos os tópicos
        $topics = Topic::all();

        // Para cada tópico, crie entre 1 e 4 lições
        $topics->each(function ($topic) {
            $lessonCount = rand(1, 4); // Gera um número aleatório entre 1 e 4

            Lesson::factory()->count($lessonCount)->create([
                'topic_id' => $topic->id,
            ]);
        });
    }
}
