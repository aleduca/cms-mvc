<?php

namespace app\models\site;

use app\models\Model;

class User extends Model {

	protected $table = 'tb_user';
	public $logado = 'user_logado';
	public $dados = 'user_dados';

}