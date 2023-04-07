<?php

namespace app\models\admin;

use app\models\Model;

class Admin extends Model {

	/**
	 * @var string
	 */
	protected $table = 'administrador';
	/**
	 * @var string
	 */
	public $logado = 'admin_logado';
	/**
	 * @var string
	 */
	public $dados = 'admin_dados';
	/**
	 * @var string
	 */
	public $redirect = 'admin';

	public function buscar() {
		$this->sql = "select * from {$this->table} where name  like :name or email like :email";

		$search = search();

		$this->binds = [
			'name' => '%' . $search . '%',
			'email' => '%' . $search . '%',
		];

		return $this;

	}

}