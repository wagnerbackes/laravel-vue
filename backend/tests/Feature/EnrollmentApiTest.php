<?php
namespace Tests\Feature;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EnrollmentApiTest extends TestCase
{
    use RefreshDatabase;

    protected $manager;
    protected $employee;
    protected $course;

    protected function setUp(): void
    {
        parent::setUp();

        // Cria um usuário manager e um employee
        $this->manager = User::factory()->create(['role' => 'manager']);
        $this->employee = User::factory()->create(['role' => 'employee']);
        $this->course = Course::factory()->create();
    }

    /** @test */
    public function manager_can_list_enrollments()
    {
        Enrollment::factory()->create([
            'course_id' => $this->course->id,
            'user_id' => $this->employee->id,
        ]);

        $response = $this->actingAs($this->manager)->getJson("/api/courses/{$this->course->id}/enrollments");

        $response->assertStatus(200)
                 ->assertJsonStructure([
                     'data' => [
                         '*' => ['id', 'course_id', 'user_id', 'status', 'user']
                     ]
                 ]);
    }

    /** @test */
    public function employee_can_check_if_enrolled()
    {
        Enrollment::factory()->create([
            'course_id' => $this->course->id,
            'user_id' => $this->employee->id,
        ]);

        $response = $this->actingAs($this->employee)->getJson("/api/courses/{$this->course->id}/enrollments");

        $response->assertStatus(200)
                 ->assertJson(['data' => ['isEnrolled' => true]]);
    }

    /** @test */
    public function manager_can_enroll_users_in_bulk()
    {
        $users = User::factory(3)->create(['role' => 'employee']);

        $userIds = $users->pluck('id')->toArray();
        $response = $this->actingAs($this->manager)->postJson("/api/courses/{$this->course->id}/enrollments", [
            'userIds' => $userIds,
            'action' => 'enroll',
        ]);

        $response->assertStatus(200);
        foreach ($users as $user) {
            $this->assertDatabaseHas('enrollments', [
                'course_id' => $this->course->id,
                'user_id' => $user->id,
            ]);
        }
    }

    /** @test */
    public function employee_cannot_enroll_other_users()
    {
        $users = User::factory(3)->create(['role' => 'employee']);

        $userIds = $users->pluck('id')->toArray();
        $response = $this->actingAs($this->employee)->postJson("/api/courses/{$this->course->id}/enrollments", [
            'userIds' => $userIds,
            'action' => 'enroll',
        ]);

        $response->assertStatus(403);
        foreach ($users as $user) {
            $this->assertDatabaseMissing('enrollments', [
                'course_id' => $this->course->id,
                'user_id' => $user->id,
            ]);
        }
    }

    /** @test */
    public function employee_can_enroll_self()
    {
        $response = $this->actingAs($this->employee)->postJson("/api/courses/{$this->course->id}/enrollments");

        $response->assertStatus(201);
        $this->assertDatabaseHas('enrollments', [
            'course_id' => $this->course->id,
            'user_id' => $this->employee->id,
        ]);
    }

    /** @test */
    public function employee_cannot_enroll_in_course_twice()
    {
        Enrollment::factory()->create([
            'course_id' => $this->course->id,
            'user_id' => $this->employee->id,
        ]);

        $response = $this->actingAs($this->employee)->postJson("/api/courses/{$this->course->id}/enrollments");

        $response->assertStatus(400);
        $response->assertJson(['message' => 'Usuário já está inscrito']);
    }

    /** @test */
    public function manager_can_delete_enrollment()
    {
        $enrollment = Enrollment::factory()->create([
            'course_id' => $this->course->id,
            'user_id' => $this->manager->id,
        ]);

        $response = $this->actingAs($this->manager)->deleteJson("/api/courses/{$this->course->id}/enrollments/{$enrollment->id}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('enrollments', ['id' => $enrollment->id]);
    }

    /** @test */
    public function employee_can_delete_own_enrollment()
    {
        $enrollment = Enrollment::factory()->create([
            'course_id' => $this->course->id,
            'user_id' => $this->employee->id,
        ]);

        $response = $this->actingAs($this->employee)->deleteJson("/api/courses/{$this->course->id}/enrollments/{$enrollment->id}");

        $response->assertStatus(200);
        $this->assertSoftDeleted('enrollments', ['id' => $enrollment->id]);
    }

    /** @test */
    public function employee_cannot_delete_other_users_enrollment()
    {
        $anotherEmployee = User::factory()->create(['role' => 'employee']);
        $enrollment = Enrollment::factory()->create([
            'course_id' => $this->course->id,
            'user_id' => $anotherEmployee->id,
        ]);

        $response = $this->actingAs($this->employee)->deleteJson("/api/courses/{$this->course->id}/enrollments/{$enrollment->id}");

        $response->assertStatus(403);
        $this->assertDatabaseHas('enrollments', ['id' => $enrollment->id]);
    }
}
