<?php require_once( 'header' . config_item('template','template_extension')); ?>
    <section class="content">
        <div class="container-fluid">
            <!-- Basic Validation -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Alterar Contato
                            </h2>
                        </div>
                        <div class="body">
                            <?php if (count($dadosContato)>
                                0): ?>
                                <?php foreach ($dadosContato as $row): ?>
                                    <?php if (isset($sucesso)): ?>
                                        <div class="alert alert-success">
                                            <strong>
                                                Contato Atualizado com sucesso
                                            </strong>
                                            <a href="alterar-contato.php?id=<?php echo $row['idcontato']; ?>" class="alert-link">clique aqui para ver alterações</a>
                                            .
                                        </div>
                                        <?php endif; ?>
                                            <form id="form_validation" method="post" action="">
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
                                                        value="<?php echo $row['nome']; ?>">
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
                                                        value="<?php echo $row['sobrenome'] ; ?>">
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
                                                        value="<?php echo $row['telefone']; ?>">
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
                                                        value="<?php echo $row['celular']; ?>">
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="material-icons">
                                                            email
                                                        </i>
                                                    </span>
                                                    <label>
                                                        Email
                                                    </label>
                                                    <div class="form-line">
                                                        <input type="text" class="form-control" name="email" placeholder="E-mail"
                                                        value="<?php echo $row['email']; ?>">
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
                                                        value="<?php echo $row['endereco']; ?>">
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
                                                        value="<?php echo $row['bairro']; ?>">
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
                                                        value="<?php echo $row['cidade']; ?>">
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
                                                        <input type="text" class="form-control" name="cep" placeholder="Cep" value="<?php echo $row['cep']; ?>">
                                                    </div>
                                                </div>
                                                <div class="input-group">
                                                    <p>
                                                        <b>
                                                            Estado UF
                                                        </b>
                                                    </p>
                                                    <select class="form-control show-tick" name="estado">
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
                                                <div class="input-group">
                                                    <div class="form-line">
                                                        <label class="form-label">
                                                            Observações
                                                        </label>
                                                        <textarea name="observacoes" cols="30" rows="5" class="form-control no-resize"
                                                        required><?php echo $row[ 'observacoes']; ?></textarea placeholder="Observações">
                                                    </div>
                                                </div>
                                                <button class="btn btn-primary waves-effect" type="submit" name="submit">
                                                    Alterar Dados
                                                </button>
                                            </form>
                                            <?php endforeach; ?>
                                                <?php else: ?>
                                                    <div class="alert alert-info">
                                                        <strong>
                                                            No momento não há nenhum contato para ser alterado
                                                        </strong>
                                                        <a href="index.php" class="alert-link">Clique aqui e volte para página principal. </a>
                                                    </div>
                                                    <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php require_once( 'footer' . config_item( 'template','template_extension')); ?>