<?php

namespace app\bootstrap;

use app\modules\api\v2\events\ClearCacheEvent;
use app\modules\api\v2\events\EventDispatcher;
use app\modules\api\v2\forms\PostForm;
use app\modules\api\v2\listeners\CacheChangeListener;
use app\modules\api\v2\repositories\CategoryRepositoryInterface;
use app\modules\api\v2\repositories\CategoryRepositorySql;
use app\modules\api\v2\repositories\PostRepositoryInterface;
use app\modules\api\v2\repositories\PostRepositorySql;
use yii\base\BootstrapInterface;
use Yii;
use yii\caching\CacheInterface;
use yii\caching\FileCache;
use yii\caching\TagDependency;
use yii\db\Connection;
use yii\web\Request;

class Bootstrap implements BootstrapInterface
{
    /**
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        $container = Yii::$container;

        $container->setSingleton(Connection::class, [
            'dsn' => 'mysql:host=db;dbname=yii',
            'username' => 'root',
            'password' => 'secretpass',
            'charset' => 'utf8',
        ]);

        $container->setSingleton(CacheInterface::class, FileCache::class);
        $container->setSingleton(CategoryRepositoryInterface::class, CategoryRepositorySql::class);
        $container->setSingleton(PostRepositoryInterface::class, PostRepositorySql::class);
        $container->setSingleton(Request::class);
        $container->setSingleton(TagDependency::class);
        $container->setSingleton(PostForm::class);

        $container->setSingleton(EventDispatcher::class, function () {
            $dispatcher = new EventDispatcher();
            $dispatcher->on(ClearCacheEvent::class, [\Yii::createObject(CacheChangeListener::class), 'handle']);
            return $dispatcher;
        });
    }
}