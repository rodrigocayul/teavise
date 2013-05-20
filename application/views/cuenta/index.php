<div class="row">

<div class="span3 well">
<h1>Registrarse</h1>
<hr />

<form id="registarse" action="" method="POST">
<label>Email</label>
<input type="text" name="email" id="email" />
<label>Password</label>
<input type="password" name="password" id="password" />
<label>Re-Password</label>
<input type="password" name="re_password" id="re_password" />
<input class="btn btn-large btn-success" type="submit" value="Registrarme"   />
</form>

</div>
</div>


<script type="text/javascript">

$(document).ready(function(){
	
	$('#email').focus();
	
	$('#registarse').submit(function(){
		
		var formulario = $(this).serialize();
		var constante = 0;
		
		if($.trim($('#email').val()) == "" ){
			
			alert("Debe Ingresar Email");
			$('#email').focus();
			return false;
		}else{
			
			$.ajax({
				type: "POST",
				url: "/cuenta/existecuenta",
				data: {email: $('#email').val()} ,
				dataType: 'text', 
				cache: false,
				async: false,
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
				}
			});		
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
		
		$.ajax({
			type: "POST",
			url: "/cuenta/existecuenta",
			data: {email: $('#email').val()} ,
			dataType: 'text', 
			cache: false,
			async: false,
			success: function(data){
				if(data == 0){
					$.ajax({
						type: "POST",
						url: "/cuenta/nuevo",
						data: formulario ,
						dataType: 'text', 
						cache: false,
						async: false,
						success: function(data){
							
							
						}
					});	
				}
			}
		});
		
		return false;
	});

});

</script>