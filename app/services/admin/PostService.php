<?php

namespace app\services\admin;

use app\interfaces\ListaEBuscaInterface;
use app\services\ListaEBusca;

class PostService extends ListaEBusca implements ListaEBuscaInterface
{
    public function listar($model)
    {
        if ($this->canSearch()) {
            return $model->buscar()->paginate(15)->get();
        }

        return $model->listar()->paginate(15)->get();
    }
}
