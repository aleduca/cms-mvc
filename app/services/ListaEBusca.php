<?php

namespace app\services;

class ListaEBusca {

	protected function isSearch() {
		return isset($_GET['s']);
	}

	protected function isNotEmpty() {
		return !empty($_GET['s']);
	}

	protected function canSearch() {
		return ($this->isSearch() and $this->isNotEmpty());
	}

}