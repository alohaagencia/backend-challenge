<?php

class UserController
{

	private $data;

	public function __construct(array $data)
	{
		$this->data = $data;

		if(!$this->validate()){
			return new ResponseController(400, 'bad request');
		}
	}

	public function login() {

		try{
			$user = Usuario::whereRaw(
				'login = ? and password = ?',
				[$this->data['login'], $this->data['senha']]
			)->get();

			if (count($user) > 0) {
				return new ResponseController(200, 'ok', $user);
			}

			return new ResponseController(400, 'nok');
	  		
		} catch (\Exception $e){
			return new ResponseController(500, 'internal_code_error');
		}
	}

	public function insert() {

		try{
			$user = new Usuario;
			$user->login = $this->data['login'];
			$user->password = $this->data['senha'];

			if ($user->save()) {
				return new ResponseController(200, 'ok', $user);
			}

			return new ResponseController(400, 'nok');
	  		
		} catch (\Exception $e){
			return new ResponseController(500, 'internal_code_error');
		}
		
	}

	private function validate()
	{
		return empty($this->data);
	}
}