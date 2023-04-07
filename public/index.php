<?php

session_start();
ini_set('display_errors', 1);

if (preg_match('/\.(?:png|jpg|jpeg|gif)$/', $_SERVER["REQUEST_URI"])) {
	return false;
} else {

	/**
	 * definir as constantes
	 */
	define("DEFAULT_CONTROLLER", 'home');
	define("ROOT", dirname(__FILE__));

	/**
	 * Carregar o sistema
	 */
	require "../vendor/autoload.php";
	require "../app/functions/helpers.php";
	require "../bootstrap.php";

}