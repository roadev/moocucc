<!DOCTYPE html>
<html lang="es" class="no-js">
<!--
clase index.blade.php
@copyright 2015
-->
<head>
	<title>MOOC UCC</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" >
	<link href="{{URL::to('css/estilo.css')}}" rel="stylesheet">

	<script>
	$(function() {

		$("#boton_revisar").click( function()
		{
			$.ajax({
				url:'postquery1',
				type:'GET',
				dataType:'json',
				data: { usuario: $("#id_usuario").val(), curso: $("#id_curso").val() },
				//cache:false,
				success:function(data){
					if(data['success']) {
						var html = "<table border=1 width='100%'>";
						html+="<tr><th>Codigo</th><th>Estudiante</th><th>Curso</th><th>Valor</th><th>Fecha</th></tr>";
						$(data.records).each(function(i,item){
							html+="<tr><td>"+item.codigo+"</td><td>"+item.nombres+"</td><td>"+item.nombre+"</td><td>"+item.cantidad+"</td><td>"+item.fecha+"</td></tr>";
						});
						html+="</table>";
						$("#resultados").html(html);
					}
				}
			});
		});

	});

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
	<!-- Google analytics -->
	<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-71691218-1', 'auto');
	ga('send', 'pageview');
	</script>
	<!-- Google analytics -->
</head>

<body>
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
				<a class="btn btn-default">Buscar</a>
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

	<div class="container">
		<center>
			<header>
				<h1>MOOC UCC</h1>
			</header>
		</center>
		@if ($palabra != '')
		<h3>Cursos con las palabras: {{ $palabra }}</h3>
		@endif
		<div class="row">

		</div>
		<div class="row row_cursos">
			@foreach ($cursos as $curso)
			<a href="curso/{{ $curso->id_curso }}">

				<div class="col-md-4 col-sm-6 col-xs-12 album_list">
					<div class="div_list">
						<img class="imagen_div" src="imagenes/{{$curso->imagen_presentacion}} " >
						<div class="espaciado">
							<div class="titulo_curso">
								<h3>{{ $curso->nombre }}</h3>
							</div>

							Nivel: {{ $curso->nivel }}<br/>
							{{ $curso->getTematica() }}<br/>
							{{ $curso->getFechaInicio() }}
						</div>
					</div>
				</div>
			</a>
			@endforeach
		</div>
		<div id="resultados"></div>
		<br/>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="1" role="dialog" aria-labelledby="myModalLabel"  data-toggle="modal" data-backdrop="static" data-keyboard="false" style="background:black;">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title" id="myModalLabel"><center>Datos de Usuario</center></h4>
	      </div>
	      <div class="modal-body form-group col-md-7 col-sm-7-col-xs-7">
			Por favor completa los siguientes datos</br></br>
			<form>
				<label for="inputText" class="col-lg-12 col-sm-12 col-xs-12 control-label">Título o cargo que desempeña</label>
				<input type="text" id="input-titulo" class="form-control" placeholder="Estudiante, Profesor, Emprendedor">
				<label for="inputText" class="col-lg-12 col-sm-12 col-xs-12 control-label">Ciudad</label>
				<select id="comboboxCiudad" class="form-control" ></select>
				<label for="inputText" class="col-lg-12 col-sm-12 col-xs-12 control-label">País</label>
				<select id="comboboxPais" class="form-control" ></select>
				<label for="inputText" class="col-lg-12 col-sm-12 col-xs-12 control-label">Universidad</label>
				<select id="comboboxUniversidad" class="form-control" ></select></br>
				<button type="submit" class="btn btn-warning btn-block" id="submitdatos">Guardar Datos</button>
			</form>
	      </div>
	       <div class="modal-body form-group col-md-5 col-sm-5-col-xs-5">
			¿No aparece su universidad, ciudad o país?</br></br>
			<form>
				<input type="text" id="nombre-ciudad" name="nombre-ciudad" class="form-control" placeholder="Ciudad">
				<button type="submit" class="btn btn-primary btn-block" id="submitciudad">Registrar</button>
			</form>
			<br/>
			<form>
				<input type="text" id="nombre-pais" name="nombre-pais" class="form-control" placeholder="País">
				<button type="submit" class="btn btn-primary btn-block" id="submitpais">Registrar</button>
			</form>
			<br/>
			<form>
				<input type="text" id="nombre-universidad" name="nombre-universidad" class="form-control" placeholder="Universidad">
				<button type="submit" class="btn btn-primary btn-block" id="submituniversidad">Registrar</button>
			</form>
	      </div>
	      <div class="modal-footer">
	      </div>
	    </div>
	  </div>
	</div>

	<!-- bootstrap - js -->
	<script src= "http://code.jquery.com/jquery-2.2.0.min.js" ></script>
	<script src= "//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<!-- bootstrap - js -->

	@if (Session::get('titulo') == '' && Session::get('user_id') != '')
	<script  type="text/javascript">
		$('#myModal').modal();

		jQuery.ajax({
			url: 'listar-ciudades',
	   		success: function (result) {
				console.log('mensaje: '+result);
				$('#comboboxCiudad').html('');
				for (var i = 0; i < result.length; i++) {
					$('#comboboxCiudad').append("<option value='"+result[i].id_ciudad+"'>"+result[i].nombre+"</option>");
				}
			},
			async: true
		});

		jQuery.ajax({
			url: 'listar-paises',
	   		success: function (result) {
				console.log('mensaje: '+result);
				$('#comboboxPais').html('');
				for (var i = 0; i < result.length; i++) {
					$('#comboboxPais').append("<option value='"+result[i].id_pais+"'>"+result[i].nombre+"</option>");
				}
			},
			async: true
		});

		jQuery.ajax({
			url: 'listar-universidades',
	   		success: function (result) {
				console.log('mensaje: '+result);
				$('#comboboxUniversidad').html('');
				for (var i = 0; i < result.length; i++) {
					$('#comboboxUniversidad').append("<option value='"+result[i].id_universidad+"'>"+result[i].nombre+"</option>");
				}
			},
			async: true
		});

		$("#submitciudad").click(function(){
			if($('#nombre-ciudad').val() != ''){
				jQuery.ajax({
					url: 'agregar-ciudad',
					data: {nombre : $('#nombre-ciudad').val()},
					success: function (result) {
						$('#comboboxCiudad').html('');
						for (var i = 0; i < result.length; i++) {
							$('#comboboxCiudad').append("<option value='"+result[i].id_ciudad+"'>"+result[i].nombre+"</option>");
						}
						$('#nombre-ciudad').val('');
					},
					async: true
				});
			}
	    });

	    $("#submitpais").click(function(){
			if($('#nombre-pais').val() != ''){
				jQuery.ajax({
					url: 'agregar-pais',
					data: {nombre : $('#nombre-pais').val()},
					success: function (result) {
						$('#comboboxPais').html('');
						for (var i = 0; i < result.length; i++) {
							$('#comboboxPais').append("<option value='"+result[i].id_pais+"'>"+result[i].nombre+"</option>");
						}
						$('#nombre-pais').val('');
					},
					async: true
				});
			}
	    });

	    $("#submituniversidad").click(function(){
			if($('#nombre-universidad').val() != ''){
				jQuery.ajax({
					url: 'agregar-universidad',
					data: {nombre : $('#nombre-universidad').val()},
					success: function (result) {
						$('#comboboxUniversidad').html('');
						for (var i = 0; i < result.length; i++) {
							$('#comboboxUniversidad').append("<option value='"+result[i].id_universidad+"'>"+result[i].nombre+"</option>");
						}
						$('#nombre-universidad').val('');
					},
					async: true
				});
			}
	    });

	        $("#submitdatos").click(function(){
			if($('#input-titulo').val() != ''){
				jQuery.ajax({
					url: 'agregar-datos',
					data: {titulo : $('#input-titulo').val(), ciudad : $("#comboboxCiudad").val(), pais : $("#comboboxPais").val(), universidad :$('#comboboxUniversidad').val()  },
					success: function (result) {
						$('#myModal').modal('hide');
					},
					async: true
				});
			}
	    });

	</script>
	@endif

</body>

</html>
