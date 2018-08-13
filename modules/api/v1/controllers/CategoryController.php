<?php

namespace app\modules\api\v1\controllers;

use app\models\v1\Categories;

class CategoryController extends Rest
{
    public $modelClass = Categories::class;

    public function getModelClass(): string
    {
        return $this->modelClass;
    }
}
