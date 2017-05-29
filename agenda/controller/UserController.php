<?php

require_once 'model/DoCallModel.php';
require_once 'AbstractController.php';
require_once 'SessionController.php';

class UserController extends AbstractController
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
        
        if (empty($this->data['action'])) {
            return $this->setResponse('nok','Por favor tente novamente.');
        }
        
        return $this->{$this->data['action']}(); 
    }

    public function login()
    {
        if (!$this->validate()) {
            return $this->setResponse('nok','Preencha os campos login e senha.');
        }

        $this->hashSenha();

        $data = "{$this->data['login']}/{$this->data['senha']}";

        $doCall = new DoCallModel('user/', $data);
        $doCall->get();

        if ($doCall->getCode() == 200) {

            $data = $doCall->getData();

            $session = new SessionController();
            $session->createSessionLogin($data[0]->{'id'}, $data[0]->{'login'});
            return $this->setResponse('ok','');
        }

        return $this->setResponse('nok','Dados incorreto.');

    }

    public function save()
    {
        if (!$this->validate()) {
            return $this->setResponse('nok','Preencha os campos login e senha.');
        }

        $this->hashSenha();

        $doCall = new DoCallModel('/user', $this->data);
        $doCall->post();

        if ($doCall->getCode() == 200) {
            return $this->setResponse('ok','Usuario criado com sucesso, faça seu login.');
        }

        return $this->setResponse('nok', 'Por favor tente novamente.');
    }

    private function hashSenha()
    {
        $this->data['senha'] = hash('sha256', $this->data['senha']);
    }

    private function validate()
    {
        if (empty($this->data['login']) || empty($this->data['senha'])) {
            return false;
        }
        return true;
    }
}
