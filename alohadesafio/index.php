<?php

// Include the common file

require_once ('common.php');

session_start();

// /Verifica se o usuário esta logado atravez da sessão

if (!isset($_SESSION["idcadastro"])) header("Location: login.php");

foreach($db->query("SELECT idcadastro,nome,sobrenome,telefone,celular,endereco,bairro,cidade,cep,estado,email,senha,imagem_perfil FROM " . config_item('template', 'tabela_cadastro') . " WHERE idcadastro = '" . $_SESSION["idcadastro"] . "'") as $row) $dadosCadastro[] = $row;

foreach($db->query("SELECT idcontato,nome,sobrenome,telefone,celular,email,endereco,bairro,cidade,cep,estado,observacoes FROM " . config_item('template', 'tabela_contato') . " WHERE cadastro_idcadastro = '" . $_SESSION["idcadastro"] . "' ORDER BY idcontato DESC") as $row) $dadosContato[] = $row;

// Check if the form has been submitted

if (isset($_POST['submit']))
	{
	$values = array(
		'email' => $_POST['email'],
		'ip' => $_SERVER['REMOTE_ADDR'],
		'data_hora_envio' => date("Y-m-d H:i:s")
	);
	$db->insert(config_item('template', 'table_email') , $values);
	$tpl->set('sucesso', true);
	}

// Check if the form has been submitted

if (isset($_POST['excluir']))
	{
	$where = array(
		'idcontato' => $_POST['idcontato']
	);
	$db->where($where);
	$db->delete(config_item('template', 'tabela_contato'));
	$tpl->set('sucesso', true);
	}

$tpl->set('dadosCadastro', $dadosCadastro);
$tpl->set('dadosContato', $dadosContato);
$tpl->display('index');
?>