<?php

namespace common\models;

use common\models\query\CommentQuery;
use common\models\Comment;
use common\models\query\PostQuery;
use common\models\User;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;

/**
 * This is the model class for table "{{%post}}".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $body
 * @property int|null $created_by
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Comment[] $comments
 * @property User $createdBy
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return '{{%post}}';
    }

    public function behaviors(): array
    {
        return [
            TimestampBehavior::class,//automatically manage crated_at,updated_at.
            [
                'class' => BlameableBehavior::class,
                'updatedByAttribute' => false,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'body'], 'required'],
            [['title', 'body'], 'string'],
            [['created_by', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 512],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
     *
     * @return ActiveQuery|\app\common\models\query\UserQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::class, ['id' => 'created_by']);
    }

    /**
     * {@inheritdoc}
     * @return PostQuery the active query used by this AR class.
     */
    public static function find(): PostQuery
    {
        return new PostQuery(get_called_class());
    }
}
