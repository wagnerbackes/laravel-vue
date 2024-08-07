<?php

namespace App\Interfaces;

interface CourseRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id, bool $force = false);
    public function getAllWithEnrollmentAndCompletionCount();
    public function getAllWithEnrollmentStatusAndLessonProgress($userId);
    public function getCourseWithTopicsAndLessonsCompletionCount($courseId);
    public function getCourseWithTopicsAndLessonCompletionStatus($courseId, $userId);
}
