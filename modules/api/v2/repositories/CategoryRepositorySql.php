<?php

namespace app\modules\api\v2\repositories;

use yii\caching\CacheInterface;
use yii\db\Connection;

class CategoryRepositorySql implements CategoryRepositoryInterface
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
            'SELECT * FROM categories WHERE id = :id',
            [':id' => $id]
        )->queryOne();
    }

    public function add(string $name): int
    {
        $this->db->createCommand(
            'INSERT INTO categories (name) VALUES (:name)',
            [':name' => $name]
        )->execute();
        return $this->db->getLastInsertID();
    }

    public function save(int $id, string $name): int
    {
        return $this->db->createCommand(
            'UPDATE categories SET name = :name WHERE id = :id',
            [':name' => $name, 'id' => $id]
        )->queryScalar();
    }

    public function delete(int $id)
    {
        return $this->db->createCommand('DELETE FROM categories WHERE id = :id', [':id' => $id])->execute();
    }

    public function show(int $from, int $limit)
    {
        return $this->db->createCommand('SELECT categories.*, count(posts.id) as posts_count FROM categories LEFT JOIN posts on posts.category_id = categories.id GROUP BY categories.id LIMIT :from, :limit',
            [':from' => $from, ':limit' => $limit])->queryAll();
    }
}