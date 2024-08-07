<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Lesson;
use App\Models\Enrollment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Laravel\Sanctum\Sanctum;

class CourseApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_manager_can_view_all_courses_with_enrollment_and_completion_count()
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $courses = Course::factory()->count(5)->create();

        foreach ($courses as $course) {
            Enrollment::factory()->count(10)->create(['course_id' => $course->id, 'status' => 'completed']);
        }

        Sanctum::actingAs($manager);

        $response = $this->getJson('/api/courses');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                             'id',
                             'name',
                             'description',
                             'lessons_count',
                             'enrollments_count',
                             'completed_enrollments_count'
                         ]
                     ]
                 ]);
    }

    public function test_employee_can_view_all_courses_with_lesson_progress_and_enrollment_status()
    {
        $employee = User::factory()->create(['role' => 'employee']);
        $courses = Course::factory()->count(5)->create();

        foreach ($courses as $course) {
            Enrollment::factory()->create(['course_id' => $course->id, 'user_id' => $employee->id]);
        }

        Sanctum::actingAs($employee);

        $response = $this->getJson('/api/courses');

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => [
                             'id',
                             'name',
                             'description',
                             'lessons_count',
                             'is_enrolled'
                         ]
                     ]
                 ]);
    }

    public function test_manager_can_view_specific_course_with_topics_and_lessons_completion_count()
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $course = Course::factory()->create();
        $topics = Topic::factory()->count(3)->create(['course_id' => $course->id]);
        foreach ($topics as $topic) {
            Lesson::factory()->count(5)->create(['topic_id' => $topic->id]);
        }

        Sanctum::actingAs($manager);

        $response = $this->getJson("/api/courses/{$course->id}");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         'id',
                         'name',
                         'description',
                         'topics' => [
                             '*' => [
                                 'id',
                                 'name',
                                 'lessons' => [
                                     '*' => [
                                         'id',
                                         'title'
                                     ]
                                 ]
                             ]
                         ]
                     ]
                 ]);
    }

    public function test_employee_can_view_specific_course_with_topics_and_lesson_completion_status()
    {
        $employee = User::factory()->create(['role' => 'employee']);
        $course = Course::factory()->create();
        $topics = Topic::factory()->count(3)->create(['course_id' => $course->id]);
        foreach ($topics as $topic) {
            $lessons = Lesson::factory()->count(5)->create(['topic_id' => $topic->id]);
            foreach ($lessons as $lesson) {
                $lesson->lessonProgress()->create(['user_id' => $employee->id, 'status' => 'completed']);
            }
        }

        Sanctum::actingAs($employee);

        $response = $this->getJson("/api/courses/{$course->id}");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         'id',
                         'name',
                         'description',
                         'topics' => [
                             '*' => [
                                 'id',
                                 'name',
                                 'lessons' => [
                                     '*' => [
                                         'id',
                                         'title'
                                     ]
                                 ]
                             ]
                         ]
                     ]
                 ]);
    }

    public function test_manager_can_create_course()
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $courseData = [
            'name' => 'New Course',
            'description' => 'Course Description',
            'status' => 'open'
        ];

        Sanctum::actingAs($manager);

        $response = $this->postJson('/api/courses', $courseData);

        $response->assertStatus(201)
                 ->assertJson([
                     'data' => [
                         'name' => 'New Course',
                         'description' => 'Course Description',
                         'status' => 'open'
                     ]
                 ]);
    }

    public function test_manager_can_update_course()
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $course = Course::factory()->create();
        $courseData = [
            'name' => 'Updated Course',
            'description' => 'Updated Description',
            'status' => 'restricted'
        ];

        Sanctum::actingAs($manager);

        $response = $this->putJson("/api/courses/{$course->id}", $courseData);

        $response->assertStatus(200)
                 ->assertJson([
                     'data' => [
                         'name' => 'Updated Course',
                         'description' => 'Updated Description',
                         'status' => 'restricted'
                     ]
                 ]);
    }

    public function test_manager_can_delete_course()
    {
        $manager = User::factory()->create(['role' => 'manager']);
        $course = Course::factory()->create();

        Sanctum::actingAs($manager);

        $response = $this->deleteJson("/api/courses/{$course->id}");

        $response->assertStatus(200)
                 ->assertJson([
                     'message' => 'Curso removido com sucesso'
                 ]);
    }

    public function test_employee_cannot_create_update_or_delete_course()
    {
        $employee = User::factory()->create(['role' => 'employee']);
        $courseData = [
            'name' => 'New Course',
            'description' => 'Course Description',
            'status' => 'open'
        ];

        Sanctum::actingAs($employee);

        $course = Course::factory()->create();

        $this->postJson('/api/courses', $courseData)->assertStatus(403);
        $this->putJson("/api/courses/{$course->id}", $courseData)->assertStatus(403);
        $this->deleteJson("/api/courses/{$course->id}")->assertStatus(403);
    }
}
