<?php

namespace frontend\resource;

use common\models\User as UserModel;

class User extends UserModel
{
    public function fields(): array
    {
        return ['id', 'username', 'email'];
    }
}