<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chama o seeder de usuários
        $this->call(UserSeeder::class);
        // Chama o seeder de cursos
        $this->call(CourseSeeder::class);
        // Chama o seeder de tópicos
        $this->call(TopicSeeder::class);
        // Chama o seeder de lições
        $this->call(LessonSeeder::class);
        // Chama o seeder de inscrições
        $this->call(EnrollmentSeeder::class);
        // Chama o seeder de progresso no curso
        $this->call(LessonProgressSeeder::class);
    }
}
