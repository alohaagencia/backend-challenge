<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');

error_reporting(E_ALL);
ini_set('display_errors', 1);

date_default_timezone_set("America/Sao_Paulo");

try {

  /**
   * Define some useful constants
   */
  define('BASE_DIR', dirname(__DIR__));
  define('PUBLIC_DIR', dirname(__DIR__) . '/public');
  define('APP_DIR', BASE_DIR . '/apps');

  /**
   * Read the configuration
   */
  $config = include APP_DIR . '/config/config.php';

  /**
   * Read services
   */
  include APP_DIR . '/config/services.php';

  /**
   * Handle the request
   */
  $app = new Phalcon\Mvc\Application($di);

  
  require APP_DIR . '/vendor/autoload.php';
  
  /**
   * Read modules
   */
  require APP_DIR . '/config/modules.php';
  
  echo $app->handle()->getContent();
  
} catch (Exception $e) {
  echo $e->getMessage(), '<br>';
  echo nl2br(htmlentities($e->getTraceAsString()));
}
