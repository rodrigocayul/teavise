<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class app extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

        $session = $this->session->userdata('data'); 
		if(!isset($session['id'])){
			redirect('home?r=logearse');
		}
    }

	
	public $layout = "layout/app";	
	
	public function index()
	{
		redirect('app/migrupo');
		$view['content'] 	=  "app/index";
		
		
		$this->load->view($this->layout,$view);
		
	}
	
	public function publicar(){
		
		//Es mi grupo
		if($this->esMiGrupo($_GET['grupo']) == FALSE){
			show_404('page','log_error');
		}
		
		if($_POST){
		
					
			$data['nombre']  		= $_POST['nombre'];
			$data['detalle'] 		= $_POST['detalle'];
			$data['materiale_id'] 	= ($_POST['materiale_id'] == "") ? 0 : $_POST['materiale_id'];
			$data['seccione_id'] 	= $_GET['grupo'];
			
			$this->db->insert('contenidos', $data); 
			$ultimo_id = $this->db->insert_id();
			
			
			$uploads_dir = $_SERVER['DOCUMENT_ROOT'].'/public/upload';
			foreach ($_FILES["upload"]["error"] as $key => $error) {
				if ($error == UPLOAD_ERR_OK) {
					$tmp_name 	= $_FILES["upload"]["tmp_name"][$key];
					$name 		= $this->quitarAcentos(date('YmdHms').rand()."__".$_FILES["upload"]["name"][$key]);
					move_uploaded_file($tmp_name, "$uploads_dir/$name");
					
					$this->db->insert('uploades', array('ruta' =>$name ,'contenido_id'=>$ultimo_id)); 		
				}else{
					$eroor_upload[] = $_FILES["upload"]["name"][$key]."\n";
				}
				
			}
			
			$BODY_MAIL = '
			<html>
				<body>
				<table width="100%" border="0" align="left" cellpadding="10" cellspacing="0">
						<tr>
						<td rowspan="15" bgcolor="#00BB00"></td>
						<td bgcolor="#EEEEEE"><h1><strong style="color:#FFFFFF;padding:5px;font-family:Helvetica Neue, Helvetica, Arial, sans-serif"><a href="http://teavise.cl" style="color:#555;text-decoration:none">teavise.cl</a></strong></h1></td>
						<td rowspan="15" bgcolor="#00BB00">&nbsp;</td>
				  </tr>
						<tr>
						<td><h1>'.$data['nombre'].'</h1></td>
						</tr>
						<tr>
						<td>'.$data['detalle'].'</td>
						</tr>
						<tr>
						<td height="27">&nbsp;</td>
						</tr>
						<tr>
						<td>&nbsp;</td>
						</tr>
						<tr>
						<td align="center"><a href="http://'.$_SERVER['SERVER_NAME'].'/detalle/'.$ultimo_id.'"  style="padding:10px;background:#CC3300;color:#FFF;text-decoration:none;font-family:Tahoma, Geneva, sans-serif;display:block;width:200px;margin-left:auto;margin-right:auto">Ver Material Publicado</a></td>
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
			$data = $this->db->where('seccione_id', $_GET['grupo'])->get('suscriptores')->result();
			
			foreach($data AS $row){
				
				
				$destinatario = $row->mail; 
				$asunto = $_POST['nombre']; 
				$cuerpo = $BODY_MAIL; 

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

				mail($destinatario,$asunto,$cuerpo,$headers); 
				
			}
			
			redirect("/app/migrupo" , "refresh");
		}
		
		
		$view['content'] 		=  "app/publicar";
		$view['materiales'] 	=  $this->db->where('seccione_id', $_GET['grupo'])->get('materiales')->result();
		
		
		$this->load->view($this->layout,$view);
		
	
	}
	
	public function migrupo(){
		
		$session = $this->session->userdata('data'); 
		
		$view['content'] 	=  "app/migrupo";
		
		$view['mis_grupos'] = $this->db->query("select b.* from 
								usuarios_secciones  a JOIN secciones b ON (a.seccione_id = b.id)
								where usuario_id = {$session['id']};")->result();	
								
		$this->load->view($this->layout,$view);
		
		
	}
	
	/*
	* Crear un nuevo grupo
	* codigo: formulario_nuevo_grupo
	*/
	public function nuevogrupo(){
		
		$view['content'] 	=  "app/nuevogrupo";
		
		$this->load->view($this->layout,$view);
	
	}
	
	/*
	*	Agregar nuevo grupo mediante Ajax
	*/
	public function nuevogrupoAjax(){
	
		//Crear Seccion
		if($_POST){
			
			if( base64_decode(base64_decode($_POST['codigo'])) == "formulario_nuevo_grupo" ){
				
				$session = $this->session->userdata('data'); 
				
				//secciones
				$data = array(
				   'nombre' 		=> $this->quitarAcentos($_POST['nombre']) ,
				   'descripcion' 	=> $_POST['descripcion'] ,
				   'tipo' 			=> (($_POST['grupo'] == "") ? 0 : (($_POST['grupo'] == "publico") ? 0 : 1 ) ),
				);

				$this->db->insert('secciones', $data); 
				$secciones_id = $this->db->insert_id();
				
				//buscar ultimo registro
				
				
				//usuarios_secciones
				$data = array(
				   'usuario_id' => $session['id'] ,
				   'seccione_id' => $secciones_id,
				  
				);

				$this->db->insert('usuarios_secciones', $data); 
				
				//si la cuenta es privada
				if((($_POST['grupo'] == "") ? 0 : (($_POST['grupo'] == "publico") ? 0 : 1 )) == 1){
					
					//secciones_privadas
					$data = array(
					    'periodo' 			=> $_POST['periodo'],
					    //'fecha_creacion'	=> '',
					    //'fecha_inicio' 		=> '',
					    //'fecha_termino' 	=> '',
					    //'estado' 			=> '',
						'usuario_id' 		=> $session['id'] ,
						'seccione_id' 		=> $secciones_id,
					   
					);

					$this->db->insert('secciones_pagadas', $data); 
					
				}
				
				echo "1";
			}
		}	
	}
	
	
	/*
	* categoria
	*/
	
	public function categoria(){
		
		//Es mi grupo
		if($this->esMiGrupo($_GET['grupo']) == FALSE){
			show_404('page','log_error');
		}
		
		if($_POST){
			
			$data['nombre'] = $_POST['nombre'];
			$data['seccione_id'] = $_GET['grupo'];
			
			$this->db->insert('materiales', $data); 
			
			
			redirect("/app/categoria?grupo={$_GET['grupo']}&volver={$_GET['volver']}" , "refresh");
		}
		
		$view['content'] 	=  "app/categoria";
		$view['data']  	= $this->db->where('seccione_id', $_GET['grupo'])->get('materiales')->result();
		$this->load->view($this->layout,$view);
		
	
	}
	
	private function quitarAcentos($text){
		$text = htmlentities($text, ENT_QUOTES, 'UTF-8');
		$text = strtolower($text);
		$patron = array (
			// Espacios, puntos y comas por guion
			'/[\, ]+/' => '-',
 
			// Vocales
			'/&agrave;/' => 'a',
			'/&egrave;/' => 'e',
			'/&igrave;/' => 'i',
			'/&ograve;/' => 'o',
			'/&ugrave;/' => 'u',
 
			'/&aacute;/' => 'a',
			'/&eacute;/' => 'e',
			'/&iacute;/' => 'i',
			'/&oacute;/' => 'o',
			'/&uacute;/' => 'u',
 
			'/&acirc;/' => 'a',
			'/&ecirc;/' => 'e',
			'/&icirc;/' => 'i',
			'/&ocirc;/' => 'o',
			'/&ucirc;/' => 'u',
 
			'/&atilde;/' => 'a',
			'/&etilde;/' => 'e',
			'/&itilde;/' => 'i',
			'/&otilde;/' => 'o',
			'/&utilde;/' => 'u',
 
			'/&auml;/' => 'a',
			'/&euml;/' => 'e',
			'/&iuml;/' => 'i',
			'/&ouml;/' => 'o',
			'/&uuml;/' => 'u',
 
			'/&auml;/' => 'a',
			'/&euml;/' => 'e',
			'/&iuml;/' => 'i',
			'/&ouml;/' => 'o',
			'/&uuml;/' => 'u',
 
			// Otras letras y caracteres especiales
			'/&aring;/' => 'a',
			'/&ntilde;/' => 'n',
 
			// Agregar aqui mas caracteres si es necesario
 
		);
 
		$text = preg_replace(array_keys($patron),array_values($patron),$text);
		return $text;
	}
	
	
	//FUNCIONES APP
	private function esMiGrupo ($seccione_id){
		$session = $this->session->userdata('data'); 
		$data = $this->db->where(array('usuario_id'=>$session['id'] , 'seccione_id'=>$seccione_id))->get('usuarios_secciones')->row();
		$r = FALSE;
		if(isset($data->id)){
			$r = TRUE;
		}
		return $r;		
	}
	
}