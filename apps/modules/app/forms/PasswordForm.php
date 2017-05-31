<?php

namespace Agenda\Modules\App\Forms;

use Agenda\Modules\Common\Forms\AbstractForm;
use Phalcon\Forms\Element\Password;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class PasswordForm extends AbstractForm {

  public function initialize($entity = null, $requireCurrentPassword = true) {

    if ($requireCurrentPassword) {
      $password = new Password("password", array('class' => 'span12', 'maxlength' => 12));
      $password->setLabel("Senha atual");
      $password->addValidators(array(
        new PresenceOf(array(
          'message' => 'Informe o senha atual'
        )),
        new StringLength(array(
          'max'            => 12,
          'messageMaximum' => 'Senha deve conter no máximo 12 caracteres'
        ))
      ));
      $this->add($password);
    }

    $newPassword = new Password("newPassword", array('class' => 'span12', 'maxlength' => 12));
    $newPassword->setLabel("Nova senha");
    $newPassword->addValidators(array(
      new PresenceOf(array(
        'message' => 'Informe a nova senha'
        )),
      new StringLength(array(
        'max' => 12,
        'messageMaximum' => 'Senha deve conter no máximo 12 caracteres'
        )),
      new Confirmation(array(
        'message' => 'Senha e Confirmação de Senha não são iguais',
        'with' => 'confirmPassword'
      ))
    ));
    $this->add($newPassword);

    $confirmPassword = new Password("confirmPassword", array('class' => 'span12', 'maxlength' => 12));
    $confirmPassword->setLabel("Confirmação senha");
    $confirmPassword->addValidators(array(
      new PresenceOf(array(
        'message' => 'Informe a confirmação da senha'
        )),
      new StringLength(array(
        'max' => 12,
        'messageMaximum' => 'Senha deve conter no máximo 12 caracteres'
        )),
      new Confirmation(array(
        'message' => 'Senha e Confirmação de Senha não são iguais',
        'with' => 'confirmPassword'
      ))
    ));
    $this->add($confirmPassword);
  }

}
