<?php

namespace App\Repositories;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    private $model;

    public function __construct(Task $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model::all();
    }

    public function allWithStatus(int $status)
    {
        return $this->model::where('status', $status)->orderBy('updated_at', 'desc')->get();
    }

    public function findById(int $id)
    {
        return $this->model::where('id', $id)->first();
    }

    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->model::where('id', $id)->update($data);
    }

    public function delete(int $id)
    {
        return $this->model::where('id', $id)->delete();
    }

    public function search(string $term)
    {
        return $this->model::where('name', 'like', '%' . $term . '%')
            ->where('status', 3)
            ->orWhere('updated_at', 'like', '%' . $term . '%')
            ->get();
    }
}

