
<div class="row">
<div class="span12"><a href="<?php echo ($_GET['volver'] == 1) ? "/app/publicar?grupo={$_GET['grupo']}" : ""; ?>">Volver</a></div>
<form id="categoria" action="" method="POST">
<div class="span12">
	<div class="span1">Nombre</div>
	<div class="span3"><input id="nombre" name="nombre" type="text" /></div>
	<div class="span3"><input class="btn btn-success" type="submit" value="Agregar" /></div>
</div>	
</form> 
</div>


<?php if(count($data) > 0){ ?>
<div class="row">

<div class="span12">
<table class="table table-hover">
<thead>
<tr>
	<th>Nombre</th>
</tr>
</thead>
	<?php foreach($data as $row){ ?>
		<tr>
			<td><?php echo $row->nombre; ?></td>
		</tr>
		
	<?php } ?>

</table>
</div>
</div>
<?php } ?>	



<script type="text/javascript">
	$(document).ready(function(){
		
		$("#nombre").focus();
		
		$("#categoria").submit(function(){
			
			if( $.trim($("#nombre").val()) == "" ){
				alert("Debe Ingresar Categoria");
				$("#nombre").focus();
				return false;
			}
			
		})
	
	})
	
</script>