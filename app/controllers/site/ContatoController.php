<?php

namespace app\controllers\Site;

use app\classes\Email;
use app\classes\Request;
use app\classes\SendEmail;
use app\classes\Validator;
use app\controllers\ContainerController as BaseController;

class ContatoController extends BaseController {

	public function index() {

		$this->view([
			'titulo' => 'Contato',
		], 'site.contato');

	}

	public function enviar() {

		if (Request::request('post')) {

			$validate = Validator::validate(function () {
				return Validator::required('nome', 'email', 'mensagem')
					->email('email')
					->sanitize('nome:s', 'email:s', 'mensagem:s');
			});

			if (Validator::failed()) {
				return back();
			}

			$sendEmail = new SendEmail(new Email());
			$sendEmail->data([
				'assunto' => 'assunto do email',
				'quem' => $validate->email,
				'para' => 'xandecar@hotmail.com',
				'mensagem' => $validate->mensagem,
			]);

			if ($sendEmail->send()) {
				flash('message_email', 'Email enviado com sucesso');
				return back();
			}

			flash('message_email', 'Erro ao enviar email');
			back();
		}

	}
}