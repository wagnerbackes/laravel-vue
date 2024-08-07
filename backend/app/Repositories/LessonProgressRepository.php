<?php

namespace App\Repositories;

use App\Interfaces\LessonProgressRepositoryInterface;
use App\Models\LessonProgress;

class LessonProgressRepository implements LessonProgressRepositoryInterface
{
    public function getAll()
    {
        return LessonProgress::all();
    }

    public function getById($id)
    {
        return LessonProgress::findOrFail($id);
    }

    public function store(array $data)
    {
        return LessonProgress::create($data);
    }

    public function update(array $data, $id)
    {
        return LessonProgress::whereId($id)->update($data);
    }

    public function delete($id)
    {
        $progress = $this->getById($id);
        return $progress->delete();
    }
}
