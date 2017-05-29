<?php

require_once 'model/DoCallModel.php';
require_once 'AbstractController.php';
require_once 'SessionController.php';

class ContatoController extends AbstractController
{
	protected $data;

	public function __construct(array $data = null)
	{

		$this->data = $data;

		$session = new SessionController();

		if (!$session->hasSessionLogin()) {
			header("location:index.php"); 
		}

		if (empty($this->data['action'])) {
            return $this->setResponse('nok','Por favor tente novamente..');
        }
        
        return $this->{$this->data['action']}();
	}

	public function getList()
	{
        $data = "{$_SESSION['login']['id']}";

        $doCall = new DoCallModel('contato/', $data);
        $doCall->get();

        return $doCall->getData();
	}

	public function save()
    {
        $doCall = new DoCallModel('contato', $this->data);
        $doCall->post();

        if ($doCall->getCode() == 200) {
            return $this->setResponse('ok','Contato criado com sucesso.');
        }

        return $this->setResponse('nok', 'Por favor tente novamente.');
    }

    public function update()
    {
        $doCall = new DoCallModel('contato', $this->data);
        $doCall->put();

        if ($doCall->getCode() == 200) {
            return $this->setResponse('ok','Contato atualizado com sucesso.');
        }

        return $this->setResponse('nok', 'Por favor tente novamente.');
    }

    public function delete()
    {

        $data = "{$this->data['id']}";

        $doCall = new DoCallModel('contato/', $data);
        $doCall->delete();

        if ($doCall->getCode() == 200) {
            return $this->setResponse('ok','Usuario deletado com sucesso.');
        }

        return $this->setResponse('nok', 'Por favor tente novamente.');
    }                
}
