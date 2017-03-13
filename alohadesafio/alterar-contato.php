<?php
//Include the common file
require_once('common.php');
session_start();
///Verifica se o usuário esta logado atravez da sessão
if (!isset($_SESSION["idcadastro"]))
    header("Location: login.php");


if (isset($_GET['id']))
    $idContato = $_GET['id'];
else
    $idContato = null;


foreach ($db->query("SELECT idcadastro,nome,sobrenome,telefone,celular,endereco,bairro,cidade,cep,estado,email,senha,imagem_perfil FROM " . config_item('template', 'tabela_cadastro') . " WHERE idcadastro = '" . $_SESSION["idcadastro"] . "'") as $row)
    $dadosCadastro[] = $row;


foreach ($db->query("SELECT idcontato,nome,sobrenome,telefone,celular,email,endereco,bairro,cidade,cep,estado,observacoes FROM " . config_item('template', 'tabela_contato') . " WHERE idcontato='" . $idContato . "' AND cadastro_idcadastro = '" . $_SESSION["idcadastro"] . "'") as $row)
    $dadosContato[] = $row;


if (isset($_POST['submit'])) {
    
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
        'ip' => $_SERVER['REMOTE_ADDR']
    );
    
    $where = array(
        'idcontato' => $idContato,
        // AND
        'cadastro_idcadastro' => $_SESSION["idcadastro"]
    );
    
    $db->where($where);
    $db->update(config_item('template', 'tabela_contato'), $values);
    $tpl->set('sucesso', true);
}

$tpl->set('dadosCadastro', $dadosCadastro);
$tpl->set('dadosContato', $dadosContato);
$tpl->display('alterar-contato');

?>