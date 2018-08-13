<?php

namespace app\modules\api\v2\listeners;

use app\modules\api\v2\events\ClearCacheEvent;
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