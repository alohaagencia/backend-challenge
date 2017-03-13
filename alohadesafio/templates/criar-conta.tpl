<?php require_once( 'header' . config_item( 'template','template_extension')); ?>
    <body class="signup-page">
        <div class="signup-box">
            <div class="logo">
                <a>Agenda de Contatos</a>
            </div>
            <div class="card">
              <?php if (isset($falha)): ?>
                <div class="alert bg-pink alert-dismissible" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">×</span></button>
                        O e-mail digitado já está cadastrado.
                </div>
              <?php endif; ?>
                <div class="body">
                    <form id="form_validation" method="post" action="">
                        <div class="msg">
                            Novo Cadastro
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">
                                    person
                                </i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="nome" placeholder="Nome"
                                required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">
                                    person
                                </i>
                            </span>
                            <div class="form-line">
                                <input type="text" class="form-control" name="sobrenome" placeholder="SobreNome"
                                required autofocus>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">
                                    email
                                </i>
                            </span>
                            <div class="form-line">
                                <input type="email" class="form-control" name="email" placeholder="Email"
                                required>
                            </div>
                        </div>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="material-icons">
                                    lock
                                </i>
                            </span>
                            <div class="form-line">
                                <input type="password" class="form-control" name="senha" minlength="6"
                                placeholder="Senha" required>
                            </div>
                        </div>
                        <button class="btn btn-block btn-lg bg-pink waves-effect" type="submit"
                        name="submit">
                            Cadastrar
                        </button>
                        <div class="m-t-25 m-b--5 align-center">
                            <a href="login.php">Se Você já possui cadastro clique aqui</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php require_once( 'footer' . config_item( 'template','template_extension')); ?>