<?php

namespace Agenda\Modules\App;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Simple;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Events\Manager as EventsManager;

class Module implements ModuleDefinitionInterface {

  public function registerAutoloaders(\Phalcon\DiInterface $di = null) {
    $loader = new Loader();
    $config = $di->get('config');

    $loader->registerNamespaces(array(
      "Agenda\Models" => __DIR__ . "/../../models/",
      "Agenda\Plugins" => __DIR__ . "/../../plugins/",
      "Agenda\Library\Commons" => $config->application->libraryDir . "/commons/",
      "Agenda\Library\Commons\Helpers" => $config->application->libraryDir . "/commons/hepers",
      "Agenda\Modules\Common\Controllers" => __DIR__ . "/../common/controllers",
      "Agenda\Modules\Common\Forms" => __DIR__ . "/../common/forms/",
      "Agenda\Modules\Common\Traits" => __DIR__ . "/../common/traits/",
      "Agenda\Modules\Common\Library" => __DIR__ . "/../common/library/",
      "Agenda\Modules\App\Forms" => __DIR__ . "/forms/",
      "Agenda\Modules\App\Controllers" => __DIR__ . "/controllers/",
      "Agenda\Modules\App\Plugins" => __DIR__ . "/plugins/",
      "Agenda\Modules\App\Views\Helpers" => __DIR__ . "/views/helpers/"
    ));

    $loader->registerClasses(array(
      "PHPMailer" => $config->application->vendorDir . "/phpmailer/phpmailer/class.phpmailer.php",
      "SMTP" => $config->application->vendorDir . "/phpmailer/phpmailer/class.smtp.php",
      "Utils" => $config->application->libraryDir . "/Utils.php"
    ));

    $loader->register();
  }

  /**
   * Registers the module-only services
   *
   * @param Phalcon\DI $di
   */
  public function registerServices(\Phalcon\DiInterface $di) {

    $di->set('view', function () use ($di){
        $view = new View();
        $view->setViewsDir(__DIR__ . '/views/');
        $view->configs = $di->get('config'); 
        return $view;
      });

    $di->set('simpleView', function() {
        $simpleView = new Simple();
        $simpleView->setViewsDir(__DIR__ . '/views/');
        return $simpleView;
      }, true);

    $di->set('dispatcher', function() {
        $eventsManager = new EventsManager;
        $eventsManager->attach('dispatch:beforeException', new Plugins\ErrorPlugin);
        $eventsManager->attach('dispatch:beforeDispatch', new Plugins\SecurityPlugin);
        $dispatcher = new Dispatcher;
        $dispatcher->setEventsManager($eventsManager);
        $dispatcher->setDefaultNamespace("Agenda\Modules\App\Controllers");
        return $dispatcher;
      });
  }

}
