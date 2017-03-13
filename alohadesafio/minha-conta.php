<?php

// Include the common file

require_once ('common.php');

session_start();

// /Verifica se o usuário esta logado atraves da sessão

if (!isset($_SESSION["idcadastro"])) header("Location: login.php");

foreach($db->query("SELECT idcadastro,nome,sobrenome,telefone,celular,endereco,bairro,cidade,cep,estado,email,senha,imagem_perfil FROM " . config_item('template', 'tabela_cadastro') . " WHERE idcadastro = '" . $_SESSION["idcadastro"] . "'") as $row) $dadosCadastro[] = $row;

if (isset($_POST['emailSenha']))
	{
	$values = array(
		'email' => $_POST['email'],
		'senha' => sha1($_POST['senha']) ,
		'ip' => $_SERVER['REMOTE_ADDR']
	);
	$where = array(
		'idcadastro' => $_SESSION["idcadastro"]
	);
	$db->where($where);
	$db->update(config_item('template', 'tabela_cadastro') , $values);
	$tpl->set('emailsenhaSucesso', true);
	}

if (isset($_POST['atualizar']))
	{
	$values = array(
		'nome' => $_POST['nome'],
		'sobrenome' => $_POST['sobrenome'],
		'telefone' => $_POST['telefone'],
		'celular' => $_POST['celular'],
		'endereco' => $_POST['endereco'],
		'bairro' => $_POST['bairro'],
		'cidade' => $_POST['cidade'],
		'cep' => $_POST['cep'],
		'estado' => $_POST['estado'],
		'ip' => $_SERVER['REMOTE_ADDR']
	);
	$where = array(
		'idcadastro' => $_SESSION["idcadastro"]
	);
	$db->where($where);
	$db->update(config_item('template', 'tabela_cadastro') , $values);
	$tpl->set('atualizarSucesso', true);
	}

if (isset($_POST['enviarImagem']))
	{
	if (isset($_FILES['arquivo']['name']) && $_FILES["arquivo"]["error"] == 0)
		{
		$arquivo_tmp = $_FILES['arquivo']['tmp_name'];
		$nome = $_FILES['arquivo']['name'];

		// Pega a extensao

		$extensao = strrchr($nome, '.');

		// Converte a extensao para mimusculo

		$extensao = strtolower($extensao);

		// Somente imagens, .jpg;.jpeg;.gif;.png
		// Aqui eu enfilero as extesões permitidas e separo por ';'
		// Isso server apenas para eu poder pesquisar dentro desta highlight_string

		if (strstr('.jpg;.jpeg;.gif;.png', $extensao))
			{

			// Cria um nome único para esta imagem
			// Evita que duplique as imagens no servidor.

			$novoNome = md5(microtime()) . $extensao;

			// Concatena a pasta com o nome

			$destino = 'templates/images/img-perfil/' . $novoNome;

			// tenta mover o arquivo para o destino

			if (@move_uploaded_file($arquivo_tmp, $destino))
				{

				// depois de mover o arquivo no seu destino, agora ele grava o nome do arquivo no banco

				$values = array(
					'imagem_perfil' => $novoNome
				);
				$where = array(
					'idcadastro' => $_SESSION["idcadastro"]
				);
				$db->where($where);
				$db->update(config_item('template', 'tabela_cadastro') , $values);
				$tpl->set('ImagemEnviadaSucesso', true);
				}
			  else $tpl->set('erro_escrita', true);
			}
		  else $tpl->set('erro_imagem', true);
		}
	  else
		{
		}
	}

$tpl->set('dadosCadastro', $dadosCadastro);
$tpl->display('minha-conta');
?>