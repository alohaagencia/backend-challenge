<?php
header('Content-Type: application/json');
require_once 'controller/ContatoController.php';

$contatoController = new ContatoController($_POST);

echo $contatoController->getResponseJson(); 