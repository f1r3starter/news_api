<?php

namespace app\listeners;

use app\events\ClearCacheEvent;
use yii\caching\CacheInterface;
use yii\caching\TagDependency;

class CacheChangeListener
{
    private $cache;
    private $tagDependency;

    public function __construct(CacheInterface $cache, TagDependency $tagDependency)
    {
        $this->cache = $cache;
        $this->tagDependency = $tagDependency;
    }

    public function handle(ClearCacheEvent $event)
    {
        $this->tagDependency->invalidate($this->cache, $event->getCacheTags());
    }
}