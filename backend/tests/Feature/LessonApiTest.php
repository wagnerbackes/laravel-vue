<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Lesson;

class LessonApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_lessons()
    {
        Lesson::factory()->count(3)->create();

        $response = $this->getJson('/api/lessons');

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_can_show_lesson()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->getJson('/api/lessons/' . $lesson->id);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $lesson->id,
                     'title' => $lesson->title,
                 ]);
    }

    public function test_can_create_lesson()
    {
        $data = [
            'topic_id' => 1, // Certifique-se de que esse tópico exista
            'title' => 'Test Lesson',
            'content' => 'Lesson content',
        ];

        $response = $this->postJson('/api/lessons', $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('lessons', $data);
    }

    public function test_can_update_lesson()
    {
        $lesson = Lesson::factory()->create();
        $data = [
            'title' => 'Updated Lesson',
            'content' => 'Updated content',
        ];

        $response = $this->putJson('/api/lessons/' . $lesson->id, $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('lessons', $data);
    }

    public function test_can_delete_lesson()
    {
        $lesson = Lesson::factory()->create();

        $response = $this->deleteJson('/api/lessons/' . $lesson->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('lessons', ['id' => $lesson->id]);
    }
}
