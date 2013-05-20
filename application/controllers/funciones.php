<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class funciones extends CI_Controller {

	
	public function index(){

		
	}
	
	public function enviarMailNuevoUsuario(){
		
		$email = $_POST['email'];
		$token = $_POST['token'];	
		
		$data = $this->db->where('email',$email)->get('usuarios')->row();
		
		$tokenCompare = base64_encode(base64_encode($data->id."__[-]__".$data->email));
		
		if( $token == $tokenCompare ){
			$BODY_MAIL = '
			<html>
				<body>
					<table width="100%" border="0" align="left" cellpadding="10" cellspacing="0">
					<tr>
					<td rowspan="15" bgcolor="#00BB00"></td>
					<td bgcolor="#DDDDDD"><h1><strong style="color:#FFFFFF;padding:5px;font-family:Helvetica Neue, Helvetica, Arial, sans-serif"><a href="http://teavise.cl" style="color:#222;text-decoration:none">teavise.cl</a></strong></h1></td>
					<td rowspan="15" bgcolor="#0B0">&nbsp;</td>
					</tr>
					<tr>
					<td><h1>Verificar Email</h1></td>
					</tr>
					<tr>
					<td height="27">&nbsp;</td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td align="center"><a href="http://'.$_SERVER['SERVER_NAME'].'/funciones/verificaMailNuevoUsuario/?v='.base64_encode(base64_encode($email)).'&token='.$token.'"  style="padding:10px;background:#CC3300;color:#FFF;text-decoration:none;font-family:Tahoma, Geneva, sans-serif;display:block;width:200px;margin-left:auto;margin-right:auto">Verificar</a></td>
					</tr>
					<tr>
					<td>&nbsp;</td>
					</tr>
					<tr>
					<td align="center"><a href="http://teavise.cl" style="text-decoration:none">www.teavise.cl</a></td>
					</tr>
					<tr>
					<td bgcolor="#00BB00">&nbsp;</td>
					</tr>
					</table>
				</body>
			</html>';
				
	
			
			//Avisar a los suscriptores
			
			$destinatario 	= $email; 
			$asunto 		= "Verificar Email"; 
			$cuerpo 		= $BODY_MAIL; 

			//para el envío en formato HTML 
			$headers = "MIME-Version: 1.0\r\n"; 
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 

			//dirección del remitente 
			$headers .= "From: Te Avise  <no-responder@teavise.cl>\r\n"; 

			//dirección de respuesta, si queremos que sea distinta que la del remitente 
			//$headers .= "Reply-To: mariano@desarrolloweb.com\r\n"; 
			//ruta del mensaje desde origen a destino 
			//$headers .= "Return-path: holahola@desarrolloweb.com\r\n"; 
			//direcciones que recibián copia 
			//$headers .= "Cc: maria@desarrolloweb.com\r\n"; 
			//direcciones que recibirán copia oculta 
			//$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n"; 

			//mail($destinatario,$asunto,$cuerpo,$headers); 
			
			echo $BODY_MAIL;
		}
	
	}
	
	public function verificaMailNuevoUsuario(){
		
		$email = base64_decode(base64_decode($_GET['v']));
		
		$data = $this->db->where('email',$email)->get('usuarios')->row();
		
		if(isset($data->id)){
			
			$tokenCompare = base64_encode(base64_encode($data->id."__[-]__".$data->email));
			if($_GET['token'] == $tokenCompare ){
				
				$this->db->where('id', $data->id);
				$this->db->update('usuarios', array('estado'=>1));
				echo "<h1>Verificación con Exito</h1>
				<br />
				<a href='/'>Ir a teavise</a>
				";
			}
			
		}else{
			
			show_404('page','log_error');
		}
		
	}
	
	
	
}