<?php

namespace app\modules\api\v2\controllers;

use app\modules\api\v2\services\CategoryService;
use yii\rest\Controller;
use yii\web\Request;

class CategoryController extends Controller
{
    private $categoryService;
    private $request;
    private static $defaultLimit = 20;

    public function __construct($id, $module, CategoryService $categoryService, Request $request, $config = [])
    {
        $this->categoryService = $categoryService;
        $this->request = $request;
        parent::__construct($id, $module, $config = []);
    }


    public function actionIndex()
    {
        $limit = $this->request->get('per-page', self::$defaultLimit);
        $page = $this->request->get('page', 1) - 1; // sorry for magic numbers :)
        return $this->categoryService->listCategories($page * $limit, $limit);
    }

}
