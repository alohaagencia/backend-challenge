<?php

namespace Agenda\Modules\App\Plugins;

use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Dispatcher;
use Phalcon\Mvc\Dispatcher\Exception as DispatcherException;

class ErrorPlugin extends Plugin {

  /**
   * This action is executed before execute any action in the application
   *
   * @param Event $event
   * @param Dispatcher $dispatcher
   */
  public function beforeException($event, $dispatcher, $exception) {
    $this->view->setLayout('error');
    if ($exception instanceof DispatcherException) {
      switch ($exception->getCode()) {
        case Dispatcher::EXCEPTION_HANDLER_NOT_FOUND:
        case Dispatcher::EXCEPTION_ACTION_NOT_FOUND:
          $dispatcher->forward(array(
            "controller" => "errors",
            "action" => "show404",
            "params" => array("code" => 404, "error" => $exception->getMessage())
          ));
          return false;
      }
    }

    $dispatcher->forward(array(
      "module" => "app",
      "controller" => "errors",
      "action" => "show500",
      "params" => array("code" => 500, "error" => $exception->getMessage() . '<br/>' . $exception->getTraceAsString())
    ));

    return false;
  }

}