<?php
use Slim\Slim;

class helpers {

  public static function jsonResponse( $error = true, $message = '', $data = array() ) {

    $app               = Slim::getInstance();
    $response          = new stdClass();
    $response->error   = $error;
    $response->message = $message;
    $response->data    = $data;

    $app->response()->header('Content-Type', 'application/json');
    return $app->response()->body( json_encode($response) );

  }

}