<!DOCTYPE html>
<html>
    
    <head>
        <meta charset="UTF-8">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"
        name="viewport">
        <title>
            <?php echo config_item('template', 'site_titulo'); ?>
        </title>
        <!-- Favicon-->
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext"
        rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"
        type="text/css">
        <!-- Bootstrap Core Css -->
        <link href="<?php echo config_item('template', 'site_url'); ?>templates/plugins/bootstrap/css/bootstrap.css"
        rel="stylesheet">
        <!-- Waves Effect Css -->
        <link href="<?php echo config_item('template', 'site_url'); ?>templates/plugins/node-waves/waves.css"
        rel="stylesheet" />
        <!-- Animation Css -->
        <link href="<?php echo config_item('template', 'site_url'); ?>templates/plugins/animate-css/animate.css"
        rel="stylesheet" />
        <!-- JQuery DataTable Css -->
        <link href="<?php echo config_item('template', 'site_url'); ?>templates/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css"
        rel="stylesheet">
        <!-- Bootstrap Select Css -->
        <link href="<?php echo config_item('template', 'site_url'); ?>templates/plugins/bootstrap-select/css/bootstrap-select.css"
        rel="stylesheet" />
        <!-- Custom Css -->
        <link href="<?php echo config_item('template', 'site_url'); ?>templates/css/style.css"
        rel="stylesheet">
        <!-- AdminBSB Themes. You can choose a theme from css/themes instead of
        get all themes -->
        <link href="<?php echo config_item('template', 'site_url'); ?>templates/css/themes/all-themes.css"
        rel="stylesheet" />
    </head>
    <?php if (isset($_SESSION[ "idcadastro"])): //Verifica variavel sessão,
    //se variavel sessão existir ele exibe o menu somente para os cadastrados ?>
        
        <body class="theme-cyan">
            <!-- Page Loader -->
            <div class="page-loader-wrapper">
                <div class="loader">
                    <div class="preloader">
                        <div class="spinner-layer pl-red">
                            <div class="circle-clipper left">
                                <div class="circle">
                                </div>
                            </div>
                            <div class="circle-clipper right">
                                <div class="circle">
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>
                        Carregando Aguarde...
                    </p>
                </div>
            </div>
            <!-- #END# Page Loader -->
            <!-- Overlay For Sidebars -->
            <div class="overlay">
            </div>
            <!-- #END# Overlay For Sidebars -->
            <!-- Search Bar -->
            <div class="search-bar">
                <div class="search-icon">
                    <i class="material-icons">
                        search
                    </i>
                </div>
                <input type="text" placeholder="START TYPING...">
                <div class="close-search">
                    <i class="material-icons">
                        close
                    </i>
                </div>
            </div>
            <!-- #END# Search Bar -->
            <!-- Top Bar -->
            <nav class="navbar">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a href="javascript:void(0);" class="bars"></a>
                        <a class="navbar-brand" href="index.php"><i class="material-icons">import_contacts</i> Lista de Contatos</a>
                    </div>
                </div>
            </nav>
            <section>
                <!-- Left Sidebar -->
                <aside id="leftsidebar" class="sidebar">
                    <!-- User Info -->
                    <div class="user-info">
                        <?php foreach ($dadosCadastro as $row): ?>
                            <div class="image">
                                <img src="<?php echo config_item('template', 'site_url'); ?>templates/images/img-perfil/<?php echo $row['imagem_perfil']; ?>"
                                width="48" height="48" alt="User" />
                            </div>
                            <div class="info-container">
                                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <?php echo $row[ 'nome']. " ".$row[ 'sobrenome'] ; ?>
                                </div>
                                <div class="email">
                                    <?php echo $row[ 'email']; ?>
                                </div>
                                <div class="btn-group user-helper-dropdown">
                                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="true">
                                        keyboard_arrow_down
                                    </i>
                                    <ul class="dropdown-menu pull-right">
                                        <li>
                                            <a href="minha-conta.php"><i class="material-icons">person</i>Minha Conta</a>
                                        </li>
                                        <li role="seperator" class="divider">
                                        </li>
                                        <li>
                                            <a href="?sair"><i class="material-icons">input</i>Sair</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <?php endforeach; ?>
                    </div>
                    <!-- #User Info -->
                    <!-- Menu -->
                    <div class="menu">
                        <ul class="list">
                            <li class="header">
                                Menu
                            </li>
                            <li>
                                <a href="index.php">
                            <i class="material-icons home">contacts</i>
                            <span>Meus Contatos</span>
                        </a>
                            </li>
                        </ul>
                    </div>
                    <!-- #Menu -->
                    <div class="legal">
                        <div class="copyright">
                            Original de
                            <a href="https://github.com/gurayyarar/AdminBSBMaterialDesign">AdminBSB - Material Design</a>
                            .
                        </div>
                        <div class="version">
                            <b>
                                Modificado por Ronaldo Versão:
                            </b>
                            1.0
                        </div>
                    </div>
                    <!-- #Footer -->
                </aside>
            </section>
            <?php else: ?>
                <?php endif; ?>