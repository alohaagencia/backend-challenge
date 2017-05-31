<?php

namespace Agenda\Modules\App\Controllers;

use Agenda\Models\User;

use Agenda\Modules\App\Forms\LoginForm;
use Agenda\Modules\App\Forms\ForgotForm;
use Agenda\Modules\App\Forms\RegisterForm;
use Agenda\Modules\App\Forms\PasswordForm;

use Phalcon\Mvc\View;
use Agenda\Plugins\Mail;

class AuthController extends AppBaseController {

  use \Agenda\Modules\Common\Traits\Crypt;

  public function initialize() {
    parent::initialize();
    // Shows only the view related to the action
    $this->view->setRenderLevel(View::LEVEL_AFTER_TEMPLATE);
  }

  public function indexAction() {

    $form = new LoginForm();

    if($this->request->isPost()){
      $data = $this->request->getPost();
      if($form->isValid($data)){
        $user = User::findFirst(
          array(
            'email = :email: and password = :password:',
            'bind'=>array(
              'email'=>$data['email'],
              'password'=>md5($data['password'] . User::SALT)
            )
          )
        );

        if(!$user){
          $this->flashSession->error('Usuário ou senha incorretos');
        }else if($user->getStatus() == User::STATUS_WAITING){
          $this->flashSession->error('Conta aguardando validação, verifique seu email');
        }else{
          $this->flashSession->success('Usuário logado com sucesso');
          $this->session->set('user',$user);
          return $this->response->redirect('/');
        }

      }
    }
    $this->view->form = $form;
  }

  public function registerAction(){
    
    $form = new RegisterForm();

    if($this->request->isPost()){
      $data = $this->request->getPost();

      $dataCaptcha = array(
        'secret' => '6LepnSMUAAAAAGPTbDMiZde9z9oInH3FHk9w8zlv',
        'response' => $data['g-recaptcha-response'],
        'remoteip' => $this->request->getClientAddress()
      );

      $ch = \curl_init();
      \curl_setopt($ch, CURLOPT_URL,'https://www.google.com/recaptcha/api/siteverify');
      \curl_setopt($ch, CURLOPT_POST, 1);
      \curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($dataCaptcha));
      \curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = \curl_exec ($ch);
      try {
        $result = json_decode($result);
        if(!$result->success){
          $this->view->form = $form;
          return $this->flashSession->error('Captcha Inválido');
        }
      } catch (\Exception $e) {
        $this->view->form = $form;
        return $this->flashSession->error('Erro ao validar captcha: ' . $e->getMessage());
      }

      if($form->isValid($data)){
        $user = new User();
        $data['status'] = User::STATUS_WAITING;
        $data['password'] = md5($data['password'] . User::SALT);
        if($user->save($data) == false){
          $this->flashSession->error('Erro ao cadastrar: ' . $user->getErrors());
        }else{

          $token = self::encrypt($user->getId() . '|' .$user->getEmail());
          
          $config = $this->getDI()->get("config");
          $mail = new Mail();
          $msg = "Olá " . $user->getName() . ", <br> para confirmar sua conta clique no botão abaixo. <br><br>
            <a class='fontAgendaEmail' href='" . $config->domains->app . "/auth/confirm/" . $token ."' style='width: 300px; height: 20px; background-color: #00a65a; text-align: center; padding: 5px 15px; font-size: 18px; color: white; text-decoration: none;  border-radius: 4px; letter-spacing: -1px;' target='_black'>
              Confirmar Conta
            </a>";
          if ($mail->send($user->getEmail(), $user->getName(), "Confirmação de Cadastro", $msg)) {
            $this->flashSession->success('Conta criada com sucesso, verifique seu email para confirmar sua conta');
            return $this->response->redirect('/auth');
          } else {
            $this->flashSession->error('Ocorreu um erro inesperado durante o envio do email: ' . $mail->getError());
          }
        }
      }
    }
    $this->view->form = $form;
  }

  public function logoutAction() {
    $this->session->remove('user');
    $this->flashSession->success('Sessão encerrada com sucesso.');
    return $this->response->redirect('/');
  }

  public function confirmAction($token) {
    list($id, $email) = explode("|", self::decrypt($token));
    $user = User::findFirst(array(
      "id = :id: AND email = :email:",
      'bind' => array(
        'id' => $id,
        'email' => $email
      )
    ));
    if (!$user) {
      $this->flashSession->error('Conta inválida');
      return $this->response->redirect('/auth');
    }

    if($user->getStatus() == User::STATUS_ACTIVE){
      $this->flashSession->notice('Conta já ativada, preencha os campos para logar');
      return $this->response->redirect('/auth'); 
    }

    $user->setStatus(User::STATUS_ACTIVE);
    if($user->save() == false){
      $this->flashSession->error('Erro ao aconfirmar conta: ' . $user->getErros());
      return $this->response->redirect('/auth'); 
    }
    
    $this->flashSession->success('Conta confirmada com sucesso');
    $this->session->set('user',$user);
    return $this->response->redirect('/');
  }

  public function forgotAction() {

    $form = new ForgotForm();

    if($this->request->isPost()){

      $data = $this->request->getPost();

      if($form->isValid($data)){

        $email = $data['email'];

        $user = User::findFirst(array(
          "email = :email:",
          'bind' => array(
            'email' => trim($email)
          )
        ));
        if (!$user) {
          $this->flashSession->error('Usuário não encontrado');
          return $this->response->redirect('/auth/forgot');
        }

        $date = new \DateTime();
        $date->modify("+60 minutes");
        $token = self::encrypt($user->getId() . '|' . $user->getEmail() . '|' . $date->getTimestamp());

        $config = $this->getDI()->get("config");

        $mail = new Mail();
        $msg = "Olá " . $user->getName() . ", <br> para cadastrar uma nova senha clique no botão abaixo. <br><br>
          <a class='fontAgendaEmail' href='" . $config->domains->app . "/auth/newpassword/" . $token ."' style='width: 300px; height: 20px; background-color: #00a65a; text-align: center; padding: 5px 15px; font-size: 18px; color: white; text-decoration: none;  border-radius: 4px; letter-spacing: -1px;' target='_black'>
            Cadastrar Nova Senha
          </a>";
        if ($mail->send($user->getEmail(), $user->getName(), "Recuperação de Senha", $msg)) {
          $this->flashSession->success('Um link de recuperação de senha foi enviado para seu email.');
        } else {
          $this->flashSession->error('Ocorreu um erro inesperado durante o envio do email: ' . $mail->getError());
        }
      }
    }
    $this->view->form = $form;
  }

  public function newpasswordAction($token) {

    list($id, $email, $timestamp) = explode("|", self::decrypt($token));

    if (! is_numeric($timestamp)) {
      $this->flashSession->error('Link de recuperação de senha inválido');
      return $this->response->redirect('/auth');
    }

    $now = new \DateTime();
    $expirationDate = new \DateTime();
    $expirationDate->setTimestamp($timestamp);
    if ($now > $expirationDate) {
      $this->flashSession->error('Link expirado em ' . $expirationDate->format("d/m/Y H:i:s") . '.');
      return $this->response->redirect('/auth');
    }

    $user = User::findFirst(array(
      "id = :id: AND email = :email:",
      'bind' => array(
        'id' => $id,
        'email' => $email
      )
    ));

    if (!$user) {
      $this->flashSession->error('Link de recuperação de senha inválido');
      return $this->response->redirect('/auth');
    }

    $this->view->token = $token;
    $this->view->user = $user;

    $form = new PasswordForm(null, false);

    if ( $this->request->isPost() ) {

      $data = $this->request->getPost();

      $invalidFields = array();
      if ($form->isValid($data)) {

        $user->setPassword(md5($data["newPassword"] . User::SALT));
        if ($user->save() == false) {
          $this->flashSession->error('Ocorreu um erro ao atualizar a senha: ' . $user->getErros());
        }

        $this->flashSession->success('Conta confirmada com sucesso');
        $this->session->set('user',$user);
        return $this->response->redirect('/');
      }
    }

    $this->view->form = $form;

  }

}

