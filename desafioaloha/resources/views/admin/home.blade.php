@extends('templates/layout-back')

@section('styles')

@endsection

@section('breadcrumbs')
<li><a href="{{ route('admin') }}"><i class="fa fa-dashboard"></i> Admin</a></li>
@endsection

@section('content')
<!-- Main content -->
<div class="row">
	<!-- gride col-md-3 -->
	<div class="col-md-3">
		<!-- small box -->
		<div class="small-box bg-aqua">
			<div class="inner">
				<h3>{{ count($contatos) }}</h3>
				<p>Gerenciar Contatos</p>
			</div>
			<div class="icon">
				<i class="ion ion-ios-gear"></i>
			</div>
			<a href="{{ route('contatos') }}" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
		</div>
		<!-- /.small box -->
	</div>
	<!-- ./col -->	
	<!-- gride col-md-3 -->
	<div class="col-md-3">
		<!-- small box -->
		<div class="small-box bg-yellow">
			<div class="inner">
			<h3>+</h3>
				<p>Cadastrar Contato</p>
			</div>
			<div class="icon">
				<i class="ion ion-person-add"></i>
			</div>
			<a href="{{ route('criarContato') }}" class="small-box-footer">Acessar <i class="fa fa-arrow-circle-right"></i></a>
		</div>
		<!-- /.small box -->
	</div>
	<!-- ./col -->
</div>
<!-- /.content -->
@endsection

@section('scripts')

@endsection