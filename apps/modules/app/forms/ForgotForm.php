<?php

namespace Agenda\Modules\App\Forms;

use Agenda\Modules\Common\Forms\AbstractForm;
use Phalcon\Forms\Element\Email;
use Phalcon\Validation\Validator\PresenceOf;

class ForgotForm extends AbstractForm {

  public function initialize() {

    // Email
    $email = new Email('email', array(
      'placeholder' => 'Email',
      'data-icon' => 'glyphicon glyphicon-envelope'
    ));
    $email->addValidators(array(
      new PresenceOf(array(
        'message' => 'Email é obrigatório'
        ))
    ));

    $this->add($email);
    
  }

}
