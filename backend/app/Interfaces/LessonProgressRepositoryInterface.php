<?php

namespace App\Interfaces;

interface LessonProgressRepositoryInterface
{
    public function getAll();
    public function getById($id);
    public function store(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
