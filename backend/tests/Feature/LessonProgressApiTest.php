<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\LessonProgress;

class LessonProgressApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_lesson_progress()
    {
        LessonProgress::factory()->count(3)->create();

        $response = $this->getJson('/api/lesson-progress');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_can_show_lesson_progress()
    {
        $progress = LessonProgress::factory()->create();

        $response = $this->getJson('/api/lesson-progress/' . $progress->id);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $progress->id,
                     'status' => $progress->status,
                 ]);
    }

    public function test_can_create_lesson_progress()
    {
        $data = [
            'lesson_id' => 1, // Certifique-se de que essa lição exista
            'user_id' => 1,   // Certifique-se de que esse usuário exista
            'status' => 'pending',
        ];

        $response = $this->postJson('/api/lesson-progress', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('lesson_progress', $data);
    }

    public function test_can_update_lesson_progress()
    {
        $progress = LessonProgress::factory()->create();
        $data = [
            'status' => 'completed',
        ];

        $response = $this->putJson('/api/lesson-progress/' . $progress->id, $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('lesson_progress', $data);
    }

    public function test_can_delete_lesson_progress()
    {
        $progress = LessonProgress::factory()->create();

        $response = $this->deleteJson('/api/lesson-progress/' . $progress->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('lesson_progress', ['id' => $progress->id]);
    }
}
