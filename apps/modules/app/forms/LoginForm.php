<?php

namespace Agenda\Modules\App\Forms;

use Agenda\Modules\Common\Forms\AbstractForm;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Identical;

class LoginForm extends AbstractForm {

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

    // Password
    $password = new Password('password', array(
      'placeholder' => 'Password',
      'data-icon' => 'glyphicon glyphicon-lock'
    ));
    $password->addValidator(new PresenceOf(array(
      'message' => 'Informe o password'
    )));
    
    $this->add($password);

    // CSRF
    $csrf = new Hidden('csrf');
    $csrf->addValidator(new Identical(array(
      'value' => $this->security->getSessionToken(),
      'message' => 'CSRF validation failed'
    )));
    $this->add($csrf);
    
  }

}
