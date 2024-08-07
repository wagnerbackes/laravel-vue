<?php

namespace App\Interfaces;

interface EnrollmentRepositoryInterface
{
    public function getById($id);
    public function delete($id);
    public function getEnrollmentDetailsForCourse($courseId);
    public function isUserEnrolled($courseId, $userId);
    public function batchEnrollOrUnenrollUsers($courseId, $userIds, $action);
    public function enrollUser($courseId, $userId);
}
