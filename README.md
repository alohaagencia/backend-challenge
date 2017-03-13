# (Back-end Challenge) Aloha Agência

Simples Agenda de Contatos Desenvolvido com Php, Mysql, utilizando como interface Front-end do Painel de Administração  [AdminBSBMaterialDesign](https://github.com/gurayyarar/AdminBSBMaterialDesign) , baseado no Bootstrap 3.x com Material Design.

O desafio proposto foi:
* O usuário deve efetuar o cadastro ou login para ter acesso a lista de contatos.
* O usuário só pode visualizar e interagir com a sua própria lista de contatos.
* Adicionar novos contatos a lista.
* Editar contatos na lista.
* Excluir contatos da lista.
* Fazer logout.


Para instalar e testar a aplicação, você deve ter instalado no seu pc Windows ou Linux o Easy Php,Wamp Server,Xampp, UsbServer dentre outros.
Instalado um desses programas, entre na interface phpMyadmin que vem neles e crie um usuário e senha e um nome de banco de dados. Em seguida pegue o arquivo da pasta chamado banco.sql e importe ele com a ferramenta importar, do phpMyAdmin e pronto. Caso você deseje, você pode copiar o script abaixo e selecionar a aba SQL do phpMyadmin e colar o script abaixo e executar para criar as tabelas. Feito isso a sua base de dados foi criada.

```sql

DROP TABLE IF EXISTS `cadastro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cadastro` (
  `idcadastro` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `cidade` varchar(80) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `estado` varchar(40) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `senha` varchar(40) NOT NULL,
  `imagem_perfil` varchar(40) DEFAULT NULL,
  `data_cadastro` datetime NOT NULL,
  `ip` varchar(10) NOT NULL,
  PRIMARY KEY (`idcadastro`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

DROP TABLE IF EXISTS `contato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contato` (
  `idcontato` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  `sobrenome` varchar(50) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) NOT NULL,
  `email` varchar(80) DEFAULT NULL,
  `endereco` varchar(100) DEFAULT NULL,
  `bairro` varchar(80) DEFAULT NULL,
  `cidade` varchar(80) DEFAULT NULL,
  `cep` varchar(9) DEFAULT NULL,
  `estado` varchar(40) DEFAULT NULL,
  `observacoes` mediumtext,
  `cadastro_idcadastro` int(11) NOT NULL,
  `data_cadastro` datetime DEFAULT NULL,
  `ip` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idcontato`),
  KEY `fk_contato_cadastro_idx` (`cadastro_idcadastro`),
  CONSTRAINT `fk_contato_cadastro` FOREIGN KEY (`cadastro_idcadastro`) REFERENCES `cadastro` (`idcadastro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

```

Agora copie todos os arquivos da pasta alohadesafio para o diretório do servidor local (Wamp Server, EasyPhp ou outro de sua preferencia) e em seguida abra-o o arquivo database.php que esta na pasta \config, e edite conforme esta nas configurações do seu banco Msql
Exemplo:
```php
<?php if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) exit('No direct access allowed.');

$config['hostname'] = '127.0.0.1';//endereço do banco
$config['username'] = 'root';//nome do usuário do banco
$config['password'] = '';//senha do banco 
$config['dbname'] = 'listacontatos';//nome do banco
$config['driver'] = 'mysql';
$config['char_set'] = 'utf8';

?>
```

Feito isso, e só abrir a Url do seu browser e digitar [localhost](http://localhost/), ou [127.0.0.1](http://127.0.0.1) ou o ip que esta no seu servidor local e pronto. A aplicação abrirá e funcionará.
Caso deseje ver um exemplo da aplicação funcionando [clique aqui](http://www.triazuz.com.br/alohadesafio).

Obrigado a todos por enquanto....

Ronaldo Gomes Carvalho.