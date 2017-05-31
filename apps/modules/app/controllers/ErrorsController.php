<?php

namespace Agenda\Modules\App\Controllers;

use Phalcon\Mvc\View;

class ErrorsController extends AppBaseController {
  
  public function initialize() {
    $this->view->setLayout('auth');
    $this->view->setRenderLevel(View::LEVEL_AFTER_TEMPLATE);
    $this->view->code = $this->dispatcher->getParam("code");
    $this->view->message = $this->dispatcher->getParam("error");
  }
  
  public function show403Action(){

  }

  public function show404Action(){

  }
  
  public function show400Action(){

  }
  
  public function show500Action(){
  }
  
}

?>
