<?php

namespace app\controllers\admin;

use app\models\admin\Post;
use app\services\ListaEBuscaService;
use app\controllers\ContainerController;
use app\services\admin\PostService;

class AdminPostsController extends ContainerController
{
    public function index()
    {
        $listaEBusca = new ListaEBuscaService;
        $posts = $listaEBusca->listar(new Post, new PostService);

        $this->view([
            'title' => 'Lista de posts',
            'posts' => $posts,
            'links' => $listaEBusca->links()
        ], 'admin.painel.posts');
    }

    public function show()
    {
    }

    public function create()
    {
        $this->view([
            'title' => 'Cadastrar posts'
        ], 'admin.painel.post_create');
    }

    public function store()
    {
    }

    public function edit($id)
    {
    }

    public function update($id)
    {
    }

    public function destroy($id)
    {
    }
}
