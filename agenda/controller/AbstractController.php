<?php

class AbstractController 
{
    protected $response;

    public function setResponse($status, $message)
    {
        $this->response = array(
            'status' => $status,
            'message' => $message
        );
    }

    public function getResponseJson()
    {
        return json_encode($this->response);
    }

    public function setArrayResponse($data)
    {
        $this->response = json_decode($data); 
    }

    public function getResponse()
    {
        return $this->response;
    }
}
