<?php

namespace app\controllers;

use yii\web\Controller;

class SiteController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => Rest,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}