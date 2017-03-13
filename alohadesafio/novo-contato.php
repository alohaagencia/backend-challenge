<?php

// Include the common file

require_once ('common.php');

session_start();

// /Verifica se o usuário esta logado atravez da sessão

if (!isset($_SESSION["idcadastro"])) header("Location: login.php");

foreach($db->query("SELECT idcadastro,nome,sobrenome,telefone,celular,endereco,bairro,cidade,cep,estado,email,senha,imagem_perfil FROM " . config_item('template', 'tabela_cadastro') . " WHERE idcadastro = '" . $_SESSION["idcadastro"] . "'") as $row) $dadosCadastro[] = $row;

if (isset($_POST['submit']))
	{
	$values = array(
		'nome' => $_POST['nome'],
		'sobrenome' => $_POST['sobrenome'],
		'telefone' => $_POST['telefone'],
		'celular' => $_POST['celular'],
		'email' => $_POST['email'],
		'endereco' => $_POST['endereco'],
		'bairro' => $_POST['bairro'],
		'cidade' => $_POST['cidade'],
		'cep' => $_POST['cep'],
		'estado' => $_POST['estado'],
		'observacoes' => $_POST['observacoes'],
		'cadastro_idcadastro' => $_SESSION["idcadastro"],
		'data_cadastro' => date("Y-m-d H:i:s"),
		'ip' => $_SERVER['REMOTE_ADDR']
	);
	$db->insert(config_item('template', 'tabela_contato') , $values);
	$tpl->set('sucesso', true); //quando uma função for executada com sucesso ele retorna true
	}

$tpl->set('dadosCadastro', $dadosCadastro);
$tpl->display('novo-contato');
?>