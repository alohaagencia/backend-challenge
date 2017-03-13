<?php require_once('header'.config_item('template','template_extension')); ?>
    <section class="content">
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Informações da Minha Conta
                            </h2>
                        </div>
                        <?php if (isset($emailsenhaSucesso)): ?>
                            <div class="alert alert-success">
                                <strong>
                                    Suas informações de Email e Senha Foram Atualizadas com sucesso
                                    <a href="minha-conta.php" class="alert-link">clique aqui para ver alterações</a>
                                </strong>
                            </div>
                            <?php endif; ?>
                                <div class="body">
                                    <form id="form_validation" method="POST">
                                        <?php foreach ($dadosCadastro as $row): ?>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">
                                                        person
                                                    </i>
                                                </span>
                                                <label>
                                                    Email
                                                </label>
                                                <div class="form-line">
                                                    <input type="text" class="form-control" name="email" placeholder="Email"
                                                    value="<?php echo $row['email']; ?>" required="">
                                                </div>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">
                                                        lock_open
                                                    </i>
                                                </span>
                                                <label>
                                                    Senha
                                                </label>
                                                <div class="form-line">
                                                    <input type="password" class="form-control" name="senha" placeholder="Digite sua Nova Senha minimo 6 caracteres"
                                                    minlength="6" required="">
                                                </div>
                                            </div>
                                            <button class="btn btn-primary waves-effect" name="emailSenha" type="submit">
                                                Atualizar
                                            </button>
                                            <?php endforeach; ?>
                                    </form>
                                </div>
                    </div>
                    <?php foreach ($dadosCadastro as $row): ?>
                        <?php if (($row[ 'telefone']=="" ) || ($row[ 'celular']=="" )) : // Esta
                        //função verifica se o usuário completou seu cadastro ?>
                            <div class="alert alert-warning alert-dismissible" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">
                                        &times;
                                    </span>
                                </button>
                                Atenção
                                <?php echo $row[ 'nome']; ?>
                                    , gostariamos que você completasse sua conta.
                            </div>
                            <?php endif; ?>
                                <?php endforeach; ?>
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                                Meus Dados Pessoais
                                            </h2>
                                        </div>
                                        <?php if (isset($atualizarSucesso)): ?>
                                            <div class="alert alert-success">
                                                <strong>
                                                    Suas informações Pessoais foram Atualizadas com sucesso.
                                                </strong>
                                                <a href="minha-conta.php" class="alert-link">clique aqui para ver alterações</a>
                                                </strong>
                                            </div>
                                            <?php endif; ?>
                                                <div class="body">
                                                    <form id="form_advanced_validation" method="POST">
                                                        <?php foreach ($dadosCadastro as $row): ?>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="material-icons">
                                                                        person
                                                                    </i>
                                                                </span>
                                                                <label>
                                                                    Nome
                                                                </label>
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" name="nome" placeholder="Nome"
                                                                    value="<?php echo $row['nome']; ?>" required="">
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="material-icons">
                                                                        person
                                                                    </i>
                                                                </span>
                                                                <label>
                                                                    Sobrenome
                                                                </label>
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" name="sobrenome" placeholder="sobrenome"
                                                                    value="<?php echo $row['sobrenome'] ; ?>" required="">
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="material-icons">
                                                                        phone
                                                                    </i>
                                                                </span>
                                                                <label>
                                                                    Telefone
                                                                </label>
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" name="telefone" placeholder="Telefone"
                                                                    value="<?php echo $row['telefone']; ?>" required="">
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="material-icons">
                                                                        phonelink_ring
                                                                    </i>
                                                                </span>
                                                                <label>
                                                                    Celular
                                                                </label>
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" name="celular" placeholder="Celular"
                                                                    value="<?php echo $row['celular']; ?>" required="">
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="material-icons">
                                                                        terrain
                                                                    </i>
                                                                </span>
                                                                <label>
                                                                    Endereço
                                                                </label>
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" name="endereco" placeholder="Endereço"
                                                                    value="<?php echo $row['endereco']; ?>" required="">
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="material-icons">
                                                                        terrain
                                                                    </i>
                                                                </span>
                                                                <label>
                                                                    Bairro
                                                                </label>
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" name="bairro" placeholder="Bairro"
                                                                    value="<?php echo $row['bairro']; ?>" required="">
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="material-icons">
                                                                        location_city
                                                                    </i>
                                                                </span>
                                                                <label>
                                                                    Cidade
                                                                </label>
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" name="cidade" placeholder="Cidade"
                                                                    value="<?php echo $row['cidade']; ?>" required="">
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="material-icons">
                                                                        map
                                                                    </i>
                                                                </span>
                                                                <label>
                                                                    Cep
                                                                </label>
                                                                <div class="form-line">
                                                                    <input type="text" class="form-control" name="cep" placeholder="Cep" value="<?php echo $row['cep']; ?>"
                                                                    required="">
                                                                </div>
                                                            </div>
                                                            <div class="input-group">
                                                                <p>
                                                                    <b>
                                                                        Estado UF
                                                                    </b>
                                                                </p>
                                                                <select class="form-control show-tick" name="estado" required="">
                                                                    <option>
                                                                        <?php echo $row[ 'estado'] ?>
                                                                    </option>
                                                                    <option value="AC">
                                                                        AC
                                                                    </option>
                                                                    <option value="AL">
                                                                        AL
                                                                    </option>
                                                                    <option value="AM">
                                                                        AM
                                                                    </option>
                                                                    <option value="AP">
                                                                        AP
                                                                    </option>
                                                                    <option value="BA">
                                                                        BA
                                                                    </option>
                                                                    <option value="CE">
                                                                        CE
                                                                    </option>
                                                                    <option value="DF">
                                                                        DF
                                                                    </option>
                                                                    <option value="ES">
                                                                        ES
                                                                    </option>
                                                                    <option value="GO">
                                                                        GO
                                                                    </option>
                                                                    <option value="MA">
                                                                        MA
                                                                    </option>
                                                                    <option value="MG">
                                                                        MG
                                                                    </option>
                                                                    <option value="MS">
                                                                        MS
                                                                    </option>
                                                                    <option value="MT">
                                                                        MT
                                                                    </option>
                                                                    <option value="PA">
                                                                        PA
                                                                    </option>
                                                                    <option value="PB">
                                                                        PB
                                                                    </option>
                                                                    <option value="PE">
                                                                        PE
                                                                    </option>
                                                                    <option value="PI">
                                                                        PI
                                                                    </option>
                                                                    <option value="PR">
                                                                        PR
                                                                    </option>
                                                                    <option value="RJ">
                                                                        RJ
                                                                    </option>
                                                                    <option value="RN">
                                                                        RN
                                                                    </option>
                                                                    <option value="RO">
                                                                        RO
                                                                    </option>
                                                                    <option value="RR">
                                                                        RR
                                                                    </option>
                                                                    <option value="RS">
                                                                        RS
                                                                    </option>
                                                                    <option value="SC">
                                                                        SC
                                                                    </option>
                                                                    <option value="SE">
                                                                        SE
                                                                    </option>
                                                                    <option value="SP">
                                                                        SP
                                                                    </option>
                                                                    <option value="TO">
                                                                        TO
                                                                    </option>
                                                                </select>
                                                            </div>
                                                            <?php endforeach; ?>
                                                                <button class="btn btn-primary waves-effect" name="atualizar" type="submit">
                                                                    Atualizar
                                                                </button>
                                                    </form>
                                                </div>
                                    </div>
                                    <div class="card">
                                        <div class="header">
                                            <h2>
                                                Enviar minha Foto de Perfil
                                            </h2>
                                        </div>
                                        <?php if (isset($ImagemEnviadaSucesso)): ?>
                                            <div class="alert alert-success">
                                                <strong>
                                                    A imagem foi enviada com sucesso
                                                </strong>
                                                <a href="minha-conta.php" class="alert-link">clique aqui para ver alterações</a>
                                                </strong>
                                            </div>
                                            <?php endif; ?>
                                                <?php if (isset($erro_escrita)): ?>
                                                    <div class="alert alert-danger">
                                                        <strong>
                                                            Não foi possivel enviar a imagem, erro de escrita no servidor. Contrate
                                                            io suporte para resolver o problema
                                                        </strong>
                                                    </div>
                                                    <?php endif; ?>
                                                        <?php if (isset($erro_imagem)): ?>
                                                            <div class="alert alert-danger">
                                                                <strong>
                                                                    Não foi possivel enviar a imagem, a imagem pode estar com o formato errado,
                                                                    só é aceito iamgens com os formatos: jpg;.jpeg;.gif;.png
                                                                </strong>
                                                            </div>
                                                            <?php endif; ?>
                                                                <div class="body">
                                                                    <form method="POST" enctype="multipart/form-data">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <i class="material-icons">
                                                                                    camera_alt
                                                                                </i>
                                                                            </span>
                                                                            <label>
                                                                                Envie sua foto de Perfil
                                                                            </label>
                                                                            <div class="form-line">
                                                                                <input class="form-control" name="arquivo" type="file" required="" />
                                                                            </div>
                                                                        </div>
                                                                        <button class="btn btn-primary waves-effect" name="enviarImagem" type="submit">
                                                                            Enviar ou Atualizar Foto
                                                                        </button>
                                                                    </form>
                                                                </div>
                                    </div>
                </div>
            </div>
            <!-- #END# Basic Validation -->
        </div>
    </section>
    <?php require_once( 'footer' . config_item( 'template',
    'template_extension')); ?>