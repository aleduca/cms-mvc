<?php

use app\classes\App;
use app\classes\CheckAndEexecutePermission;
use app\classes\Load;
use app\classes\LoadTemplate;
use app\classes\LoadTwigFunctionsAndExtensions;
use app\controllers\Controller;
use app\models\Connection;

$template = new LoadTemplate();
$twig = $template->init();

App::binds([
	'connection' => Connection::connect(),
	'twig' => $twig,
]);

$loadTwigFunctionsAndExtensions = new LoadTwigFunctionsAndExtensions();
$loadTwigFunctionsAndExtensions->functions();
$loadTwigFunctionsAndExtensions->extensions();

try {

	$controller = new Controller();

	$getController = $controller->getController();
	$classController = new $getController();

	CheckAndEexecutePermission::execute($classController);

	$metodo = $controller->getMethod($classController);
	$parameter = $controller->parameter();
	$classController->$metodo($parameter);
} catch (\Throwable $e) {

	$environment = Load::load('environment');

	if ($environment->type == 'dev') {
		dd($e->getMessage() . ' no arquivo ' . $e->getFile() . ' na linha ' . $e->getLine());
	}

	$erro = new app\controllers\Erro\ErroController;
	$erro->index();
}
