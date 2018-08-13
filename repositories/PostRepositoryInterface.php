<?php

namespace app\repositories;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function add(string $title, string $content, int $categoryId): int;

    public function save(int $id, string $title, string $content, int $categoryId): int;
}