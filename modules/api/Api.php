<?php

namespace app\modules\api;

use app\modules\api\v1\Module as ModuleV1;
use app\modules\api\v2\Module as ModuleV2;

class Api extends \yii\base\Module
{
    public function init()
    {
        parent::init();
        $this->modules = [
            'v1' => [
                'class' => ModuleV1::class,
            ],
            'v2' => [
                'class' => ModuleV2::class,
            ],
        ];
    }
}