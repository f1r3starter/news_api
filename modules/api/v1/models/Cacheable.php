<?php

namespace app\modules\api\v1\models;

interface Cacheable
{
    public static function getTagDependencyLabel(): string;

    public static function getCachePrefix(): string;
}