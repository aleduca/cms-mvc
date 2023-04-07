<?php

namespace app\controllers\Site;

use app\models\Site\Noticia;
use app\controllers\ContainerController;

class HomeController extends ContainerController {

	public function index() {

		$noticia = new Noticia;
		$noticias = $noticia->listar()->paginate(5)->get();

		$this->view([
			'titulo' => 'Página Inicial',
			'noticias' => $noticias,
			'links'=> $noticia->links()
		], 'site.home');

	}

}