<?php
namespace Agenda\Modules\App\Controllers;

use Phalcon\Mvc\View;
use Phalcon\Paginator\Adapter\QueryBuilder;

use Agenda\Models\Contact;
use Agenda\Models\Phone;
use Agenda\Modules\App\Forms\ContactForm;

class ContactsController extends AppBaseController {

  public function indexAction() {

    $this->view->title = 'Contatos';
    $this->view->subtitle = 'Listagem de contatos';
    $this->view->breadcrumb = array(array('label'=>'Contatos'));

    $builder = $this->modelsManager->createBuilder()
    ->from(array('c'=>'Agenda\Models\Contact'))
    ->columns(array('c.id','c.name','p.number','count(*) as total','c.created_at'))
    ->join('Agenda\Models\Phone','c.id = p.contact_id','p')
    ->where('c.user_id = ' . $this->user->getId())
    ->groupBy('c.id')
    ->orderBy('c.name desc');

    $this->queryFilter($builder,Contact::getProperties());

    $count = $this->queryCount($builder);

    $page = (int) $this->request->get('page',null,1);
    $paginator = new \Phalcon\Paginator\Adapter\QueryBuilder(array(
      "builder" => $builder,
      "page" => $page,
      "limit" => self::PAGE_LIMIT
    ));

    $this->view->paginator = $paginator->getPaginate();

  }

  public function registerAction($id = null){

    $this->view->title = 'Contatos';
    $this->view->subtitle = 'Cadastro de contatos';
    $this->view->breadcrumb = array(array('label'=>'Contatos','link'=>'/contacts'),array('label'=>'Cadastro'));

    $contact = new Contact;

    $phones = null;
    $numbers = $this->request->getPost('phones');
    if($numbers){
      if(is_array($numbers)){
        $phones = $numbers;
      }else{
        $phones[] = $numbers;
      }
    }

    $edit = false;
    if($id){
      $contact = Contact::findFirst('id = ' . $id . ' and user_id = ' . $this->user->getId());
      if(!$contact){
        $this->flashSession->error('Contato não encontrado');
        return $this->response->redirect('/contacts');
      }
      $this->view->subtitle = 'Editar contato: ' . $contact->getId();
      if(!$this->request->isPost()){
        $contactPhones = $contact->getPhones();
        foreach ($contactPhones as $phone) {
          $phones[] = $phone->getNumber();
        }
      }
      $edit = true;
    }

    $form = new ContactForm($contact);
    if($phones && $edit){
      $form->get('phone')->setDefault($phones[0]);
      array_shift($phones);
    }
    $this->view->phones = $phones;

    if($this->request->isPost()){

      $data = $this->request->getPost();

      if($form->isValid($data)){
        $newPhones = array();
        if(isset($data['phones'])){
          if(is_array($data['phones'])){
            $newPhones = $data['phones'];
          }else{
            $newPhones[] = $data['phones'];
          }
        }
        $newPhones[] = $data['phone'];
        $newPhones = array_unique($newPhones);

        $this->db->begin();
        if(!$edit){
          $contact = new Contact();
        }else{
          $this->db->delete('phones', 'contact_id = ' . $contact->getId());
        }

        $phones = array();
        foreach ($newPhones as $number) {
          if(!$number){
            continue;
          }
          $phone = new Phone();
          $phone->setNumber($number);
          $phones[] = $phone;
        }

        $contact->setUser_id($this->user->getId());
        $contact->setName($data['name']);
        $contact->Phones = $phones;

        if(!$contact->save($data)){
          $this->db->rolback();
          $this->flashSession->error('Erro ao salvar: ' . $contact->getErrors());
        }else{
          $this->db->commit();
          if($edit){
            $this->flashSession->success('Contato salvo');
          }else{
            $this->flashSession->success('Contato cadastrado');
          }
          return $this->response->redirect('/contacts');
        }
      }
    }

    $this->view->form = $form;
  }

  public function viewAction($id = null){

    $contact = Contact::findFirst('id = ' . $id . ' and user_id = ' . $this->user->getId());
    if(!$contact){
      $this->flashSession->error('Contato não encontrado');
      return $this->response->redirect('/contacts');
    }
    $this->view->title = 'Contatos';
    $this->view->subtitle = $contact->getName();
    $this->view->breadcrumb = array(array('label'=>'Contatos','link'=>'/contacts'),array('label'=>'Visualizar'));

    $this->view->contact = $contact;
  }

  public function deleteAction($id){
    
    $contact = Contact::findFirst('id = ' . $id . ' and user_id = ' . $this->user->getId());
    if(!$contact){
      $this->flashSession->error('Usuário inválido');
      return $this->response->redirect('/contacts');    
    }

    try {
      if ($contact->delete() == false) {
        $this->flashSession->error('Erro ao excluir: ' . $contact->getErrors());
        return $this->response->redirect('/contacts');
      }
    } catch (\Exception $e) {
      $this->flashSession->error('Erro ao excluir: ' . $e->getMessage());
      return $this->response->redirect('/contacts');
    }

    $this->flashSession->success('Usuário excluído');
    return $this->response->redirect('/contacts');     
  }
}