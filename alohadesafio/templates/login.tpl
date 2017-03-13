<?php require_once('header'. config_item('template','template_extension')); ?>
    
    <body class="signup-page theme-cyan">
        <div class="signup-box">
            <div class="logo">
                <a>Agenda de Contatos</a>
            </div>
            <div class="card">
            <?php if (isset($falha)): ?>
            <div class="alert bg-pink alert-dismissible" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">×</span></button>
                    Email ou senha inválidos!
            </div>
            <?php endif; ?>
                <div class="body">
                    <form id="form_validation" method="POST">
                        <div class="msg">
                            Entrar na Minha Conta
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">
                                    person
                                </i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="email" placeholder="Email"
                                required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">
                                    lock
                                </i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="senha" placeholder="Senha"
                                required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <button class="btn btn-block bg-pink waves-effect" name="logar" type="submit">
                                    Entrar
                                </button>
                            </div>
                        </div>
                        <div class="row m-t-15 m-b--20">
                            <div class="col-xs-6">
                                <a href="criar-conta.php">Não Possui Conta</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php require_once('footer'.config_item('template','template_extension')); ?>