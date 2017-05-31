<?php
namespace Agenda\Models;

use Phalcon\Mvc\Model;
use Agenda\Modules\Common\Traits\Crypt;

use Phalcon\Mvc\Model\Message;

abstract class AbstractModel extends Model {

  use Crypt;

  protected $status_code = 200;

  public function getErrors(){
    $messages = null;
    foreach ($this->getMessages() as $message) {
      $field = is_array($message->getField()) ? implode(' e ', $message->getField()) : $message->getField();
      if($message->getType() && $field){
        $tmessage = $this->getDI()->getT()->_($message->getType(),array('field'=>$field));
        if($tmessage !== $message->getType()){
          $messages .= $this->getDI()->getT()->_($message->getType(),array('field'=>$field)) . '; ';
        }else{
          $messages .= $message . '; ';
        }
      }else{
        $messages .= $message . '; ';
      }
    }
    return rtrim($messages,'; ');
  }

  public function getStatus_code(){
    return $this->status_code;
  }

  static public function getProperties(){
    return get_class_vars(get_called_class());
  }

  public function save($data = null,$whiteList = null){
    try {
      $result = parent::save($data,$whiteList);
      if(!$result){
        $this->status_code = 400;
      }
      return $result;
    } catch (\Exception $e) {
      $this->status_code = 500;
      $message = new Message("Erro ao salvar: " . $e->getMessage());
      $this->appendMessage($message);
      return false;
    }
  }

  public function getDateFormated($propert,$format = 'd/m/Y H:i:s'){
    try {
      if($this->$propert && $this->$propert !== '0000-00-00 00:00:00'){ 
        return \DateTime::createFromFormat('Y-m-d H:i:s',$this->$propert)->format($format);
      }else{
        return null;
      }
    } catch (\Exception $e) {
      return $this->$propert;
    }
  }
}

?>
