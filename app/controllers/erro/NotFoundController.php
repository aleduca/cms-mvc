<?php

namespace app\controllers\Erro;
use \app\controllers\ContainerController;

class NotFoundController extends ContainerController {

	public function index() {
		dd('opa, alguma coisa errada aconteceu');
	}

}