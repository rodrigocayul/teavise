<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class detalle extends CI_Controller {

	public $layout = "layout/default";	
	
	public function index($id)
	{
	

		$view['content'] 	=  "detalle/index";
		$view['detalle'] = 	$this->db->where('id',$id)->get('contenidos')->row();
		
		$view['title'] = $view['detalle']->nombre." - teavise.cl";
		
		$view['secciones'] = 	$this->db->where('id',$view['detalle']->seccione_id)->get('secciones')->row();
		$view['upload'] = 	$this->db->where('contenido_id',$id)->get('uploades')->result(); 	
		
		$this->db->close();
		$this->load->view($this->layout,$view);
		
	}	
	
	public function descargar(){
				
		if (!isset($_GET['file']) || empty($_GET['file'])) { 
		exit(); 
		} 
		$file = $_GET['file']; 
		$file = basename($file); 
		$file = $_SERVER['DOCUMENT_ROOT'].'/public/upload/'.$file; 
		
		$nombre = explode('_' , $_GET['file']);
		unset($nombre[0]);
		unset($nombre[1]);
		
		if(is_file($file)) {
			// requerido para IE 
			if(ini_get('zlib.output_compression')) {
			ini_set('zlib.output_compression', 'Off'); 
			} 
			if (function_exists('mime_content_type')){ 
			$type = mime_content_type($file); 
			}else if (function_exists('finfo_file')){ 
			$info = finfo_open(FILEINFO_MIME); 
			$type = finfo_file($info, $file); 
			finfo_close($info); 
			}else{ 
				switch(strtolower(end(explode('.',$file)))) {
					case 'pdf': 
						$type = 'application/pdf'; 
						break; 
					case 'zip': 
						$type = 'application/zip'; 
						break; 
					case 'jpeg': 
					case 'jpg': 
						$type = 'image/jpg'; 
						break; 
					default: $type = 'application/force-download'; 
				} 
			} 
			
			$fname = implode('_',$nombre);
			header('Pragma: public'); // required 
			header('Expires: 0'); // no cache 
			header('Cache-Control: must-revalidate, post-check=0, pre-check=0'); 
			header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file)).' GMT'); 
			header('Cache-Control: private',false); 
			header('Content-Type: '.$type); 
			header('Content-Disposition: attachment; filename="'.$fname.'"'); 
			header('Content-Transfer-Encoding: binary'); 
			header('Content-Length: '.filesize($file)); 
			header('Connection: close'); 
			readfile($file); 
			
		}
	
	}
	
	public function viewdoc(){
		
		$view['content'] 	=  "detalle/viewdoc";
		$this->load->view($this->layout,$view);
	}
	

}