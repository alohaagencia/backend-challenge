<?php

if (substr($_SERVER['HTTP_HOST'],-4) !== '.dev') {
  
  define('APP_ENV', 'production');

  return new \Phalcon\Config(array(
    "prodution" => true,
    "database" => array(
      "adapter" => "Mysql",
      "host" => "mysql.prod",
      "username" => "root",
      "password" => "root",
      "dbname" => "agenda",
      "charset" => "utf8"
    ),
    "application" => array(
      "modelsDir" => __DIR__ . "/../models/",
      "libraryDir" => __DIR__ . "/../library/",
      "vendorDir" => __DIR__ . "/../vendor/",
      "pluginsDir" => __DIR__ . "/../plugin/",
      "messagesDir" => __DIR__ . "/../messages/",
      "baseUri" => "/"
    ),
    "domains" => array(
      "app" => "https://agenda.sotti.com.br"
    ),
    "mail" => array(
      "fromName" => "Agenda",
      "fromEmail" => "agenda@sotti.com.br",
      "charset" => "UTF-8",
      "smtp" => array(
        "server" => "smtp.gmail.com",
        "username" => "agenda@sotti.com.br",
        "password" => "Ag@#S0tt1",
        "secure" => "tls",
        "port" => 587,
        "auth" => true
      )
    )
  ));

} else {

  define('APP_ENV', 'development');

  return new \Phalcon\Config(array(
    "prodution" => false,
    "database" => array(
      "adapter" => "Mysql",
      "host" => "localhost",
      "username" => "root",
      "password" => "root",
      "dbname" => "agenda",
      "charset" => "utf8"
    ),
    "application" => array(
      "modelsDir" => __DIR__ . "/../models/",
      "libraryDir" => __DIR__ . "/../library/",
      "vendorDir" => __DIR__ . "/../vendor/",
      "pluginsDir" => __DIR__ . "/../plugin/",
      "messagesDir" => __DIR__ . "/../messages/",
      "baseUri" => "/"
    ),
    "domains" => array(
      "app" => "http://agenda.dev"
    ),
    "mail" => array(
      "fromName" => "Agenda",
      "fromEmail" => "agenda@sotti.com.br",
      "charset" => "UTF-8",
      "smtp" => array(
        "server" => "smtp.gmail.com",
        "username" => "agenda@sotti.com.br",
        "password" => "Ag@#S0tt1",
        "secure" => "tls",
        "port" => 587,
        "auth" => true
      )
    )
  ));
}
