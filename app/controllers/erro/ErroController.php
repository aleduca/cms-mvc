<?php

namespace app\controllers\Erro;

use app\controllers\ContainerController;

class ErroController extends ContainerController {

	public function index() {
		$this->view([
			'titulo' => 'Erro',
		], 'erro.erro404');
	}

}
