<?php

namespace app\classes;

class Flash {

	// verificar se existe a sessao existe
	// se nao existir cria ela

	public static function add($index, $message) {
		if (!isset($_SESSION[$index])) {
			$_SESSION[$index] = $message;
		}
	}

	public static function get($index) {
		if (isset($_SESSION[$index])) {
			$message = $_SESSION[$index];
		}

		unset($_SESSION[$index]);

		return $message ?? '';
	}

}