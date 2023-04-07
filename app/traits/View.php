<?php

namespace app\traits;

use app\classes\App;

trait View {

	public function view($dados, $view) {
		$twig = App::get('twig');
		$template = $twig->loadTemplate(str_replace('.', '/', $view) . '.html');
		return $template->display($dados);
	}

}