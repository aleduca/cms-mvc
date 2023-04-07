<?php

namespace app\controllers\admin;

use app\classes\Validator;
use app\controllers\ContainerController;
use app\models\admin\Html;

class AdminHtmlKeywordsController extends ContainerController {

	private $html;

	public function __construct() {
		$this->html = new Html;
	}

	public function index() {

		$htmlEncontrado = $this->html->select('id,keywords')->first();

		$this->view([
			'title' => 'Cadastrar keywords',
			'keywords' => $htmlEncontrado,
		], 'admin.painel.html_keywords');
	}

	public function store() {
		$validate = Validator::validate(function () {
			return Validator::required('keywords')
				->sanitize('keywords:s');
		});

		if (Validator::failed()) {
			return back();
		}

		$insert = $this->html->insert($validate);

		if ($insert) {
			flash('admin_html_keywords', success('Cadastrado com sucesso'));
			return back();
		}

		flash('admin_html_keywords', danger('Erro ao cadastrar'));
		back();
	}

	public function update($request) {
		$validate = Validator::validate(function () {
			return Validator::required('keywords')
				->sanitize('keywords:s');
		});

		if (Validator::failed()) {
			return back();
		}

		$update = $this->html->update($validate, ['id' => $request]);

		if ($update) {
			flash('admin_html_keywords', success('Atualizado com sucesso'));
			return back();
		}

		flash('admin_html_keywords', danger('Erro ao atualizar'));
		back();

	}

}
