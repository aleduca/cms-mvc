<?php

namespace app\controllers\admin;

use app\classes\Flash;
use app\classes\Login;
use app\classes\Redirect;
use app\controllers\ContainerController;
use app\models\admin\Admin;

class AdminController extends ContainerController {

	public function index() {

		$this->view([
			'title' => 'Login do Administrador',
		], 'admin.login');
	}

	public function store() {

		$email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
		$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);

		$logado = logar($email, $password, new Admin);

		if ($logado) {
			return Redirect::to('painel');
		}

		Flash::add('login', 'Usuário ou senha inválidos');
		return Redirect::back();

	}

	public function destroy() {

		Login::logout(new Admin);

	}

}