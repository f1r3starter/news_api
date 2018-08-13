<?php

namespace app\bootstrap;

use app\events\ClearCacheEvent;
use app\events\EventDispatcher;
use app\forms\PostForm;
use app\listeners\CacheChangeListener;
use app\repositories\CategoryRepositoryInterface;
use app\repositories\CategoryRepositorySql;
use app\repositories\PostRepositoryInterface;
use app\repositories\PostRepositorySql;
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
            'dsn' => 'mysql:host=127.0.0.1;dbname=news_site',
            'username' => 'root',
            'password' => 'zxcvbnm',
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