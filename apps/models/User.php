<?php
namespace Agenda\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query\Builder;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness;

class User extends AbstractModel {

  const SALT = 'Afe$#O9induE8*';
  const STATUS_ACTIVE = 'active';
  const STATUS_WAITING = 'waiting';

  protected $id;
  protected $name;
  protected $email;
  protected $password;
  protected $status;
  protected $created_at;
  protected $updated_at;

  protected $search = array('name','email');

  public function initialize() {
    $this->setSource("users");

    $this->hasMany(
      "id",
      "Contact",
      "user_id"
    );
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
  }

  public function getEmail() {
    return $this->email;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function getPassword() {
    return $this->password;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  public function getStatus() {
    return $this->status;
  }

  public function setStatus($status) {
    $this->status = $status;
  }

  public function getCreated_at() {
    return $this->created_at;
  }

  public function setCreated_at($created_at) {
    $this->created_at = $created_at;
  }

  public function getUpdated_at() {
    return $this->updated_at;
  }

  public function setUpdated_at($updated_at) {
    $this->updated_at = $updated_at;
  }

  public function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
  }

  public function beforeValidationOnCreate() {
    $this->created_at = date("Y-m-d H:i:s");
  }

  public function beforeSave() {
    $this->updated_at = date("Y-m-d H:i:s");
  }

  public function validation() {

    $validator = new Validation();

    $validator->add(
        'email',
        new Uniqueness(array('message'=>'Já existe uma conta com este email, esqueceu sua senha?'))
    );

    return $this->validate($validator);
  }
}

?>
