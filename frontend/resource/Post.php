<?php

namespace frontend\resource;

use common\models\Post as PostModel;
use common\models\query\CommentQuery;
use yii\db\ActiveQuery;

class Post extends PostModel
{
    public function fields(): array
    {
        return ['id', 'title', 'body', 'created_by']; // relationships can be added too
    }

    public function extraFields(): array
    {
        return ['created_at', 'updated_at', 'comments', 'createdBy']; // relationships can be added too
    }

    /**
     * Gets query for [[Comments]].
     *
     * @return ActiveQuery|CommentQuery
     */
    public function getComments(): CommentQuery|ActiveQuery
    {
        return $this->hasMany(Comment::class, ['post_id' => 'id']);
    }

    /**
     * Gets query for [[CreatedBy]].
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }
}