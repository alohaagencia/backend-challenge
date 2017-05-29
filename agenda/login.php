<?php

header('Content-Type: application/json');

require_once 'controller/UserController.php';

$user = new UserController($_POST);

echo $user->getResponseJson();