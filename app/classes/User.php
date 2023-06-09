<?php

namespace app\classes;

use app\models\Model;

class User
{
    public static function user(Model $model)
    {
        if (isset($_SESSION[$model->logado])) {
            return $model->find('id', $_SESSION[$model->dados]->id);
        }

        return false;
    }
}
