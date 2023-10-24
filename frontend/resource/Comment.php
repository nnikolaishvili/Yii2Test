<?php

namespace frontend\resource;

use common\models\Comment as CommentModel;
use common\models\query\PostQuery;
use yii\db\ActiveQuery;

class Comment extends CommentModel
{
    public function fields(): array
    {
        return ['id', 'post_id', 'title', 'body'];
    }

    public function extraFields(): array
    {
        return ['created_at', 'updated_at', 'post'];
    }

    /**
     * Gets query for [[Post]].
     * Overriding because we need to fetch related records fields defined within the resources
     *
     * @return ActiveQuery|PostQuery
     */
    public function getPost(): PostQuery|ActiveQuery
    {
        return $this->hasOne(Post::class, ['id' => 'post_id']);
    }
}