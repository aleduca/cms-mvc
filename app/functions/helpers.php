<?php

use app\classes\Flash;
use app\classes\Login;
use app\classes\Messages;
use app\classes\Redirect;
use app\classes\Sanitize;
use app\classes\User;
use app\models\admin\Admin;
use app\models\Model;
use app\models\site\User as UserModel;

/**
 * @param $dump
 */
function dd($dump) {
	var_dump($dump);

	die();
}

function json($dump) {
	header("Content-type:application/json");

	echo json_encode($dump);

	die();
}

/**
 * @param $email
 * @param $password
 * @param Model       $model
 */
function logar($email, $password, Model $model) {
	return (new Login)->logar($email, $password, $model);
}

/**
 * @param $index
 * @param $message
 */
function flash($index, $message) {
	return (new Flash())->add($index, $message);
}

function back() {
	return Redirect::back();
}

/**
 * @param $target
 */
function redirect($target) {
	return Redirect::to($target);
}

function search() {
	return Sanitize::search();
}

/**
 * @param $message
 */
function success($message) {
	return (new Messages)->success($message);
}

/**
 * @param $message
 */
function danger($message) {
	return (new Messages)->danger($message);
}

function getAdmin() {
	$user = new User;
	$dadosUser = $user->user(new Admin);
	return (object) $dadosUser->first();
}

function getUser() {
	$user = new User;
	$dadosUser = $user->user(new UserModel);

	return (object) $dadosUser->first();
}

function deleteFile($file) {
	if (file_exists($file)) {
		@unlink($file);
		return true;
	}
	return false;
}
