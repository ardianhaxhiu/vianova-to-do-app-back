<?php

namespace App\Repositories\Interfaces;


interface TaskRepositoryInterface
{
    public function all();

    public function allWithStatus(int $status);

    public function findById(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id);

    public function search(string $term);
}
