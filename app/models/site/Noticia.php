<?php

namespace app\models\Site;

use app\models\Model;

class Noticia extends Model
{
    public $table = 'tb_noticia';
    protected $sql;

    public function listar()
    {
        $this->sql = "select * from {$this->table}";

        return $this;
    }
}
