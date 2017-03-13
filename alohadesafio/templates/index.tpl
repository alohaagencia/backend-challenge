<?php require_once( 'header' . config_item( 'template','template_extension')); ?>
    <section class="content">
        <div class="container-fluid">
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Meus Contatos
                            </h2>
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>
                                            + Detalhes
                                        </th>
                                        <th>
                                            Nome
                                        </th>
                                        <th>
                                            Telefone
                                        </th>
                                        <th>
                                            Celular
                                        </th>
                                        <th>
                                            Editar
                                        </th>
                                        <th>
                                            Excluir
                                        </th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>
                                            Detalhes
                                        </th>
                                        <th>
                                            Nome
                                        </th>
                                        <th>
                                            Telefone
                                        </th>
                                        <th>
                                            Celular
                                        </th>
                                        <th>
                                            Editar
                                        </th>
                                        <th>
                                            Excluir
                                        </th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php if (count($dadosContato)>
                                        0): ?>
                                        <?php foreach ($dadosContato as $row): ?>
                                            <tr>
                                                <td>
                                                    <button type="button" class="btn btn-default btn-circle-lg waves-effect waves-circle waves-float"
                                                    data-toggle="modal" data-target="#Dados<?php echo $row['idcontato']; ?>">
                                                        <i class="material-icons">
                                                            remove_red_eye
                                                        </i>
                                                    </button>
                                                </td>
                                                <td>
                                                    <?php echo $row[ 'nome']. " ".$row[ 'sobrenome'] ; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row[ 'telefone']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row[ 'celular']; ?>
                                                </td>
                                                <td>
                                                        <a type="submit" name="alterar" href="alterar-contato.php?id=<?php echo $row['idcontato'];?>"
                                                        class="btn bg-green btn-circle waves-effect waves-circle waves-float"><i class="material-icons">create</i></a>
                                                </td>
                                                <td>
                                                    <form  method="post">
                                                        <input type="hidden" name="idcontato" value="<?php echo $row['idcontato'];?>"
                                                        />
                                                        <button type="submit" name="excluir" class="btn bg-pink btn-circle waves-effect waves-circle waves-float">
                                                            <i class="material-icons">
                                                                clear
                                                            </i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                                <?php else: ?>
                                                    <div class="alert bg-green alert-dismissible" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">
                                                                ×
                                                            </span>
                                                        </button>
                                                        Você não Possui nenhum contato cadastrado
                                                    </div>
                                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <a type="button" class="btn btn-primary waves-effect" href="novo-contato.php">Novo Contato</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
        <?php if (isset($sucesso)): ?>
            <div class="alert alert-success">
                <strong>
                    O contato selecionado foi excluido
                </strong>
                <a href="index.php" class="alert-link">clique aqui para atualizar</a>
                .
            </div>
            <?php endif; ?>
    </section>
    <?php if (count($dadosContato)>
        0): ?>
        <?php foreach ($dadosContato as $row): ?>
            <div class="modal fade" id="Dados<?php echo $row['idcontato']; ?>" tabindex="-1"
            role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="defaultModalLabel">
                                Detalhe
                            </h4>
                        </div>
                        <div class="modal-body">
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
                                    value="<?php echo $row['nome'].' '.$row['sobrenome'] ; ?>">
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
                                        person
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
                                        <?php echo $row[ 'estado']; ?>
                                    </option>
                            </div>
                            <div class="input-group">
                                <label>
                                    Observações
                                </label>
                                <div class="form-line">
                                    <textarea name="observacoes" cols="30" rows="5" class="form-control no-resize"
                                    required><?php echo $row[ 'observacoes']; ?></textarea placeholder="Observações">
                                </div>
                            </div>
                       
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">
                                Fechar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
                <?php else: ?>
                    <?php endif; ?>
                        <?php require_once( 'footer' . config_item( 'template','template_extension')); ?>