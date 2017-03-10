@extends('templates/layout-back')

@section('breadcrumbs')
<li><a href="{{ route('admin')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
<li class="active"><a href="{{ route('contatos')}}">Gerenciar Contato</a></li>
<li class="active">Novo Contato</li>
@endsection

@section('styles')

@endsection

@section('content')
<!-- Main content -->
<!-- Default box -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Novo Contato</h3>
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
				{!! Form::open(['route' => 'salvarContato', 'method' => 'POST', 'files' => true]) !!}
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							{!! Form::label('nome', 'Cadastrar Nome:*') !!} 
							{!! Form::text('nome', null, ['class'=>'form-control']) !!}
						</div>
					</div>
				</div> 
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('email', 'Cadastrar E-mail:*') !!} 
							{!! Form::text('email', null, ['class'=>'form-control']) !!}
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							{!! Form::label('telefone', 'Cadastrar Telefone:*') !!} 
							{!! Form::text('telefone', null, ['class'=>'form-control']) !!}
						</div>
					</div>
				</div> 
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							{!! Form::label('img', 'Cadastrar Imagem:*') !!} 
							{!! Form::file('img',  ['class'=>'form-control fileinput', 'id'=>'input-6']) !!}
						</div>
					</div> 
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							{!! Form::label('endereco', 'Cadastrar Endereço:*') !!} 
							{!! Form::textarea('endereco', null, ['class'=>'form-control']) !!}
						</div>
					</div>
				</div> 

				<div class="row">
					<div class="col-md-12">
						{!! Form::submit('Salvar', array('class' => 'btn btn-success')) !!}
						<a class="btn btn-danger" href="{{ route('admin') }} ">Cancelar</a>
					</div>
				</div>
				{!! Form::close() !!}    
			</div>
		</div>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.content -->
@endsection

@section('scripts')
<script src="{{ asset('plugins/bootstrap-fileinput/js/fileinput.min.js') }}" ></script>
<script src="{{ asset('dist/js/fileinput.js') }}"></script>
<script src="{{ asset('plugins/tinymce-4.3.12/tinymce.min.js') }}"></script>
<script src="{{ asset('plugins/tinymce-4.3.12/tiny.js') }}"></script>
@endsection