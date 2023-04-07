<?php

namespace app\classes;

use app\classes\Hash;
use app\models\Model;

class Login {

	/**
	 * @param $email
	 * @param $password
	 * @param Model       $model
	 */
	public function logar($email, $password, Model $model) {

		$dados = $model->find('email', $email)->first();

		if (!$dados) {
			return false;
		}

		if (Hash::checkPassword($password, $dados->password)) {

			$_SESSION[$model->logado] = true;
			$_SESSION[$model->dados] = $dados;

			session_regenerate_id();

			return true;
		}

		return false;

	}

	/**
	 * @param Model $model
	 */
	public static function logout(Model $model) {
		session_destroy();

		return redirect($model->redirect);

	}

}