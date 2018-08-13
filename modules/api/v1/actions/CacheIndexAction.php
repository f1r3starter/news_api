<?php

namespace app\modules\api\v1\actions;

use app\modules\api\v1\models\Cacheable;
use yii\caching\TagDependency;
use yii\data\ActiveDataProvider;
use yii\rest\IndexAction;
use Yii;

class CacheIndexAction extends IndexAction
{
    /**
     * @var $modelClass Cacheable
     */
    public $modelClass;

    protected function prepareDataProvider(): ActiveDataProvider
    {
        return Yii::$app->cache->getOrSet(
            [
                $this->modelClass::getCachePrefix(),
                'request' => Yii::$app->getRequest()->getBodyParams()
            ],
            function () {
                return parent::prepareDataProvider();
            },
            null,
            new TagDependency(['tags' => $this->modelClass::getTagDependencyLabel()])
        );
    }
}
