<?php

// Include the common file

require_once ('common.php');

if (isset($_POST['logar']))
	{
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	if ($login->checar_usuario($email, $senha))
		{
		header("Location: index.php");
		}
	  else
		{
		$tpl->set('falha', true);
		}
	}
	
$tpl->display('login');
?>