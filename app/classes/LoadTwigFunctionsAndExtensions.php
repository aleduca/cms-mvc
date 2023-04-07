<?php

namespace app\classes;

use app\classes\App;

class LoadTwigFunctionsAndExtensions {

	private $twig;

	public function __construct() {
		$this->twig = App::get('twig');
	}

	public function functions() {

		$functions = require "../app/functions/twig.php";

		foreach ($functions as $function) {
			$this->twig->addFunction($function);
		}
	}

	public function extensions() {
		$this->twig->getExtension('core')->setTimeZone('America/Sao_Paulo');
		$this->twig->getExtension('core')->setDateFormat('d/m/Y');
	}

}