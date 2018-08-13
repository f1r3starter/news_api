<?php

namespace app\events;

use yii\base\Event;

class ClearCacheEvent extends Event {
    private $cacheTags;

    public function __construct(array $cacheTags, array $config = [])
    {
        $this->cacheTags = $cacheTags;
        parent::__construct($config);
    }

    public function getCacheTags()
    {
        return $this->cacheTags;
    }
}