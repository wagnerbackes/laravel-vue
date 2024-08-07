<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\User;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obter todos os funcionários
        $employees = User::where('role', 'employee')->get();
        // Obter todos os cursos
        $courses = Course::all();

        // Para cada funcionário, inscrever em um número aleatório de cursos entre 0 a 10
        $employees->each(function ($employee) use ($courses) {
            // Escolher um número aleatório de cursos entre 0 a 10
            $randomCourses = $courses->random(rand(0, 10));

            // Inscrever o funcionário nos cursos escolhidos
            $randomCourses->each(function ($course) use ($employee) {
                Enrollment::create([
                    'course_id' => $course->id,
                    'user_id' => $employee->id,
                    'status' => 'enrolled', // Status inicial de inscrição
                ]);
            });
        });
    }
}
