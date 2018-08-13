<?php

namespace app\forms;

use app\repositories\CategoryRepositorySql;
use yii\base\Model;

class PostForm extends Model
{

    public $id;
    public $category_id;
    public $title;
    public $content;
    private $categoryRepository;

    public function __construct(CategoryRepositorySql $categoryRepository, array $config = [])
    {
        $this->categoryRepository = $categoryRepository;
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['category_id'], 'required'],
            [['category_id'], 'integer'],
            [['title', 'content'], 'string', 'max' => 255],
            [['category_id'], function ($attribute) {
                if (!$this->categoryRepository->find($this->$attribute)) {
                    $this->addError($attribute, 'Category ID is invalid.');
                }
            }],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'category_id' => 'Category ID',
        ];
    }
}