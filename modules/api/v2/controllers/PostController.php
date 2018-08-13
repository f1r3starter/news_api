<?php

namespace app\modules\api\v2\controllers;

use app\modules\api\v2\forms\PostForm;
use app\modules\api\v2\services\PostService;
use yii\rest\Controller;
use yii\web\Request;

class PostController extends Controller
{
    private $postService;
    private $postForm;
    private $request;
    private static $defaultLimit = 20;

    public function __construct(
        $id,
        $module,
        PostService $postService,
        PostForm $postForm,
        Request $request,
        $config = []
    ) {
        $this->postService = $postService;
        $this->postForm = $postForm;
        $this->request = $request;
        parent::__construct($id, $module, $config = []);
    }


    public function actionIndex()
    {
        $limit = $this->request->get('per-page', self::$defaultLimit);
        $page = $this->request->get('page', 1) - 1; // sorry for magic numbers :)
        return $this->postService->listPosts($page * $limit, $limit);
    }

    public function actionCreate()
    {
        if ($this->postForm->load($this->request->post(), '') && $this->postForm->validate()) {
            $this->postForm->id = $this->postService->addPost($this->postForm);
            return $this->postForm;
        } else {
            return $this->postForm->getErrors();
        }
    }

    public function actionUpdate(int $id)
    {
        if ($this->postForm->load($this->request->post(), '') && $this->postForm->validate()) {
            $this->postForm->id = $this->postService->updatePost($id, $this->postForm);
            return $this->postForm;
        } else {
            return $this->postForm->getErrors();
        }
    }

    public function actionDelete($id)
    {
        $this->postService->deletePost($id);
    }

}
