<!DOCTYPE html><html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo (isset($title) ? $title : "TeAvise - Plataforma de mensajeria" ); ?></title>
<meta name="description" content='La plataforma de mensajeria grupal' />
<meta name="keywords" content='grupos, proyectos, mensajes, actividades, redes, publicador, publicador.cl' />
<meta name="viewport" content="width=device-width, initial-scale=1.0" >
<!-- Le styles -->
<link href="<?php echo base_url(); ?>public/lib/bootstrap/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" >
<link href="<?php echo base_url(); ?>public/lib/bootstrap/css/bootstrap-responsive.css" media="screen" rel="stylesheet" type="text/css" >

<!--<link href="<?php echo base_url(); ?>public/css/estilo.css" media="screen" rel="stylesheet" type="text/css" >-->
<link href="<?php echo base_url(); ?>public/lib/social-buttons/css/zocial.css" media="screen" rel="stylesheet" type="text/css" >


<script src="<?php echo base_url(); ?>public/js/jquery.js"></script>
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
	text-box: 3px 3px 3px rgba(0,0,0,0.5);
	cursor: pointer;
}
	#contenedor_Layout {
		background-color: #FFF;
		margin-bottom: 20px;
	}

.lasombra{
	
	color:#FFFFFF;
	text-shadow: 5px 5px 5px rgba(0,0,0,1);
	size:30px;
}	

.color_text_blanco{
	color:#FFFFFF;
}

</style>
</head>
<body>

<div class="container">
	<?php
	$openLogin = false;		
	if(isset($_SERVER['REDIRECT_URL'])){ 
		if($_SERVER['REDIRECT_URL'] == "/logearse"){
			$openLogin = true;		
		}
	}
	?>
	
	<?php 	$session = $this->session->userdata('data'); ?>
	
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</a>
			<a id="logo" class="brand" href="/" title="teavise"><img src="/public/img/teavise.png" /></a>
			<div class="nav-collapse">
				<ul class="nav">
					<?php 	if(!isset($session['id'])){ ?>
					<li><a href="/grupos">Grupos</a></li>
					<li><a href="/como-funciona">¿Como Funciona?</a></li>
					<li><a href="/login">Login</a></li>
					<?php }else{?>
					<li><a href="/app/migrupo">Mi Grupos</a></li>
					<li><a href="/app/publicar">Publicar</a></li>
					<li><a href="/cuenta/salir">Salir</a></li>
					<?php } ?>
				</ul>
			</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<?php echo (isset($content) ? $this->load->view($content) : "" ); ?>
	

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