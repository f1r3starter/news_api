<?php

use yii\db\Migration;

/**
 * Handles the creation of table `posts`.
 */
class m180811_130148_create_posts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('posts', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull()->defaultValue(''),
            'content' => $this->string()->notNull()->defaultValue(''),
            'category_id' => $this->integer()->notNull()
        ]);
        $this->addForeignKey('post_category_fk', 'posts', 'category_id', 'categories', 'id', 'RESTRICT', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('posts');
    }
}
