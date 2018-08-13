<?php

namespace app\modules\api\v1\models;

use Yii;
use yii\caching\TagDependency;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 *
 * @property Posts[] $posts
 */
class Categories extends \yii\db\ActiveRecord implements Cacheable
{
    public static function getCachePrefix(): string
    {
        return 'categories_list_';
    }

    public static function getTagDependencyLabel(): string
    {
        return 'categories_cache';
    }

    public static function tableName(): string
    {
        return 'categories';
    }

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

    public function fields(): array
    {
        return [
            'id' => 'id',
            'name' => 'name',
            'posts_count' => function (Categories $model): int {
                return (int)$model->getPosts()->count();
            }
        ];
    }

    public function getPosts(): ActiveQuery
    {
        return $this->hasMany(Posts::class, ['category_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        TagDependency::invalidate(Yii::$app->cache, self::getTagDependencyLabel());
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        TagDependency::invalidate(Yii::$app->cache, self::getTagDependencyLabel());
        parent::afterDelete();
    }
}
