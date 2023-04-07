<?php

namespace app\controllers\admin;

use app\classes\Hash;
use app\classes\Validator;
use app\controllers\ContainerController;
use app\models\admin\Admin;
use app\services\admin\AdministradoresService;
use app\services\ListaEBuscaService;

class AdminAdministradorController extends ContainerController
{
    public function index()
    {
        $listaEBusca = new ListaEBuscaService;
        $administradores = $listaEBusca->listar(new Admin, new AdministradoresService);

        $this->view([
            'title' => 'Lista de administradores',
            'administradores' => $administradores,
            'links' => $listaEBusca->links(),
        ], 'admin.painel.administradores');
    }

    public function show()
    {
    }

    public function create()
    {
        $this->view([
            'title' => 'Cadastrar administrador',
        ], 'admin.painel.perfil_create');
    }

    public function store()
    {
        $validate = Validator::validate(function () {
            return Validator::required('name', 'email', 'master', 'password')
                ->email('email')
                ->unique('email', Admin::class)
                ->sanitize('name:s', 'email:s', 'master:s', 'password:s');
        });

        if (Validator::failed()) {
            return back();
        }

        $admin = new Admin;

        $created = $admin->insert([
            'name' => $validate->name,
            'email' => $validate->email,
            'master' => $validate->master,
            'password' => Hash::make($validate->password),
        ]);

        if ($created) {
            flash('admin_store', success('Cadastrado com sucesso'));
            return back();
        }

        flash('admin_store', error('Erro ao cadastrar, tente novamente'));
        back();
    }

    public function edit($id)
    {
    }

    public function update($id)
    {
    }

    public function destroy($id)
    {
        $admin = new Admin;

        $administrador = $admin->find('id', $id)->first();

        deleteFile($administrador->foto);

        $admin->delete('id', $id);

        return back();
    }
}
