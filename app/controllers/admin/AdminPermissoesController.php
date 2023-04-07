<?php

namespace app\controllers\admin;

use app\classes\ControllersPermission;
use app\controllers\ContainerController;
use app\models\admin\Admin;
use app\models\admin\Permissions;

class AdminPermissoesController extends ContainerController
{
    public function show($request)
    {
        $dadosUser = (new Admin)->find('id', $request)->first();

        $controllersPermission = new ControllersPermission;
        $controllers = $controllersPermission->permission($request);

        $this->view([
            'title' => 'Lista de permissoes do administrador',
            'admin' => $dadosUser,
            'controllers' => $controllers,
        ], 'admin.painel.permissoes');
    }

    public function create()
    {
    }

    public function store()
    {
    }

    public function edit()
    {
    }

    public function update()
    {
        list($method, $controller, $admin) = explode(',', $_POST['data']);

        $permission = new Permissions;
        $permissaoEncontrada = $permission->findPermission($method, $controller, $admin);

        if (!$permissaoEncontrada) {
            $atualizado = $permission->insert([
                'administrador' => $admin,
                'method' => $method,
                'controller' => $controller,
            ]);
        } else {
            $atualizado = $permission->deletePermission($method, $controller, $admin);
        }

        if ($atualizado) {
            echo 'atualizado';
        }
    }

    public function destroy()
    {
    }
}
