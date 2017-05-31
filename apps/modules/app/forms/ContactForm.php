<?php

namespace Agenda\Modules\App\Forms;

use Agenda\Modules\Common\Forms\AbstractForm;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;

class ContactForm extends AbstractForm {

  public function initialize($model = null, $account_id) {
    
    $name = new Text("name", array('maxlength' => 100));
    $name->setLabel("Nome");
    $name->addValidators(array(
      new PresenceOf(array(
        'message' => 'Informe o nome'
      )),
      new StringLength(array(
        'max' => 100,
        'messageMaximum' => 'Nome deve conter no máximo 100 caracteres'
      ))
    ));
    $this->add($name);

    // Email
    $phones = new Text('phone',array('class'=>'mask-phone'));
    $phones->setLabel("Telefone");
    $phones->addValidators(array(
      new PresenceOf(array(
        'message' => 'Telefone é obrigatório'
        ))
    ));

    $this->add($phones);
    
  }

}
