<?php

namespace app\controllers\Site;
use app\controllers\ContainerController as BaseController;
use \app\models\Site\Noticia;

class NoticiaController extends BaseController{

    public function index(){

        // $noticias = noticia::listar();
        // $noticiaArray = [];

        $noticia = new Noticia;
        $noticiasEncontradas = $noticia->select('*')->get();

        dd($noticiasEncontradas);

        foreach ($noticias as $noticia) {
            $noticiaArray[] = $noticia->to_array();
        }

        echo json_encode( $noticiaArray );
        //echo json_last_error();

    }


}