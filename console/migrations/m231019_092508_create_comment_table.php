<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%comment}}`.
 */
class m231019_092508_create_comment_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'post_id' => $this->integer(),
            'title' => $this->string(512),
            'body' => $this->text(),
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_comment_post_post_id',
            '{{%comment}}',
            'post_id',
            'post',
            'id'
        );

        $this->addForeignKey(
            'fk_comment_user_created_by',
            '{{%comment}}',
            'created_by',
            'user',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown(): void
    {
        $this->dropForeignKey('fk_comment_user_created_by', '{{%comment}}');
        $this->dropForeignKey('fk_comment_post_post_id', '{{%comment}}');

        $this->dropTable('{{%comment}}');
    }
}
