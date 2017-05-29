<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
# === constants
# ==================================================
define("_APP", dirname(__FILE__) . '/app');

require 'vendor/autoload.php';

$app = new \Slim\App;

# === config
# ==================================================
require_once _APP . '/config/database.php';

# === models
# ==================================================
require_once _APP . "/models/appModels.php";

# === controllers
# ==================================================
require_once _APP . "/controllers/userController.php";
require_once _APP . "/controllers/contatoController.php";
require_once _APP . "/controllers/responseController.php";


$app->get('/user/{login}/{password}', function (Request $request, Response $response) {

	$userController = new UserController([
		'login' => $request->getAttribute('login'),
		'senha' => $request->getAttribute('password')
	]);

	$resp = $userController->login();
	
    return $response->withStatus($resp->getCode())
    				->withJson($resp->toArray());
});


$app->post('/user', function (Request $request, Response $response) {

	$userController = new UserController($request->getParsedBody());

	$resp = $userController->insert();
	
    return $response->withStatus($resp->getCode())
    				->withJson($resp->toArray());
});

$app->get('/contato/{idUsuario}', function (Request $request, Response $response) {

	$contatoController = new ContatoController([
		'id_usuario' => $request->getAttribute('idUsuario')
	]);

	$resp = $contatoController->getList();
	
    return $response->withStatus($resp->getCode())
    				->withJson($resp->toArray());
});

$app->post('/contato', function (Request $request, Response $response) {

	$contatoController = new ContatoController($request->getParsedBody());

	$resp = $contatoController->insert();
	
    return $response->withStatus($resp->getCode())
    				->withJson($resp->toArray());
});

$app->put('/contato', function (Request $request, Response $response) {

	$contatoController = new ContatoController($request->getParsedBody());

	$resp = $contatoController->update();
	
    return $response->withStatus($resp->getCode())
    				->withJson($resp->toArray());
});


$app->delete('/contato/{id}', function (Request $request, Response $response) {

	$contatoController = new ContatoController([
		'id' => $request->getAttribute('id')
	]);

	$resp = $contatoController->delete();
	
    return $response->withStatus($resp->getCode())
    				->withJson($resp->toArray());
});


$app->run();