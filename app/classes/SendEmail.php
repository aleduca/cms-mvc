<?php


namespace app\classes;


class SendEmail {

    private $email;
    private $data;

    public function __construct (Email $email) {
        $this->email = $email;
    }

    public function data (array $data) {
        $this->data = $data;
    }

    public function send () {
        $this->email->setAssunto($this->data['assunto']);
        $this->email->setQuem($this->data['quem']);
        $this->email->setPara($this->data['para']);
        $this->email->setBody($this->data['mensagem']);
        return $this->email->enviarEmail();
    }

}