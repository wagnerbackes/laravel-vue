<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Course;
use App\Models\Topic;

class TopicApiTest extends TestCase
{
    use RefreshDatabase;

    protected $course;

    protected function setUp(): void
    {
        parent::setUp();
        $this->course = Course::factory()->create(); // Cria um curso de teste
    }

    public function test_can_list_topics()
    {
        Topic::factory()->count(3)->create(['course_id' => $this->course->id]);

        $response = $this->getJson("/api/courses/{$this->course->id}/topics");

        $response->assertStatus(200)
                 ->assertJsonCount(3, 'data');
    }

    public function test_can_show_topic()
    {
        $topic = Topic::factory()->create(['course_id' => $this->course->id]);

        $response = $this->getJson("/api/courses/{$this->course->id}/topics/{$topic->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'id' => $topic->id,
                     'name' => $topic->name,
                 ]);
    }

    public function test_can_create_topic()
    {
        $data = [
            'name' => 'Test Topic',
            'description' => 'Topic description',
        ];

        $response = $this->postJson("/api/courses/{$this->course->id}/topics", $data);

        $response->assertStatus(201)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('topics', array_merge($data, ['course_id' => $this->course->id]));
    }

    public function test_can_update_topic()
    {
        $topic = Topic::factory()->create(['course_id' => $this->course->id]);
        $data = [
            'name' => 'Updated Topic',
            'description' => 'Updated description',
        ];

        $response = $this->putJson("/api/courses/{$this->course->id}/topics/{$topic->id}", $data);

        $response->assertStatus(200)
                 ->assertJsonFragment($data);

        $this->assertDatabaseHas('topics', array_merge($data, ['course_id' => $this->course->id]));
    }

    public function test_can_delete_topic()
    {
        $topic = Topic::factory()->create(['course_id' => $this->course->id]);

        $response = $this->deleteJson("/api/courses/{$this->course->id}/topics/{$topic->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('topics', ['id' => $topic->id]);
    }
}
