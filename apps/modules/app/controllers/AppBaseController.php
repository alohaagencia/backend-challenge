<?php

namespace Agenda\Modules\App\Controllers;

use Agenda\Modules\Common\Controllers\AbstractController;

use Agenda\Models\Rating;

class AppBaseController extends AbstractController {

  protected $user = null;

  const PAGE_LIMIT = 20;

  public function initialize() {
    parent::initialize();
    $this->user = $this->session->get('user');
    $this->view->user = $this->user;
    $this->view->params = $this->request->getQuery();
  }

}
