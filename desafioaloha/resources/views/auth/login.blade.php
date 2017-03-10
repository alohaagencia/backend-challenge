
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/buttons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/callouts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/style.css') }}">


    <title>Login - Back-end Challenge</title>
</head>

<body>

    <div class="box">
        <input type="checkbox" name="show" id="login" checked>
        {!! Form::open(['url'=>'/auth/login', 'class' => 'login']) !!} 



        <h3>Desafio Aloha</h3>
        
        <input type="email" name="email" value="" placeholder="E-mail" required>
        <input type="password" name="password" placeholder="Senha" required>

        <p>
            <button type="submit">Login</button>
        </p>
        
        {!! Form::close() !!}

        @if ($errors->any())

        <ul class="alert alert-danger">
            @foreach($errors->all() as $error)
            
            <div class="col col-12 callout warning">
            <p class="description">
                                    {{ $error }}
                            </p>
            
            <a href="#" title="Fechar" class="close icon-x js-close-callout"></a>
        </div>
            @endforeach
        </ul>
        @endif

    </div>

    <footer>
        &copy 2017 Back-end Challenge - Desenvolvido por <a href="mailto:wagner.alkmim@hotmail.com" title="Wagner" target="_blank">Wagner Alkmim</a>
    </footer>

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/events.js') }}"></script>

</body>
</html>