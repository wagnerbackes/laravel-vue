<?php

namespace App\Interfaces;

interface LessonRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id, bool $force = false);
}
