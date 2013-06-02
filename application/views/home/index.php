<div class="row">
	<div class="span12" style="background:url('/public/img/fondo.jpg');padding-bottom: 40px;padding-top: 40px;">
			<div class="span12 color_text_blanco lasombra"><h1>Crea tu Grupo</h1><h4>Puedes Crear tu GRUPO DE CURSO y <br/>compartir información entre tus compañeros:</h4></div>
			<div class="span3" style="margin-bottom:10px;"><a href="/hauth/login/Facebook" class="zocial facebook">Conectar con Facebook</a></div>
			<div class="span5"><a href="/hauth/login/Google" class="zocial googleplus">Conectar con Google+</a></div>
	</div>
</div>

<div class="row">
	<div class="span12 color_text_blanco lasombra" style="background-color: #0B0;margin-top:10px;">
		<h1 id="eslogan">Grupos Recientes</h1>
	</div>
	
	<div class="span12">
		<ul class="nav nav-pills nav-stacked">
		  <?php foreach ($secciones as $row) : ?>
		  <li><a href="/grupo/<?php echo $row->nombre; ?>"><h4><?php echo $row->nombre; ?></h4></a></li>
		  <?php endforeach; ?>
		</ul>
	</div>	
</div>

<script type="text/javascript">

function ClassUtil(){
	
	this.loading = function(){
		$.blockUI({ 
			message: '<img src="/public/img/loading_ajax.gif" />',
			css: { 
				border: 'none', 
				padding: '15px', 
				backgroundColor: '#fff', 
				'-webkit-border-radius': '10px', 
				'-moz-border-radius': '10px', 
				opacity: .9, 
				color: '#fff' 
			} 
		}); 
	}	
	
	this.unloading = function(){
		$.unblockUI();
	}
}


$(document).ready(function(){
	
	util = new ClassUtil();

});

</script>