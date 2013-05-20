
<div class="row">

	<div class="span12">
		
		<form id="formulario_nuevo_grupo">
		
		<div class="offset2 span8  alert alert-error" id="nombre_error" style="display:none">
			Debe Ingresar Nombre de Grupo
		</div>
		
		<div class="clear"></div>
		<div class="span2"><b>Nombre Grupo</b></div>
		<div class="span8"><input class="span3" id="nombre" name="nombre" type="text" /> Sin Espacios ni / ' "</div>

		<div class="span2"><b>Descipcion</b></div>
		<div class="span8"><input class="span6" id="descripcion" name="descripcion" type="text" /></div>
		
		<div class="span9 offset2">
			<h6><input class="tipoGrupo" type="radio" name="grupo" value="publico" checked /> <span class="icon-book"></span> Publico</h6>
			<!--<h6><input class="tipoGrupo" type="radio" name="grupo" value="privado" /> <span class="icon-lock"></span> Privado</h6>-->
		</div>
		
		<div class="offset2 span8 well" id="datosPago" style="display:none">
			
			<div id="pagar"><h1>$2.500 PCL</h1></div>
			<hr />
			
			<select name="periodo" id="periodo">
				<option value="1">1 Mes</option>
				<option value="3">3 Meses</option>
				<option value="6">6 Meses</option>
				<option value="12">1 Año</option>
			</select>
		
			<hr />

		Deposito
		</div>
		
		
		<div class="span9 offset2"><input class="btn btn-large btn-success" type="submit" value="Crear Grupo" /></div>
		
		<input type="hidden" name="codigo" value="<?php echo base64_encode(base64_encode("formulario_nuevo_grupo")); ?>" />
		
		
		
		</form>
	</div>
</div>

<script type="text/javascript">

$(document).ready(function(){
		
		$("#nombre").focus();
			
        $("input[name='grupo']").change(function() {
            console.log("changed");
            if ($("input[name='grupo']:checked").val() == 'publico'){
			
               $("#datosPago").hide();
				
            }else if ($("input[name='grupo']:checked").val() == 'privado'){
			
                $("#datosPago").show();
			}
            
        });
		
		
		$("#formulario_nuevo_grupo").submit(function(){
		
			var _POST = $(this).serialize();
			if($.trim($("#nombre").val()) == ""){
				
				$("#nombre_error").show();
				$("#nombre").focus();
				return false;
			}
			
			$.post("/app/nuevogrupoAjax" , _POST , function(data){
				
						if(data == 1){
							window.location.href= "/app/migrupo";
						}
				
			});
		
			return false;
		});
		
		$("#nombre").blur(function(){
				
			if($.trim($("#nombre").val()) != ""){
				
				$("#nombre_error").hide();
			}
				
			if($.trim($("#nombre").val()) == ""){
				
				$("#nombre_error").show();
				$("#nombre").focus();
			}	
			
		})
		
		$("#periodo").change(function(){
			
			var periodo = $(this).val();
			
			if(periodo == 1){
				$("#pagar").html("<h1>$ 2.500 CPL</h1>");
			}
			
			if(periodo == 3){
				$("#pagar").html("<h1>$ 4.500 CPL</h1>");
			}			
			
			if(periodo == 6){
				$("#pagar").html("<h1>$ 8.500 CPL</h1>");
			}
			
			
			if(periodo == 12){
				$("#pagar").html("<h1>$ 15.000 CPL</h1>");
			}
		
		});

});

</script>