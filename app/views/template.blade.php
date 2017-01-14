<!DOCTYPE html>
<html lang="es" class="no-js">
<!--
  clase index.blade.php
  @copyright 2015
-->
<head>
	<title>@yield('title', 'MOOC UCC')</title></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" >
	<link href="{{URL::to('css/estilo.css')}}" rel="stylesheet">
	<script src="{{URL::to('js/tinymce/tinymce.min.js')}}"></script>
	<script>tinymce.init({
		language : "es_MX",
		selector:'textarea',
		image_caption: true,
		plugins: [
        "advlist autolink lists link charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste imagetools jbimages image"
    ],
		relative_urls: false,

		//image_list: "/listar-imagenes",
		//images_upload_url: 'postAcceptor.php',
		 images_upload_base_path: '/some/basepath',
		 images_upload_credentials: true,
		image_prepend_url: "http://mooc-roadev.rhcloud.com/imagenes/",
		image_description: false,
		toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link jbimages",
  	imagetools_cors_hosts: ['http://mooc-roadev.rhcloud.com/imagenes/']

	});</script>
	<!-- js -->

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	  ga('create', 'UA-71691218-1', 'auto');
	  ga('send', 'pageview');
	</script>
</head>

<body class="body_div">

	<!--Header Start Here-->
	<header>
	<nav class="navbar navbar-default" role="navigation">
	  <!-- El logotipo y el icono que despliega el menú se agrupan
	       para mostrarlos mejor en los dispositivos móviles -->
	  <div class="navbar-header">
	    <button type="button" class="navbar-toggle" data-toggle="collapse"
	            data-target=".navbar-ex1-collapse">
	      <span class="sr-only">Desplegar navegación</span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	      <span class="icon-bar"></span>
	    </button>
			<a class="navbar-brand" href="{{ URL::route('index') }}" style="padding: 0 15px;"><img src="{{URL::to('imagenes/logo.png')}}" width="50px" style="position:relative; top:6px;"></a>
	  </div>

		  <!-- Agrupar los enlaces de navegación, los formularios y cualquier
		       otro elemento que se pueda ocultar al minimizar la barra -->
		  <div class="collapse navbar-collapse navbar-ex1-collapse navbar_back">
		    <ul class="nav navbar-nav">
		<!--
		     <li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					Temas <b class="caret"></b>
				</a>
				<ul class="dropdown-menu">
					<li><a href="#"></a></li>
					<li class="divider"></li>
					<li><a href="#"></a></li>
					<li class="divider"></li>
					<li><a href="#"></a></li>
				</ul>
			 </li>
		-->
		    </ul>

		    <form class="navbar-form navbar-left" role="search" action="{{ URL::route('index') }}" method="POST">
		      <div class="form-group">
		        <input type="text" id="texto-buscar" name="texto-buscar" class="form-control" placeholder="Buscar">
		      </div>
		      <button type="submit" class="btn btn-default">Buscar</button>
		    </form>

		    <ul class="nav navbar-nav navbar-right">
			  @if (Session::get('tipo_usuario') == "Administrador")
		       <li><a href="{{ URL::route('administrador')}}">Panel Administrador</a></li>
		       @endif
		      @if (Session::get('user') != "")
					<li><a href="{{ URL::route('chat') }}">Chat</a></li>
					<li><a href="{{ URL::route('mis-badges') }}">Mis Badges</a></li>
					<li><a href="{{ URL::route('mis-cursos') }}">Mis Cursos</a></li>
				<li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
		          {{ Session::get('user') }}<b class="caret"></b>
		        </a>
		        <ul class="dropdown-menu">
		          <li><a href="{{ URL::route('usuario', Session::get('user_id') ) }}">Mi Perfil</a></li>
		          <li class="divider"></li>
		          <li><a href="{{ URL::route('logout')}}">Salir</a></li>
		        </ul>
		      </li>
		      @else
		      <li class="dropdown">
		        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
						<ul id="login-dp" class="dropdown-menu">
							<li>
								 <div class="row">
										<div class="col-md-12">
											<center>
												Login via
												<div class="social-buttons">
													<a href="{{ URL::route('login-facebook') }}" class="btn btn-fb"><i class="fa fa-facebook"></i> Facebook</a><br><br>
													<a href="{{ URL::route('login-twitter') }}" class="btn btn-tw"><i class="fa fa-twitter"></i> Twitter</a><br><br>
													<a href="{{ URL::route('login-google') }}" class="btn btn-gp"><i class="fa fa-google"></i> Google +</a><br><br>
												</div>
			                </center>
										</div>
								 </div>
							</li>
						</ul>
		      </li>
		      @endif
		    </ul>
		  </div>
		</nav>
	</header>

	<div class="container" style="position:relative; top:-30px;">
		<!--
			<center><h1>@yield('title_div', 'MOOC UCC')</h1></center>
		-->
		<!-- Extended content here -->
		@yield('contenido', '')

	</div>

	<!-- bootstrap - js -->
	<script src= "http://code.jquery.com/jquery-2.2.0.min.js" ></script>
	<script src= "//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<!-- bootstrap - js -->

	<script>
    $(document).ready(function() {
      var sideslider = $('[data-toggle=collapse-side]');
      var sel = sideslider.attr('data-target');
      var sel2 = sideslider.attr('data-target-2');
      sideslider.click(function(event){
        $(sel).toggleClass('in');
        $(sel2).toggleClass('out');
      });
		});
	</script>

</body>

</html>
