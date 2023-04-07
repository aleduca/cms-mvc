<?php

namespace app\controllers\admin;

use app\classes\User;
use app\classes\Validator;
use app\controllers\ContainerController;
use app\models\admin\Admin;

class AdminPerfilController extends ContainerController {

	public function index() {

	}

	public function show() {

	}

	public function create() {

	}

	public function store() {

	}

	/**
	 * @param $id
	 */
	public function edit() {
		$user = new User;
		$dadosUser = $user->user(new Admin)->first();

		$this->view([
			'title' => 'Perfil do administrador',
			'admin' => $dadosUser,
		], 'admin.painel.perfil');
	}

	/**
	 * @param $id
	 */
	public function update($request) {

		$validate = Validator::validate(function () {
			return Validator::required('name', 'email', 'description')
				->email('email')
				->sanitize('name:s', 'email:s', 'description:s');
		});

		if (Validator::failed()) {
			return back();
		}

		$updated = (new Admin)->update($validate, ['id' => $request]);

		if ($updated) {
			flash('admin_update', success('Atualizado com sucesso'));
			return back();
		}

		flash('admin_update', danger('Erro ao atualizar'));
		back();

	}

	/**
	 * @param $id
	 */
	public function destroy($id) {

	}

}
