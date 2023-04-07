<?php

namespace app\services;

use app\interfaces\ListaEBuscaInterface;
use app\models\Model;

class ListaEBuscaService
{
    protected $model;

    public function listar(Model $model, ListaEBuscaInterface $listaEBuscaInterface)
    {
        $this->model = $model;
        return $listaEBuscaInterface->listar($this->model);
    }

    public function links()
    {
        return $this->model->links();
    }
}
