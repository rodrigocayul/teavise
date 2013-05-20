<!DOCTYPE html><html lang="en">
<head>
<meta charset="utf-8">
<title>TeAvise - Error 404</title>
<meta name="description" content='La plataforma de mensajeria grupal' />
<meta name="keywords" content='grupos, proyectos, mensajes, actividades, redes, publicador, publicador.cl' />
<meta name="viewport" content="width=device-width, initial-scale=1.0" >
<!-- Le styles -->
<link href="<?php echo base_url(); ?>public/lib/bootstrap/css/bootstrap.css" media="screen" rel="stylesheet" type="text/css" >
<link href="<?php echo base_url(); ?>public/lib/bootstrap/css/bootstrap-responsive.css" media="screen" rel="stylesheet" type="text/css" >

<script src="<?php echo base_url(); ?>public/js/jquery.js"></script>

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
	padding-right: 3px;
	padding-left: 3px;
	padding-top: 50px;
	text-align: center;
	padding-bottom: 50px;
}
</style>
</head>
<body>
	
	<div id="contenedor_Layout" class="container">
		
        <div class="row">
			<div class="span12">
            <a href="/"><h1>www.teAvise.cl</h1></a>
            </div>
        </div>
        
		<div class="row">
			<div class="span12">
				<h1><?php echo $heading; ?></h1>
				<?php echo $message; ?>
			</div>
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


