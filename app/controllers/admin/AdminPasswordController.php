<?php

namespace app\controllers\admin;

use app\classes\Hash;
use app\classes\Validator;
use app\controllers\ContainerController;
use app\models\admin\Admin;

class AdminPasswordController extends ContainerController {

	public function index() {
	}

	public function show() {

	}

	public function create() {

	}

	public function store() {

	}

	public function edit() {

	}

	/**
	 * @param $request
	 */
	public function update($request) {
		$validate = Validator::validate(function () {
			return Validator::required('password', 'password_confirm')
				->password_confirm()
				->sanitize('password:s');
		});

		if (Validator::failed()) {
			return back();
		}

		$updated = (new Admin)->update([
			'password' => Hash::make($validate->password),
		], ['id' => $request]);

		if ($updated) {
			flash('password_update', success('Senha alterada com sucesso'));
			return back();
		}

		flash('password_update', danger('Erro ao atualizar a senha'));
		back();

	}

	public function destroy() {

	}

}
