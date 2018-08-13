<?php

namespace app\modules\api\v1\controllers;

use app\modules\api\v1\models\Categories;

class CategoryController extends Rest
{
    public $modelClass = Categories::class;

    public function getModelClass(): string
    {
        return $this->modelClass;
    }
}
