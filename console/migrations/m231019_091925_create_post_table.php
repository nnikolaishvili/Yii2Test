<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m231019_091925_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp(): void
    {
        $this->createTable('{{%post}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(512),
            'body' => 'LONGTEXT',
            'created_by' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);

        $this->addForeignKey(
            'fk_post_user_created_by',
            '{{%post}}',
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
        $this->dropForeignKey('fk_post_user_created_by', '{{%post}}');
        $this->dropTable('{{%post}}');
    }
}
