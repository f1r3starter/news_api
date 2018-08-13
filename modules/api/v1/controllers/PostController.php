<?php

namespace app\modules\api\v1\controllers;

use app\modules\api\v1\models\Posts;

class PostController extends Rest
{
    public $modelClass = Posts::class;

    public function getModelClass(): string
    {
        return $this->modelClass;
    }
}
