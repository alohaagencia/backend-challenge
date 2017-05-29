<?php

class ContatoController
{

	private $data;

	public function __construct(array $data)
	{
		$this->data = $data;

		if(!$this->validate()){
			return new ResponseController(400, 'bad request');
		}
	}

	public function insert()
	{
		try{
			$contato = new Contato;
			$contato->name = $this->data['name'];
			$contato->fone = $this->data['fone'];
			$contato->id_usuario = $this->data['id_usuario'];

			if ($contato->save()) {
				return new ResponseController(200, 'ok', $contato);
			}

			return new ResponseController(400, 'nok');
	  		
		} catch (\Exception $e) {
			return new ResponseController(500, 'internal_code_error');
		}
		
	}

	public function update()
	{
		try{
			$contato = Contato::find($this->data['id']);
			$contato->name = $this->data['name'];
			$contato->fone = $this->data['fone'];

			if ($contato->save()) {
				return new ResponseController(200, 'ok', $contato);
			}

			return new ResponseController(400, 'nok');
	  		
		} catch (\Exception $e) {
			return new ResponseController(500, 'internal_code_error');
		}
		
	}

	public function delete()
	{
		try{
			$contato = Contato::find($this->data['id']);
			
			if ($contato->delete()) {
				return new ResponseController(200, 'ok');
			}

			return new ResponseController(400, 'nok');
	  		
		} catch (\Exception $e) {
			return new ResponseController(500, 'internal_code_error');
		}
		
	}

	public function getList()
	{
		try{
			$user = Contato::where('id_usuario', '=', $this->data['id_usuario'])->get();

			if (count($user) > 0) {
				return new ResponseController(200, 'ok', $user);
			}

			return new ResponseController(400, 'nok');
	  		
		} catch (\Exception $e) {
			return new ResponseController(500, 'internal_code_error');
		}
	}

	private function validate()
	{
		return empty($this->data);
	}
}