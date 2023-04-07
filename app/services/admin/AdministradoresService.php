<?php

namespace app\services\admin;

use app\interfaces\ListaEBuscaInterface;
use app\services\ListaEBusca;

class AdministradoresService extends ListaEBusca implements ListaEBuscaInterface {

	public function listar($model) {
		if ($this->canSearch()) {
			return $model->buscar()->paginate(15)->get();
		}

		return $model->select('*')->paginate(15)->get();
	}

}