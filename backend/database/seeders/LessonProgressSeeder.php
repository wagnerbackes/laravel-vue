<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LessonProgress;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;

class LessonProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obter todos os funcionários
        $employees = User::where('role', 'employee')->get();

        // Para cada funcionário, completar lições de cursos onde estão inscritos de forma randômica
        $employees->each(function ($employee) {
            // Obter todos os cursos em que o funcionário está inscrito
            $enrollments = Enrollment::where('user_id', $employee->id)
                                     ->where('status', 'enrolled')
                                     ->get();

            $enrollments->each(function ($enrollment) use ($employee) {
                $course = Course::with('topics.lessons')
                                ->find($enrollment->course_id);

                $courseCompleted = true;

                $course->topics->each(function ($topic) use ($employee, &$courseCompleted) {
                    $topic->lessons->each(function ($lesson) use ($employee, &$courseCompleted) {
                        $lessonCompleted = (bool) rand(0, 1); // Aleatoriamente decidir se a lição foi completada

                        LessonProgress::create([
                            'lesson_id' => $lesson->id,
                            'user_id' => $employee->id,
                            'status' => $lessonCompleted ? 'completed' : 'pending',
                            'completion_date' => $lessonCompleted ? now() : null,
                        ]);

                        if (!$lessonCompleted) {
                            $courseCompleted = false;
                        }
                    });
                });

                // Se todas as lições do curso foram concluídas, atualizar o status do curso para 'completed'
                if ($courseCompleted) {
                    $enrollment->update(['status' => 'completed']);
                }
            });
        });

        // Selecionar funcionários aleatórios para concluir todas as lições de cursos aleatórios
        $employees->random(10)->each(function ($employee) {
            // Selecionar cursos aleatórios dos cursos em que o funcionário está inscrito
            $enrollments = Enrollment::where('user_id', $employee->id)
                                     ->where('status', 'enrolled')
                                     ->inRandomOrder()
                                     ->take(4)
                                     ->get();

            $enrollments->each(function ($enrollment) use ($employee) {
                $course = Course::with('topics.lessons')
                                ->find($enrollment->course_id);

                $course->topics->each(function ($topic) use ($employee) {
                    $topic->lessons->each(function ($lesson) use ($employee) {
                        LessonProgress::updateOrCreate(
                            [
                                'lesson_id' => $lesson->id,
                                'user_id' => $employee->id,
                            ],
                            [
                                'status' => 'completed',
                                'completion_date' => now(),
                            ]
                        );
                    });
                });

                // Atualizar o status do curso para 'completed' para o funcionário
                $enrollment->update(['status' => 'completed']);
            });
        });
    }
}
