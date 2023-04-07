<?php

namespace app\classes;

class Hash {

	/**
	 * @param $password
	 */
	public static function make($password) {
		$options = [
			'cost' => 11,
		];
		return password_hash($password, PASSWORD_DEFAULT, $options);
	}

	/**
	 * @param $inputSenha
	 * @param $senhaEncriptada
	 */
	public static function checkPassword($inputSenha, $senhaEncriptada) {
		return password_verify($inputSenha, $senhaEncriptada);
	}

}