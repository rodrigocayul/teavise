<div class="row">

	<div class="span12">
		<ul class="breadcrumb">
			<li><a href="/grupos">Grupos</a> <span class="divider">/</span></li>
			<li class="active"><?php echo $grupo; ?></li>
		</ul>
	</div>

	<div class="span9">
	<!--Body content-->
	<h3>Material Publicado</h3>
	Categoria: 
	<select id="filtro" class="span6" >
	<option value=""> Todos </option>
	<?php foreach($materiales as $row_materiales): ?>
	<option value="<?php echo $row_materiales->id; ?>"><?php echo $row_materiales->nombre; ?></option>
	<?php endforeach; ?>	
	</select>
	
	<!-- Lista -->
	<table class="table table-hover">
		<thead>
		<tr>
			<th>Titulo</th>
			<th>Categoria</th>
			<th></th>
		</tr>		
		</thead >
		<tbody id="show_content">
		<?php foreach($contenidos as $row): ?>
		<tr>
			
			<td><?php echo $row->nombre; ?> <br />Publicado <?php echo $row->fecha; ?></td>
			<td><?php echo $row->materiale_id; ?></td>
			<td><a class="btn" href="/detalle/<?php echo $row->id; ?>" >Detalle</a></td>
		</tr>
		<?php endforeach; ?>
		</tbody>
	</table>
	</div>
	
	<div class="span3">
	<!--Sidebar content-->
		<!-- Suscriptores -->
		<form id="suscriptor" method="POST">
				<legend>Suscriptor</legend>
				<label>Correo Electronico</label>
				<div class="input-prepend">
					<span class="add-on">@</span><input id="correo_suscriptor" class="" name="correo_suscriptor" type="text" placeholder="tu correo" />
				</div>		
				<br />
				<input type="hidden" name="seccione_id" value="<?php echo $seccione_id; ?>" />
				<button type="submit" class="btn btn-large btn-success">Suscribir</button>
		</form>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	
	$("#filtro").change(function(){
		
		var secc 	= <?php echo $seccione_id; ?>;
		var filtro 	= $(this).val();
		
		$('#show_content').html("");
		$('#show_content').html('<div style="margin-top:30px"><img src="/public/img/loading_ajax.gif" /></div>');
		
		$.ajax({
			type: "POST",
			url: "/publicador/ajaxseccion",
			data: {s: secc , f: filtro} ,
			dataType: 'text', 
			cache: false,
			async: true,
			success: function(data){
				$('#show_content').attr('display','none');
				$('#show_content').html(data);
				
			}
		});
		
	
	});
	
	$('#suscriptor').submit(function(){
		if( $.trim($('#correo_suscriptor').val()) == "" ){
			alert("Debe Ingresar Correo");
			$('#correo_suscriptor').focus();
			return false;
		}
		
		$.ajax({
			type: "POST",
			url: "/publicador/agregarsusacriptor",
			data: $(this).serialize() ,
			dataType: 'text', 
			cache: false,
			async: false,
			success: function(data){
				if(data == 1){
					alert("Ya te encuentras suscrito a este grupo");
				}
				if(data == 2){
					alert("Agregado con Exito");
					$('#correo_suscriptor').val('');
				}		
				if(data == 3){
					alert("Correo no valido");
					$('#correo_suscriptor').focus();
				}
			}
		});
		
		return false;
	});

});
</script>