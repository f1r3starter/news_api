<?php

namespace app\services;

use app\events\ClearCacheEvent;
use app\events\EventDispatcher;
use app\forms\CategoryForm;
use app\repositories\CategoryRepositoryInterface;
use yii\caching\CacheInterface;
use yii\caching\TagDependency;

class CategoryService
{
    private $categoryRepository;
    private $eventDispatcher;
    private $cache;

    public static function getCachePrefix(): string
    {
        return 'categories_list_';
    }

    public static function getTagDependencyLabel(): string
    {
        return 'categories_cache';
    }

    public function __construct(CategoryRepositoryInterface $postRepository, EventDispatcher $eventDispatcher, CacheInterface $cache)
    {
        $this->categoryRepository = $postRepository;
        $this->eventDispatcher = $eventDispatcher;
        $this->cache = $cache;
    }

    public function addCategory(CategoryForm $categoryForm)
    {
        $this->eventDispatcher->dispatch(new ClearCacheEvent([self::getTagDependencyLabel()]));
        return $this->categoryRepository->add($categoryForm->name);
    }

    public function updateCategory(int $id, CategoryForm $categoryForm)
    {
        $this->eventDispatcher->dispatch(new ClearCacheEvent([self::getTagDependencyLabel()]));
        return $this->categoryRepository->save($id, $categoryForm->name);
    }

    public function deleteCategory(int $id)
    {
        $this->eventDispatcher->dispatch(new ClearCacheEvent([self::getTagDependencyLabel()]));
        return $this->categoryRepository->delete($id);
    }

    public function listCategories(int $from, int $limit)
    {
        return $this->cache->getOrSet([self::getCachePrefix(), 'from' => $from, 'limit' => $limit], function () use ($from, $limit) {
            return $this->categoryRepository->show($from, $limit);
        }, null, new TagDependency(['tags' => self::getTagDependencyLabel()]));
    }
}