<?php

namespace app\services;

use app\events\ClearCacheEvent;
use app\events\EventDispatcher;
use app\forms\PostForm;
use app\repositories\PostRepositoryInterface;
use yii\caching\CacheInterface;
use yii\caching\TagDependency;

class PostService
{
    private $postRepository;
    private $eventDispatcher;
    private $tagDependency;
    private $cache;

    public static function getCachePrefix(): string
    {
        return 'posts_list_';
    }

    public static function getTagDependencyLabel(): string
    {
        return 'posts_cache';
    }

    public function __construct(PostRepositoryInterface $postRepository, EventDispatcher $eventDispatcher, TagDependency $tagDependency, CacheInterface $cache)
    {
        $this->postRepository = $postRepository;
        $this->eventDispatcher = $eventDispatcher;
        $this->tagDependency = $tagDependency;
        $this->cache = $cache;
    }

    public function addPost(PostForm $postForm)
    {
        $this->eventDispatcher->dispatch(new ClearCacheEvent([self::getTagDependencyLabel(), CategoryService::getTagDependencyLabel()]));
        return $this->postRepository->add($postForm->title, $postForm->content, $postForm->category_id);
    }

    public function updatePost(int $id, PostForm $postForm)
    {
        $this->eventDispatcher->dispatch(new ClearCacheEvent([self::getTagDependencyLabel(), CategoryService::getTagDependencyLabel()]));
        return $this->postRepository->save($id, $postForm->title, $postForm->content, $postForm->category_id);
    }

    public function deletePost(int $id)
    {
        $this->eventDispatcher->dispatch(new ClearCacheEvent([self::getTagDependencyLabel(), CategoryService::getTagDependencyLabel()]));
        return $this->postRepository->delete($id);
    }

    public function listPosts(int $from, int $limit)
    {
        return $this->cache->getOrSet([self::getCachePrefix(), 'from' => $from, 'limit' => $limit], function() use ($from, $limit) {
            return $this->postRepository->show($from, $limit);
        }, null, new TagDependency(['tags' => self::getTagDependencyLabel()]));
    }
}