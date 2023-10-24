<?php

namespace frontend\controllers;

use frontend\resource\Comment;
use yii\data\ActiveDataProvider;

class CommentController extends ActiveController
{
    public $modelClass = Comment::class;

    public function actions(): array
    {
        $parentActions = parent::actions();

        if (\Yii::$app->request->get('postId')) {
            $parentActions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        }

        return $parentActions;
    }

    public function prepareDataProvider(): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $this->modelClass::find()->andWhere(['post_id' => \Yii::$app->request->get('postId')])
        ]);
    }
}