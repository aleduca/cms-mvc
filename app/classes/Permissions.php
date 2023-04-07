<?php

namespace app\classes;

use app\models\admin\Permissions as PermissionModel;

class Permissions
{
    private $methodsTodie = [
        'store', 'update', 'destroy',
    ];

    private $controller;
    private $method;
    private $user;

    public function permission()
    {
        $this->user = getAdmin();

        if ($this->user->master == 1) {
            return;
        }

        $this->controllerAndMethod();

        $this->block();
    }

    private function controllerAndMethod()
    {
        $url = Url::getUrl();

        if (substr_count($url, '/') > 1) {
            list($controller, $method) = array_values(array_filter(explode('/', $url)));
        } else {
            $controller = $url;
            $method = 'index';
        }

        $controller = ltrim($controller, '/');
        if (strstr($controller, 'admin') and $controller != 'AdminController') {
            $controller = substr($controller, strlen('admin'), strlen($controller));
        }

        $this->controller = ucfirst($controller) . 'Controller';
        $this->method = $method;
    }

    private function block()
    {
        $permission = new PermissionModel;
        $permissaoEncontrada = $permission->findPermission($this->method, $this->controller, $this->user->id);

        if (!$permissaoEncontrada and $this->controller != 'AdminController') {
            if (in_array($this->method, $this->methodsTodie)) {
                dd('sem permissao');
            }

            return redirect('painel');
        }
    }

    public static function execute()
    {
        return (new static )->permission();
    }
}
