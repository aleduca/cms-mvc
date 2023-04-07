<?php

namespace app\traits;

use app\classes\Flash;

trait Validate {

	/**
	 * @var mixed
	 */
	private static $error = false;

	/**
	 * @param $fields
	 */
	public static function required(...$fields) {
		foreach ($fields as $field) {
			if (empty($_POST[$field]) and $_POST[$field] != '0') {
				Flash::add($field, danger("Esse campo é obrigatório"));
				static::$error = true;
			}
		}

		return new Static;
	}

	/**
	 * @param $fields
	 */
	public static function email(...$fields) {
		foreach ($fields as $field) {
			if (!filter_input(INPUT_POST, $field, FILTER_VALIDATE_EMAIL)) {
				Flash::add($field, danger("Esse campo tem que ter um email valido"));
				static::$error = true;
			}
		}

		return new Static;
	}

	public static function password_confirm() {

		$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
		$password_confirm = filter_input(INPUT_POST, 'password_confirm', FILTER_SANITIZE_STRING);

		if (!isset($password_confirm)) {
			throw new \Exception("O campo password_confirm é obrigatório");
		}

		if ($password != $password_confirm) {
			Flash::add('confirm', danger("As senhas tem que ser iguais"));
			static::$error = true;
		}

		return new Static;

	}

	/**
	 * @param $field
	 * @param $model
	 */
	public static function unique($field, $model) {

		$modelToValidate = new $model();
		$register = $modelToValidate->find($field, $_POST[$field])->first();

		if ($register) {
			Flash::add($field, danger("Esse campo ja tem um registro cadastrado com esse valor"));
			static::$error = true;
		}

		return new Static;
	}

	public static function failed() {
		return static::$error;
	}

}
