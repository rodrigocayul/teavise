<!DOCTYPE html><html lang="en">
<head>
<meta charset="utf-8">
<title>TeAvise - Plataforma de mensajeria</title>
<meta name="description" content='La plataforma de mensajeria grupal' />
<meta name="keywords" content='grupos, proyectos, mensajes, actividades, redes, publicador, publicador.cl' />
<meta name="viewport" content="width=device-width, initial-scale=1.0" >
<!-- Le styles -->
<link href="<?php echo base_url(); ?>public/lib/bootstrap/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" >
<link href="<?php echo base_url(); ?>public/lib/bootstrap/css/bootstrap-responsive.css" media="screen" rel="stylesheet" type="text/css" >


<link href="<?php echo base_url(); ?>public/lib/kendo/styles/kendo.common.min.css" rel="stylesheet">
<link href="<?php echo base_url(); ?>public/lib/kendo/styles/kendo.silver.min.css" rel="stylesheet">


<script src="<?php echo base_url(); ?>public/lib/kendo/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>public/lib/kendo/js/kendo.web.min.js"></script>

<script src="<?php echo base_url(); ?>public/js/detectmobilebrowser.js"></script>
<script src="<?php echo base_url(); ?>public/js/jquery.blockUI.js"></script>


<style>
#logo{
	font-weight: bold;
	font-size: 24px;
	color: #111;
}

#logo:hover{
opacity:1.0;
	filter:alpha(opacity=100); /* For IE8 and earlier */
	text-shadow: 3px 3px 3px rgba(0,0,0,0.5);
	cursor: pointer;
}

{
active;
}	
body {
	background-color: #0B0;
}
#contenedor_Layout {
	background-color: #FFF;
	margin-bottom: 20px;
}
</style>
</head>
<body>

<div id="contenedor_Layout" class="container">
	<?php
	$openLogin = false;		
	if(isset($_SERVER['REDIRECT_URL'])){ 
		if($_SERVER['REDIRECT_URL'] == "/logearse"){
			$openLogin = true;		
		}
	}
	?>
	<div id="contenedor_login" class="well" <?php echo ($openLogin == true ? '' : 'style="display:none;"' ); ?>>
		<div><h3>Acceder</h3></div>
		<form action="/cuenta/iniciar_session" method="POST" id="form_login">
			Email
			<input type="text" name="usuario" id="inputEmail" placeholder="Email">
			Password
			<input type="password" name="clave" id="inputPassword" placeholder="Password">
			<button type="submit" class="btn btn-success">Acceder</button>
		</form>
	</div>
	
	<?php 
	$session = $this->session->userdata('data'); 
	
	?>
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
			<a href="#t" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</a>
			<a id="logo" class="brand" href="/">teavise.cl</a>
			<div class="nav-collapse">
			<ul class="nav">
			
			<?php 	if(!isset($session['id'])){ ?>
			<li><a href="/grupos">Grupos</a></li>
			<li><a id="" href="/cuenta">Registrarse</a></li>
			<li><a id="login" href="#login">Acceder</a></li>
			<?php }else{?>
			<li><a href="/app/migrupo">Home</a></li>
			<li><a href="/app/nuevogrupo">Nuevo Grupo</a></li>
			<li><a href="/cuenta/salir">Salir</a></li>
			<?php } ?>
			</ul>
			</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<?php echo (isset($content) ? $this->load->view($content) : "" ); ?>
	<hr />
	<div class="span12" style="margin-bottom:10px;">
		ALOJADO EN <a href="http://panel.infranetworking.com/aff.php?aff=272" target="_blank"><img src="/public/img/infranetworking-logo.png" border="0" width="150px" /></a>
		<!--	
		DESARROLLADO POR <a href="http://siempreconectado.cl" target="_blank"><img src="/public/img/logo_siempreconectado.png" border="0" width="100px" /></a>
		-->
	</div>

</div>


<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?php echo base_url(); ?>public/lib/bootstrap/js/bootstrap-transition.js"></script>
<script src="<?php echo base_url(); ?>public/lib/bootstrap/js/bootstrap-alert.js"></script>
<script src="<?php echo base_url(); ?>public/lib/bootstrap/js/bootstrap-modal.js"></script>
<script src="<?php echo base_url(); ?>public/lib/bootstrap/js/bootstrap-dropdown.js"></script>
<script src="<?php echo base_url(); ?>public/lib/bootstrap/js/bootstrap-scrollspy.js"></script>
<script src="<?php echo base_url(); ?>public/lib/bootstrap/js/bootstrap-tab.js"></script>
<script src="<?php echo base_url(); ?>public/lib/bootstrap/js/bootstrap-tooltip.js"></script>
<script src="<?php echo base_url(); ?>public/lib/bootstrap/js/bootstrap-popover.js"></script>
<script src="<?php echo base_url(); ?>public/lib/bootstrap/js/bootstrap-button.js"></script>
<script src="<?php echo base_url(); ?>public/lib/bootstrap/js/bootstrap-collapse.js"></script>
<script src="<?php echo base_url(); ?>public/lib/bootstrap/js/bootstrap-carousel.js"></script>
<script src="<?php echo base_url(); ?>public/lib/bootstrap/js/bootstrap-typeahead.js"></script>

</body>
</html>