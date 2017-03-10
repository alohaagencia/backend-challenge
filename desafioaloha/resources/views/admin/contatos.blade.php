@extends('templates/layout-back')

@section('breadcrumbs')
<li><a href="{{ route('admin')}}"><i class="fa fa-dashboard"></i> Admin</a></li>
<li class="active">Gerenciar Contatos</li>
@stop

@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('css/form.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/lightGallery/dist/css/lightgallery.css') }}" />
@stop

@section('content')
<!-- Main content -->
<!-- Default box -->
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Contatos Cadastrados</h3>
	</div>

	<div class="box-body">

		<div class="row">
			<div class="col-md-12">
				@if(Session::get("mensagem"))
				<div class="alert alert-success alert-dismissible">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
					{{Session::get("mensagem")}}
				</div>
				@endif
			</div>
		</div>

		<a href="{{ route('criarContato') }}"  class="btn-sm btn-success"><i class="fa fa-plus-square"></i> Novo Contato</a><br>

		<table class="table table-bordered table-condensed table-hover">
			<br>
			<thead>
				<tr>
					<th>#</th>
					<th>Nome</th>
					<th>Endereço</th>
					<th>Email</th>
					<th>Telefone</th>
					<!-- <th>Imagem</th> -->
					<th>Ações</th>
				</tr>
			</thead>

			<tbody>
				@if(count($contatos)<=0)
				<tr><td colspan="6">{{ "Não existem contatos cadastrados."}}</td></tr>
				@else
				@foreach($contatos as $contato)
				<tr>
					<td>{{ $contato->id }}</td>
					<td>{{ $contato->nome }}</td>
					<td>{!! $contato->endereco !!}</td>
					<td>{{ $contato->email }}</td>
					<td>{{ $contato->telefone }}</td>
					<!-- <td>{{ $contato->filename }}</td> -->
					<td>
						{!! Form::open(['route' => ['editarContato', $contato->id], 'method' => 'GET', 'class' => 'form-display']) !!} 
						<button type="submit" title="Editar Contato" class="btn btn-info btn-xs flutuar"><i class="fa fa-edit"></i> Editar </button>
						{!! Form::close() !!}
						{!! Form::open(['route' => ['excluirContato', $contato->id], 'method' => 'POST', 'class' => 'form-display']) !!} 
						<button type="submit" title="Excluir Contato" class="btn btn-danger btn-xs flutuar"><i class="fa fa-remove"></i> Excluir </button>
						{!! Form::close() !!}
						{!! Form::open( array( "class" => "form-display") ) !!}
						<div class="aniimated-thumbnials">
							<a href="{{ asset($contato->path . $contato->filename) }}" class="btn btn-success btn-xs flutuar "><i class="fa fa-eye" > </i> Visualizar
							</a>
						</div>
						{!! Form::close() !!}
					</td>
				</tr>
				@endforeach
				@endif

			</tbody>
		</table>
	</div>
	<!-- /.box-body -->
</div>
<!-- /.box -->
<!-- /.content -->
@endsection

@section('scripts')
<script src="{{ asset('plugins/lightGallery/dist/js/lightgallery.min.js') }}"></script>
<script src="{{ asset('dist/js/createImagens.js') }}"></script>
@stop
