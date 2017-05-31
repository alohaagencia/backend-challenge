<?php

namespace Agenda\Modules\App\Forms;

use Agenda\Modules\Common\Forms\AbstractForm;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Email;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email as EmailValidator;

class RegisterForm extends AbstractForm {

  public function initialize($model = null) {
    
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
    $email = new Email('email');
    $email->setLabel("Email");
    $email->addValidators(array(
      new PresenceOf(array(
        'message' => 'Email é obrigatório'
      )),
      new EmailValidator(array(
        "message" => "Email inválido",
      ))
    ));

    $this->add($email);

    $password = new Password('password');
    $password->setLabel("Senha");
    $password->addValidators(array(
      new Confirmation(array(
          "message" => "Confirmação de senha incorreta",
          "with"    => "password_confirm"
        )
      )
    ));
    $this->add($password);

    // Password
    $password_confirm = new Password('password_confirm');
    $password_confirm->setLabel("Confirmar senha");
    $this->add($password_confirm);
    
  }

}
