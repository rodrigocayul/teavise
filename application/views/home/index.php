<div class="row">
	

		
		<div class="span6">
		
			<form id="registarse" action="" method="POST">
			<div class="span5"><h1>Registrate<br /> y crea tu Grupo</h1></div>
			<div class="span5 color_text_blanco">E-mail</div>
			<div class="span5"><input type="text" name="email" id="email" /></div>
			
			<div class="span5 color_text_blanco">Contraseña</div>
			<div class="span5"><input type="password" name="password" id="password" /></div>
			
			<div class="span5 color_text_blanco">Repetir Contraseña</div>
			<div class="span5"><input type="password" name="re_password" id="re_password" /></div>
			
			<div class="span5"><input class="btn btn-large btn-success" type="submit" value="Crear Cuenta"></div>
			</form>
		</div>
		
		<div class="span5">
			<br />
			<h1 id="eslogan">Aprovecha al maximo tu grupo</h1>
			<a href="/grupos" class="btn btn-large btn-block btn-info"> >> Ver Grupos <<</a>
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
	
	$('#email').focus();
	
	$('#registarse').submit(function(){
		
		var formulario = $(this).serialize();
		var constante = 0;
		
		if($.trim($('#email').val()) == "" ){
			
			alert("Debe Ingresar Email");
			$('#email').focus();
			return false;
			
		}else{
			
			var eRROR = 0;
			var errorMensaje = "";
			
			$.ajax({
				type: "POST",
				url: "/cuenta/isMail",
				data: {email: $('#email').val() } ,
				success: function(data){
					if(data == 0){
						alert("Email No Valido");
						$('#email').focus();
						$('#email').val("");
						
						return false;
					}else if(data == 1){
							
						$.ajax({
							type: "POST",
							url: "/cuenta/existecuenta",
							data: {email: $('#email').val()} ,
							success: function(data){
								if(data == 2){
									alert("Email Incorrecto");
									$('#email').focus();
									constante = 1;
								}
								if(data == 1){
									alert("Email ya Existe");
									$('#email').focus();
									constante = 1;
									
								}
								
								if(constante == 1){
									return false;
								}
								
								if($.trim($('#password').val()) == "" ){
									
									alert("Debe Ingresar Password");
									$('#password').focus();
									return false;
								}
								
								if($.trim($('#re_password').val()) == "" ){
									
									alert("Debe Repetir Password");
									$('#re_password').focus();
									return false;
								}
								
								
								if($('#password').val().length < 4 ){
									
									alert("Password Minimo 4 digitos");
									$('#password').focus();
									return false;
								}
								
								if($('#password').val() != $('#re_password').val() ){
									alert("Password No coincide");
									$('#password').focus();		
									return false;
								}
								
								util.loading();
									$.ajax({
										type: "POST",
										url: "/cuenta/existecuenta",
										data: {email: $('#email').val()} ,
										success: function(data){
											if(data == 0){
												$.ajax({
													type: "POST",
													url: "/cuenta/nuevo",
													data: formulario ,
													success: function(data){
														
														$.post("/funciones/enviarMailNuevoUsuario",{email: $('#email').val() , token: data }, function(data){
															util.unloading();
															alert("Se ha enviado un e-mail \n Para verificar su correo electronico");
															window.location.reload();
														});
														
													}
												});	
											}
										}
									});

							}
						});		
						
					}
				}
			})
			
			
	
		}
		

		
		/*

		*/
		return false;
	});

});

</script>