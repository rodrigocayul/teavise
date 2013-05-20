<form id="formularioPublicar" action="" method="POST" enctype="multipart/form-data" >
<fieldset>
<legend>Publicar</legend>

<table width="100%" >
<tr>
	<td>Categoria</td>
</tr>	
<tr>
	<td>
	<select id="filtro" name="materiale_id" class="span6" >
			<option value=""> -- </option>
			<?php foreach($materiales as $row_materiales): ?>
			<option value="<?php echo $row_materiales->id; ?>" <?php echo (isset($_GET['filtro']) ? ($_GET['filtro'] == $row_materiales->id ? 'selected="selected"' :"" ) : "") ?>  ><?php echo $row_materiales->nombre; ?></option>
			<?php endforeach; ?>	
	</select>
	
	<a class="btn" href="/app/categoria?grupo=<?php echo $_GET['grupo']; ?>&volver=1" >Agregar Categoria</a>
	</td>
</tr>

<tr>
	<td>Titulo:</td>
</tr>	
<tr>
	<td><input id="nombre" class="span12" type="text" name="nombre" value="" /></td>
</tr>
<tr>
	<td>Contenido:</td>
</tr>
<tr>
	<td><textarea id="detalle" class="span12" name="detalle" ></textarea></td>
</tr>
<tr>
	<td><input type="file" name="upload[]" /></td>
</tr>
<tr>
	<td colspan="2">
	<div id="campos" style="display:none;"></div> 
	</td>
		<!-- AQUI -->
</tr>
<tr>
	<td><a id="agregar" class="btn" href="#agregar" title="Agregar Archivo" ><span class="k-icon k-i-plus"></span> Agregar Archivo</a></td>
</tr>
<tr>
	<td>&nbsp;</td>
</tr>


<tr>
	<td><input class="btn btn-large btn-success" type="submit" value="Publicar" /></td>
</tr>
</table>

</fieldset>
</form>

<script>
$(document).ready(function(){
	
	if(!jQuery.browser.mobile)
	{
		//style="width:100%;height:200px"
	   	$("#detalle").kendoEditor({
		encoded: false,
		tools: [
		       "bold",
		        "italic",
		        "underline"
		     ],
		
		});
	}
		
		
	var lugar=0;
	$('#agregar').click(function(){
		lugar=lugar+1;
		
		$('#campos').fadeIn(400, function () {
			$('#campos').show('show');
		})
		
		$('#campos').append('<tr class="lugar'+lugar+' each_each"><td><input type="file" name="upload[]" value="" placeholder="Nombre" class="placeholder" /></td><td><a  href="#a" class="btn btn-danger borrar" ref="'+lugar+'" title="Eliminar" >Borrar</a></td></tr>');
		
		
		$('#campos').attr('style','display:block');

		return false;
	});

	$('.borrar').live('click',function(){

		var cont = 0;
		$('.each_each').each(function(i){
			cont = cont + 1;
		});
		if(cont==1){
			$('#campos').attr('style','display:none');
		}
		
		var cual = $(this).attr('ref');
		$(".lugar"+cual).remove();
		return false;
	});	
	
	$("#formularioPublicar").submit(function(){
		
		if($.trim($("#nombre").val()) == ""){
			
			alert("Debe Ingresar Titulo");
			$("#nombre").focus();
			return false;
		}
		
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
	});
	
	
});

</script>