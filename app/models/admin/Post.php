<?php

namespace app\models\admin;

use app\models\Model;

class Post extends Model
{
    protected $table = 'posts';

    public function listar()
    {
        $this->sql = "select posts.id as idPost,administrador.id as idAdmin,title,administrador.name as adminName,posts.slug,categoria.name as nameCategoria, categoria.id as idcategoria from {$this->table}
        inner join administrador on posts.user = administrador.id
        inner join categoria on posts.categoria = categoria.id
        order by posts.id DESC";

        return $this;
    }

    public function buscar()
    {
        $this->sql = "select posts.id as idPost,administrador.id as idAdmin,title,administrador.name as adminName,foto,posts.slug,categoria.name as nameCategoria, categoria.id as idcategoria,posts.created_at as postCreated from {$this->table}
        inner join administrador on posts.user = administrador.id
        inner join categoria on posts.categoria = categoria.id
        where posts.title like :title or post like :post or administrador.name like :name or administrador.email like :email";

        $busca = search('s');

        $this->binds = [
            'title' => '%' . $busca . '%',
            'post' => '%' . $busca . '%',
            'name' => '%' . $busca . '%',
            'email' => '%' . $busca . '%',
        ];

        $this->busca = true;

        return $this;
    }
}
