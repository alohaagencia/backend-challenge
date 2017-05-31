<?php
namespace Agenda\Models;

use Phalcon\Mvc\Model;

use Phalcon\Mvc\Model\Validator\Uniqueness;

class Error extends AbstractModel {

  protected $id;
  protected $user_id;
  protected $data;
  protected $message;
  protected $method;
  protected $uri;
  protected $headers;
  protected $basic_auth;
  protected $created_at;

  public function initialize() {
    $this->setSource("errors");
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getUser_id() {
    return $this->user_id;
  }

  public function setUser_id($user_id) {
    $this->user_id = $user_id;
  }

  public function getData() {
    return $this->data;
  }

  public function setData($data) {
    $this->data = $data;
  }

  public function getMessage() {
    return $this->message;
  }

  public function setMessage($message) {
    $this->message = $message;
  }

  public function getMethod() {
    return $this->method;
  }

  public function setMethod($method) {
    $this->method = $method;
  }

  public function getUri() {
    return $this->uri;
  }

  public function setUri($uri) {
    $this->uri = $uri;
  }

  public function getHeaders() {
    return $this->headers;
  }

  public function setHeaders($headers) {
    $this->headers = $headers;
  }

  public function getBasic_auth() {
    return $this->basic_auth;
  }

  public function setBasic_auth($basic_auth) {
    $this->basic_auth = $basic_auth;
  }

  public function getCreated_at() {
    return $this->created_at;
  }

  public function setCreated_at($created_at) {
    $this->created_at = $created_at;
  }

  //-- Fim getters and setters

  public function beforeCreate() {
    $this->created_at = date("Y-m-d H:i:s");
  }

}