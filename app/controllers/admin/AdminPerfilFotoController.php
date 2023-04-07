<?php

namespace app\controllers\admin;

use app\classes\Upload;
use app\classes\User;
use app\controllers\ContainerController;
use app\models\admin\Admin;

class AdminPerfilFotoController extends ContainerController {

	public function index() {
		$teste = 'teste';
	}

	public function show() {

	}

	public function create() {

	}

	public function store() {

		$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

		$admin = new Admin;

		$user = new User;
		$dadosUser = $user->user($admin)->first();

		$foto = $_FILES['file']['name'];
		$temp = $_FILES['file']['tmp_name'];

		$pasta = 'assets/images/admin';

		$upload = new Upload;
		$upload->pasta($pasta);
		$upload->excluir($dadosUser->foto);
		$rename = $upload->rename($foto);
		$upload->uploadFotoUser($temp, $rename);

		$updated = $admin->update([
			'foto' => $pasta . '/' . $rename,
		], ['id' => $dadosUser->id]);

		if ($updated) {
			echo 'upload';
		}

	}

	/**
	 * @param $id
	 */
	public function edit($id) {

	}

	/**
	 * @param $id
	 */
	public function update($id) {

	}

	/**
	 * @param $id
	 */
	public function destroy($id) {

	}

}
