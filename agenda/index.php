<!DOCTYPE html>
<html>
<head>
    <title>Agenda Online</title>
    <?php require_once 'head.php' ?>
    <script type="text/javascript">

        function clearResponse(response){
            response.removeClass('error');
            response.removeClass('success');    
        }

        $(document).ready(function(){
            $('#response a').click(function(){
                var response = $('#response'); 
                response.hide();
                clearResponse(response);
                response.find('span').html('');
            });

            $('#login a').click(function(){
                var response = $('#response');
                clearResponse(response);
                $('form[name=save] input').val('');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'login.php',
                    data: $('form[name=login]').serialize(),
                    success: function(data)
                    {
                        if(data.status == 'ok') {
                            $(location).attr('href', 'list.php');
                            return;
                        }
                        response.find('span').html(data.message);
                        response.addClass('error').show();
                    }
                });
            });

            $('#register a').click(function(){
                var response = $('#response');
                clearResponse(response);
                $('form[name=login] input').val('');
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: 'login.php',
                    data: $('form[name=save]').serialize(),
                    success: function(data)
                    {
                        if(data.status == 'ok') {
                            alert('Usuario cadastrado com sucesso, efetue o login.')
                            $(location).attr('href', 'index.php');
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
    <center><h1>Agenda Online</h1></center>
    <div id="response">
        <a class="right" title="Fechar">x</a>
        <span></span>
    </div>
    <div id="login" class="left">
        <h2>Login</h2>
        <form method="post" name="login">
            <input type="text" name="login" placeholder="login">
            <input type="password" name="senha" placeholder="Senha">
            <input type="hidden" name="action" value="login">
            <a class="right" id="button">Login</a>
        </form>
    </div>
    <div id="register" class="left">
        <h2>Criar Conta</h2>
        <form method="post" name="save">
            <input type="text" name="login" placeholder="Login">
            <input type="password" name="senha" placeholder="Senha">
            <input type="hidden" name="action" value="save">
            <a class="right" id="button">Criar</a>
        </form>
    </div>
</div>

</body>
</html>