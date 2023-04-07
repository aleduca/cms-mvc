<?php

namespace app\controllers\Site;
use \app\controllers\BaseController as BaseController;

class SobreController extends BaseController{

    public function index(){

        $dados = [ 'titulo' => 'Sobre a empresa' ];
        $template = $this->twig->loadTemplate( 'Site/sobre.html' );
        $template->display( $dados );

    }

}