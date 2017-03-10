
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin - Back-end Challenge</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">

    @yield('styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="hold-transition skin-blue sidebar-mini">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- main header -->
		<header class="main-header">
			<!-- Logo -->
			<a href="{{ route('admin')}}" class="logo">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>Aloha</span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>Back-end Wagner</span>
			</a>
			<!-- Header Navbar: style can be found in header.less -->
			<nav class="navbar navbar-static-top">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<!-- logout -->
				<div class="navbar-custom-menu">
					<ul class="nav navbar-nav">
						<li >
							<a href="{{ route('logout') }}" ">
								<span class="hidden-xs">Sair</span>
							</a>
							<ul class="dropdown-menu">
							</ul>
						</li>
					</ul>
				</div>
				<!-- /.logout -->
			</nav>
		</header>
		<!-- /.main header -->

		<!-- =============================================== -->

		<!-- Left side column. contains the sidebar -->
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li class="header">Navegação Principal</li>
					<!-- Gerenciar Contatos -->
					<li>
						<a href="{{ route('contatos') }}">
							<i class="fa fa-circle-o"></i> 
							<span>Gerenciar Contatos</span>
						</a>
					</li>
					<!-- /.Gerenciar Contatos -->
					<!-- Gerenciar Contatos -->
					<li>
						<a href="{{ route('criarContato') }}">
							<i class="fa fa-circle-o"></i> 
							<span>Cadastrar Contato</span>
						</a>
					</li>
					<!-- /.Gerenciar Contatos -->
				</ul>
				<!-- /.sidebar menu -->
			</section>
			<!-- /.sidebar -->
		</aside>

		<!-- =============================================== -->       


		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<section class="content-header">
				<ol class="breadcrumb">
					@yield('breadcrumbs')
				</ol>
			</section>

			<section class="content">
				@yield('content')  
			</section>
		</div>
		<!-- /.content-wrapper -->

		<!-- Footer  -->
		<footer class="main-footer">
			<div class="pull-right hidden-xs">
				<b>Versão</b> 1.0.0
			</div>
			<strong>&copy 2017 Back-end Challenge - Desenvolvido por <a href="mailto:wagner.alkmim@hotmail.com" title="Wagner" target="_blank">Wagner Alkmim</a></strong>
		</footer>
		<!-- /.footer -->

	</div>
	<!-- ./wrapper -->

	<!-- jQuery 2.2.3 -->
	<script src="{{ asset('plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
	<!-- SlimScroll -->
	<script src="{{ asset('plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
	<!-- FastClick -->
	<script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('dist/js/app.min.js') }}"></script>
	<!-- AdminLTE for demo purposes -->
	<script src="{{ asset('dist/js/demo.js') }}"></script>

	@yield('scripts')

</body>
</html>
