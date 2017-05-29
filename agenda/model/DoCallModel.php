<?php

class DoCallModel
{
    private $url;
    private $ch;
    private $code;
    private $body;
    private $data;

    public function __construct($endpoint, $data = null)
    {
        $this->url = "http://127.0.0.1/agendabe/{$endpoint}" ;
        $this->data = $data;
        $this->ch = curl_init();
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json'
        ));
    }

    public function get()
    {
        $url = $this->url . $this->data;
        curl_setopt($this->ch, CURLOPT_URL, $url);
        $this->setResponse();
    }

    public function post()
    {
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_POST, 1);
        curl_setopt($this->ch,CURLOPT_POSTFIELDS, json_encode($this->data));
        $this->setResponse();
    }

    public function put()
    {
        curl_setopt($this->ch, CURLOPT_URL, $this->url);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($this->ch,CURLOPT_POSTFIELDS, json_encode($this->data));
        $this->setResponse();
    }

    public function delete()
    {
        $url = $this->url . $this->data;
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        $this->setResponse();
    }

    private function setResponse()
    {
        $this->body = curl_exec($this->ch);
        $this->code = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        $this->error = curl_errno($this->ch);
    }

    public function getData()
    {
        $body = json_decode($this->body);
        return $body->{'data'};
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getCode()
    {
        return $this->code;
    }
}