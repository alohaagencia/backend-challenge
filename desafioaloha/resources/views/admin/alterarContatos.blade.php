@extends('templates/layout-back')

@section('breadcrumbs')
<li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
<li class="active"><a href="{{ route('contatos') }}">Gerenciar Contato</a></li>
<li class="active">Alterar Contato</li>  
@stop

@section('styles')

@stop

@section('content')
<!-- Main content -->
<!-- Default box -->
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Alterar Contato</h3>
    </div>

    <div class="box-body">
        @if ( count($errors) > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-warning alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Erros encontrados:<br />
                    <ul>
                        @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route' => ['alterarContato', $contato->id], 'method' => 'PUT', 'files' => 'true']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('nome', 'Alterar Nome:*') !!} 
                            {!! Form::text('nome', $contato->nome, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('email', 'Alterar E-mail:*') !!} 
                            {!! Form::text('email', $contato->email, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('telefone', 'Alterar Telefone:*') !!} 
                            {!! Form::text('telefone', $contato->telefone, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <label for="imagem">Imagem em destaque</label><br />
                        <img class="imagem-destaque img-responsive" src="{{ asset($contato->path .$contato->filename)}}">
                        <br />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('img', 'Alterar Imagem:*') !!} 
                            {!! Form::file('img',  ['class'=>'form-control fileinput', 'id'=>'input-6']) !!}
                        </div>
                    </div> 
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {!! Form::label('endereco', 'Alterar Endereço:*') !!} 
                            {!! Form::textarea('endereco', $contato->endereco, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        {!! Form::submit('Salvar', array('class' => 'btn btn-success')) !!}
                        <a class="btn btn-danger" href="{{ URL::to('/admin') }} ">Cancelar</a>
                    </div>
                </div>
                {!! Form::close() !!}    
            </div>
        </div>

    </div>
    <!-- /.box-body -->
</div>
<!-- /.box -->
<!-- /.content -->
@stop

@section('scripts')
<script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}" ></script>
<script src="{{ asset('dist/js/fileinput.js') }}"></script>
<script src="{{ asset('plugins/tinymce-4.3.12/tinymce.min.js') }}"></script>
<script src="{{ asset('plugins/tinymce-4.3.12/tiny.js') }}"></script>
@stop