<?php

namespace app\modules\api\v2\repositories;

use yii\caching\CacheInterface;
use yii\db\Connection;

class PostRepositorySql implements PostRepositoryInterface
{
    private $cache;
    private $db;

    public function __construct(CacheInterface $cache, Connection $db)
    {
        $this->cache = $cache;
        $this->db = $db;
    }

    public function find(int $id)
    {
        return $this->db->createCommand(
            'SELECT * FROM posts WHERE id = :id',
            [':id' => $id]
        )->queryOne();
    }

    public function add(string $title, string $content, int $categoryId): int
    {
        $this->db->createCommand(
            'INSERT INTO posts (title, content, category_id) VALUES (:title, :content, :category_id)',
            [':title' => $title, ':content' => $content, ':category_id' => $categoryId]
        )->execute();
        return $this->db->getLastInsertID();
    }

    public function save(int $id, string $title, string $content, int $categoryId): int
    {
        return $this->db->createCommand(
            'UPDATE posts SET title = :title, content = :content, category_id = :category_id WHERE id = :id',
            [':title' => $title, ':content' => $content, ':category_id' => $categoryId, 'id' => $id]
        )->queryScalar();
    }

    public function delete(int $id)
    {
        return $this->db->createCommand('DELETE FROM posts WHERE id = :id', [':id' => $id])->execute();
    }

    public function show(int $from, int $limit)
    {
        return $this->db->createCommand('SELECT * FROM posts LIMIT :from, :limit',
            [':from' => $from, ':limit' => $limit])->queryAll();
    }
}