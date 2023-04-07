<?php

namespace app\controllers\admin;

use app\controllers\ContainerController;

class PainelController extends ContainerController
{
    public function index()
    {
        $this->view([
            'title' => 'Painel administrativo',
        ], 'admin.painel.painel');
    }

    public function show()
    {
    }

    public function create()
    {
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
