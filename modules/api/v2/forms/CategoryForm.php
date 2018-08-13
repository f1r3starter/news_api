<?php

namespace app\modules\api\v2\forms;

use yii\base\Model;

class CategoryForm extends Model
{
    public $id;
    public $name;

    public function rules(): array
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }
}