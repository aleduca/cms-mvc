<?php

use app\classes\Flash;
use app\classes\User;
use app\models\admin\Admin;

$site_url = new \Twig_SimpleFunction('site_url', function () {
	return 'http://' . $_SERVER['SERVER_NAME'] . ':8888';
});

$message = new \Twig_SimpleFunction('message', function ($index) {
	echo Flash::get($index);
});

$administrador = new \Twig_SimpleFunction('administrador', function ($field) {
	return (new User)->user(new Admin)->first()->$field;
});

return [
	$site_url,
	$message,
	$administrador,
];
