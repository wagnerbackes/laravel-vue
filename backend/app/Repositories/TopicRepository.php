<?php

namespace App\Repositories;

use App\Interfaces\TopicRepositoryInterface;
use App\Models\Topic;

class TopicRepository implements TopicRepositoryInterface
{
    public function getAll()
    {
        return Topic::all();
    }

    public function getById($id)
    {
        return Topic::findOrFail($id);
    }

    public function store(array $data)
    {
        return Topic::create($data);
    }

    public function update(array $data, $id)
    {
        return Topic::whereId($id)->update($data);
    }

    public function delete($id, bool $force = false)
    {
        $topic = $this->getById($id);

        if ($force) {
            return $topic->forceDelete();
        } else {
            return $topic->delete();
        }
    }
}
