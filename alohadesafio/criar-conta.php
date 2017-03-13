<?php

// Include the common file

require_once ('common.php');

if (isset($_POST['submit']))
	{

    $email=$_POST['email'];

    if ($login->checar_email($email)){

	$values = array(
			'nome' => $_POST['nome'],
			'sobrenome' => $_POST['sobrenome'],
			'email' => $email,
			'senha' => sha1($_POST['senha']),
			'imagem_perfil' => "user.png",
			'data_cadastro' => date("Y-m-d H:i:s"),
			'ip' => $_SERVER['REMOTE_ADDR']
			);
			$db->insert(config_item('login', 'tabela_cadastro') , $values);
			$idcadastro = $db->last_insert_id(); //recupera o id inserido no cadastro e armazena variavel
			session_start();
			$_SESSION["idcadastro"] = $idcadastro;
			header("Location: minha-conta.php");
			$tpl->set('sucesso', true); //quando uma função for executada com sucesso ele retorna true */
		}
	  else
		{
		$tpl->set('falha', true);
		}

    }



$tpl->display('criar-conta');
?>