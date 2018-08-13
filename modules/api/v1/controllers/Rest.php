<?php

namespace app\modules\api\v1\controllers;

use app\modules\api\v1\actions\CacheIndexAction;
use yii\rest\ActiveController;

abstract class Rest extends ActiveController
{
    abstract protected function getModelClass(): string;

    public function actions(): array
    {
        $actions = parent::actions();
        $actions['index'] = [
            'class' => CacheIndexAction::class,
            'modelClass' => $this->getModelClass()
        ];

        return $actions;
    }
}
