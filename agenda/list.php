<!DOCTYPE html>
<html>
<head>
    <title>Lista de Contatos</title>
    <?php
        require_once 'head.php';
        require_once 'controller/ContatoController.php';
        $contato = new ContatoController();
    ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.delete').click(function(){
                var id = $(this).parent().parent().attr('id');
                
                if(confirm('Deseja realmente escluir o contato')){
                    var response = $('#response');
                    $.ajax({
                        type: 'POST',
                        dataType: 'json',
                        url: 'contato.php',
                        data: 'id='+id+'&action=delete',
                        success: function(data)
                        {
                            if(data.status == 'ok') {
                                response.find('span').html(data.message);
                                response.addClass('success').show();
                                setTimeout(
                                    function(){
                                        $(location).attr('href', 'list.php');
                                    }, 1500
                                );
                            }

                            response.find('span').html(data.message);
                            response.addClass('error').show();
                        }
                    });
                }
            });

            $('.update').click(function(){
                var id = $(this).parent().parent().attr('id');
                var name = $(this).closest('tr').find('td[name]').html();
                var tel = $(this).closest('tr').find('td[number]').html();

                $('#save-contato').slideUp('slow');

                $('input[name=name]').val(name);
                $('input[name=id]').val(id);
                $('input[name=fone]').val(tel);

                $('#update-contato').slideDown('slow');

            });

            $('#response a').click(function(){
                var response = $('#response'); 
                response.hide();
                response.removeClass('error');
                response.removeClass('success');
                response.find('span').html('');
            });

            $('#update-contato strong').click(function(){
                $('#update-contato').slideUp('slow');
                $('#save-contato').slideDown('slow');
            });

            $('#update-contato a').click(function(){
                var response = $('#response');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'contato.php',
                    data: $('form[name=update]').serialize(),
                    success: function(data)
                    {
                        if(data.status == 'ok') {
                            response.find('span').html(data.message);
                            response.addClass('success').show();
                            setTimeout(
                                function(){
                                    $(location).attr('href', 'list.php');
                                }, 1500
                            );
                            return;
                        }

                        response.find('span').html(data.message);
                        response.addClass('error').show();
                    }
                });
            });

            $('#save-contato a').click(function(){
                var response = $('#response');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'contato.php',
                    data: $('form[name=save]').serialize(),
                    success: function(data)
                    {
                        if(data.status == 'ok') {
                            response.find('span').html(data.message);
                            response.addClass('success').show();
                            setTimeout(
                                function(){
                                    $(location).attr('href', 'list.php');
                                }, 1500
                            );
                            return;
                        }

                        response.find('span').html(data.message);
                        response.addClass('error').show();
                    }
                });
            });
        });
    </script>
</head>
<body>

<div id="resolution" class="central">
    <div class="right">
        <?php
            echo 'Bem-vindo <b>' . $_SESSION['login']['user'] . '</b> (<a href="logout.php" title="sair">sair</a>)' 
        ?>
    </div>
    <center><h1>Lista de Contatos</h1></center>

    <div id="response">
        <a class="right" title="Fechar">x</a>
        <span><span>
    </div>

    <div id="form-contato" >
        <div id="save-contato">
            <h2>Adicionar Contato</h2>
            <form method="post" name="save">
                <input type="text" name="name" placeholder="Nome">
                <input type="text" name="fone" placeholder="Telefone">
                <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['login']['id']?>">
                <input type="hidden" name="action" value="save">
                <a class="right" id="button">Salvar</a>
            </form>
            <div id="both"></div>   
        </div>

        <div id="update-contato" class="none">
            <strong class="right" title="Cadastrar" style="cursor: pointer;">Adicionar</strong>
            <h2>Atualizar Contato</h2>
            <form method="post" name="update">
                <input type="text" name="name">
                <input type="text" name="fone">
                <input type="hidden" name="id">
                <input type="hidden" name="action" value="update">
                <a class="right" id="button">Atualizar</a>
            </form>
            <div id="both"></div>   
        </div>
    </div>

    <div id="list">
        <?php 
            $listaContato = $contato->getList();

            if(count($listaContato)) { ?>
                <table style="width:100%">
                    <tr>
                        <th>Nome</th>
                        <th>Telefone</th> 
                        <th>Ações</th>
                    </tr>
                    <?php foreach($listaContato as $contato) {?>
                        <tr>
                            <td name><?php echo $contato->name ?></td>
                            <td number class="number"><?php echo $contato->fone ?></td> 
                            <td class="action" id="<?php echo $contato->id ?>">
                                <b><a class="update" title="Editar">Editar</a> | <a class="delete" title="Excluir">Excluir</a></b>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
        <?php } ?>
    </div>
</div>

</body>
</html>