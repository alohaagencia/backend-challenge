<?php

/**
 * Services are globally registered in this file
 */
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Session\Adapter\Files as Session;

/**
 * The FactoryDefault Dependency Injector automatically register the right services providing a full stack framework
 */
$di = new FactoryDefault();


/**
 * Register the global configuration as config
 */
$di->set('config', $config);


/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->set('url', function () use ($config) {
    $url = new UrlResolver();
    $url->setBaseUri($config->application->baseUri);
    return $url;
  }, true);


/**
 * Database connection is created based in the parameters defined in the configuration file
 */
$di->setShared('db', function () use ($config) {
  return new \Phalcon\Db\Adapter\Pdo\Mysql(array(
    "host"         => $config->database->host,
    "username"     => $config->database->username,
    "password"     => $config->database->password,
    "dbname"       => $config->database->dbname,
    'charset' => $config->database->charset
  ));
});

$di->set('session', function() use ($config){
  $session = new Session();
  $session->start();

  return $session;
});


$di->set('cache', function() use ($config) {
  
  $frontCache = new \Phalcon\Cache\Frontend\Data(array(
      "lifetime" => 172800
  ));

  $cache = new  \Phalcon\Cache\Backend\File(
              $frontCache,
              array(
                  "cacheDir" => APP_DIR . "/cache/"
              )
          );
  return $cache;
});

if(APP_ENV !== 'development'){
  $di->set('modelsMetadata', function() {
    $metaData = new \Phalcon\Mvc\Model\Metadata\Session(array(
      'prefix' => 'model_metadata'
    ));
    return $metaData; 
  });
}

/**
 * Registering a router
 */
$di->set('router', function () use ($di) {
  $router = new Router(false);

  $router->setDefaultModule('app');

  $router->add('/', array(
      'module' => 'app',
      'controller' => 'index',
      'action' => 'index',
  ));

  $router->add('/:controller', array(
      'module' => 'app',
      'controller' => 1,
      'action' => 'index',
  ));

  $router->add('/:controller/:action/:params', array(
      'module' => 'app',
      'controller' => 1,
      'action' => 2,
      'params' => 3
  ));

  $router->setUriSource(\Phalcon\Mvc\Router::URI_SOURCE_SERVER_REQUEST_URI);
  $router->removeExtraSlashes(TRUE);
  return $router;
});


//Register the flash service with custom CSS classes
$di->set('flashSession', function() {
  $flash = new \Phalcon\Flash\Session(array(
    'error' => 'alert alert-error',
    'success' => 'alert alert-success',
    'notice' => 'alert alert-info',
    'warning' => 'alert alert-warning',
  ));
  return $flash;
});


$di->set('cookies', function() {
  $cookies = new \Phalcon\Http\Response\Cookies();
  $cookies->useEncryption(false);
  return $cookies;
});

