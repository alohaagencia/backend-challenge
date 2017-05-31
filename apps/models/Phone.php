<?php
namespace Agenda\Models;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query\Builder;

class Phone extends AbstractModel {

  protected $id;
  protected $contact_id;
  protected $number;
  protected $created_at;
  protected $updated_at;

  protected $search = array('number');

  public function initialize() {
    $this->setSource("phones");

    $this->belongsTo(
      "contact_id",
      "Contact",
      "id"
    );
  }

  public function getId() {
    return $this->id;
  }

  public function setId($id) {
    $this->id = $id;
  }

  public function getContact_id() {
    return $this->contact_id;
  }

  public function setContact_id($contact_id) {
    $this->contact_id = $contact_id;
  }

  public function getNumber() {
    return $this->number;
  }

  public function setNumber($number) {
    $this->number = $number;
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
    $this->number = $this->clearNumber($this->number);
    $this->updated_at = date("Y-m-d H:i:s");
  }

  public function clearNumber($number){
    return str_replace(array(' ','(',')','-','_'), '', $number);
  }
}

?>
