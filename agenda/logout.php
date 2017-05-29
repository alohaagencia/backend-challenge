<?php

require_once 'controller/SessionController.php';

$session = new SessionController();
$session->destroySessionLogin();