<?php

namespace app\repositories;

interface RepositoryInterface
{
    public function find(int $id);

    public function delete(int $id);

    public function show(int $from, int $limit);
}