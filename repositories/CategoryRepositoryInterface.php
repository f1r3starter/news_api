<?php

namespace app\repositories;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function add(string $name): int;

    public function save(int $id, string $name): int;
}