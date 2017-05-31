<?php

namespace Agenda\Modules\App\Plugins;

use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Resource;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl\Adapter\Memory as AclList;

use Agenda\Models\Permission;

/**
 * SecurityPlugin
 *
 * This is the security plugin which controls that users only have access to the modules they're assigned to
 */
class SecurityPlugin extends Plugin {

  const GUEST = 'guest';
  const USER = 'user';

  public function getAcl() {

    //Recursos liberados
    $publicResources = array(
      'errors' => array('show403', 'show404', 'show500', "show400"),
      'auth' => array('index','register','confirm','logout','forgot','newpassword','confirm')
    );

    //Recursos que serão liberados de acordo com o papel
    $avaliablesPrivateResources = array(
      'index' => array('index'),
      'contacts' => array('index', 'register', 'delete','view')
    );

    $acl = new AclList();
    $acl->setDefaultAction(Acl::DENY);

    $roleGuest = new Role(self::GUEST);
    $roleLogged = new Role(self::USER);
    $acl->addRole($roleGuest);
    $acl->addRole($roleLogged, $roleGuest);

    $user_session = $this->session->get("user");
    $role = $this->session->get("role");

    foreach ($publicResources as $resource => $actions) {
      $acl->addResource(new Resource($resource), $actions);
    }
    foreach ($publicResources as $resource => $actions) {
      foreach ($actions as $action) {
        $acl->allow('*', $resource, $action);
      }
    }

    foreach ($avaliablesPrivateResources as $resource => $actions) {
      $acl->addResource(new Resource($resource), $actions);
    }

    $permissions = array(
      self::USER => array('index','contacts')
    );

    if ($role && $user_session) {
      foreach ($avaliablesPrivateResources as $resource => $actions){
        if(isset($permissions[$role]) && in_array($resource, $permissions[$role])){
          $acl->allow($role, $resource, $actions);
        }
      }
    }

    return $acl;
  }

  /**
   * This action is executed before execute any action in the application
   *
   * @param Event $event
   * @param Dispatcher $dispatcher
   */
  public function beforeDispatch(Event $event, Dispatcher $dispatcher) {

    $user_session = $this->session->get('user');
    $role = self::GUEST;
    if ($user_session ) {
      $role = self::USER;
    }
    $this->session->set('role',$role);

    $controller = $dispatcher->getControllerName();
    $action = $dispatcher->getActionName();
    $acl = $this->getAcl($role);
    $this->view->acl = $acl;

    if ($acl->isResource($controller) && $acl->isAllowed($role, $controller, $action) != Acl::ALLOW) {
      if ($role == self::GUEST) {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
          $this->response->setStatusCode(403, "Forbiden");
          $this->flashSession->error("Sua sessão expirou");
          echo "Sessão expirada";
        } else {
          $dispatcher->forward(array(
            'controller' => 'auth',
            'action' => 'index'
          ));
        }
      } else {
        $dispatcher->forward(array(
          'controller' => 'errors',
          'action' => 'show400',
          'params' => array(
            'code' => 403,
            'error' => 'Você não possui permissão para acessar esta página'
          )
        ));
      }
      return false;
    }
    
  }

}