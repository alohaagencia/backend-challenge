<?php
namespace Agenda\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query\Builder;

class Contact extends AbstractModel {

  protected $id;
  protected $user_id;
  protected $name;
  protected $created_at;
  protected $updated_at;

  protected $search = array('name');

  public function initialize() {
    $this->setSource("contacts");

    $this->belongsTo(
      "user_id",
      "\Agenda\Models\User",
      "id"
    );

    $this->hasMany(
      "id",
      "\Agenda\Models\Phone",
      "contact_id",
      array(
       "alias" => "Phones"
      )
    );
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

  public function getName() {
    return $this->name;
  }

  public function setName($name) {
    $this->name = $name;
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

  public function beforeValidationOnCreate() {
    $this->created_at = date("Y-m-d H:i:s");
  }

  public function beforeSave() {
    $this->updated_at = date("Y-m-d H:i:s");
  }
}

?>
