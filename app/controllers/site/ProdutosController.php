<?php

namespace app\controllers\Site;
use \app\controllers\BaseController as BaseController;
use \Acme\Classes\Redirect as Redirect;
use \Acme\Classes\Parameters as Parameter;

class ProdutosController extends BaseController{

    public function index(){

        $dados = [ 'titulo' => 'Pagina dos produtos' ];
        $template = $this->twig->loadTemplate( 'Site/produtos.html' );
        $template->display( $dados );

    }

}