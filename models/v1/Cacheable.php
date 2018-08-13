<?php

namespace app\models\v1;

interface Cacheable {
    public static function getTagDependencyLabel(): string;

    public static function getCachePrefix(): string;
}