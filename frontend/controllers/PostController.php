<?php

namespace frontend\controllers;

use frontend\resource\Post;

class PostController extends ActiveController
{
    public $modelClass = Post::class;
}