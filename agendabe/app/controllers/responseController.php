<?php

class ResponseController
{
	protected $code;
	protected $message;
	protected $data;

	public function __construct($code, $message, $data = null)
	{
		$this->code = $code;	
		$this->message = $message;
		$this->data = $data;
	}

	public function getData()
	{
		return $this->data;
	}

	public function getMessage()
	{
		return $this->message;
	}

	public function getCode()
	{
		return $this->code;
	}

	public function toArray()
	{
		return [
			'code' => $this->code,	
			'message' => $this->message,
			'data' => $this->data
		];	
	}
}