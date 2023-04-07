<?php

namespace app\controllers\admin;

use app\classes\Validator;
use app\controllers\ContainerController;
use app\models\admin\Html;

class AdminHtmlDescriptionController extends ContainerController {

	private $html;

	public function __construct() {
		$this->html = new Html;
	}

	public function index() {

		$htmlEncontrado = $this->html->select('id,description')->first();

		$this->view([
			'title' => 'Cadastrar description',
			'description' => $htmlEncontrado,
		], 'admin.painel.html_description');
	}

	public function store() {
		$validate = Validator::validate(function () {
			return Validator::required('description')
				->sanitize('description:s');
		});

		if (Validator::failed()) {
			return back();
		}

		$insert = $this->html->insert($validate);

		if ($insert) {
			flash('admin_html_description', success('Cadastrado com sucesso'));
			return back();
		}

		flash('admin_html_description', danger('Erro ao cadastrar'));
		back();
	}

	public function update($request) {
		$validate = Validator::validate(function () {
			return Validator::required('description')
				->sanitize('description:s');
		});

		if (Validator::failed()) {
			return back();
		}

		$update = $this->html->update($validate, ['id' => $request]);

		if ($update) {
			flash('admin_html_description', success('Atualizado com sucesso'));
			return back();
		}

		flash('admin_html_description', danger('Erro ao atualizar'));
		back();

	}

}
