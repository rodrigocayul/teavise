<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class grupo extends CI_Controller {

	public $layout = "layout/default";	
	
	public function index($grupo)
	{
		$this->load->model("contenidos");
		
		$row = $this->db->where('nombre', $grupo)->get('secciones')->row();
		
		
		
		$view['content'] 	 = "grupo/index";
		$view['title'] 		 = "Grupo $grupo - teavise.cl";
		$view['contenidos']  = $this->contenidos->getContenidos($row->id)->result();
		$view['grupo'] 		 = $grupo;
		$view['seccione_id'] = $row->id;
		$view['materiales']  = $this->db->where('seccione_id', $row->id )->get('materiales')->result();
		
		$this->load->view($this->layout,$view);
		
	}	
	
	public function ajaxseccion(){
		
		$where['seccione_id']  = $_POST['s'];
		$where['materiale_id'] = null;
		
		if($_POST['f'] != ""){
			$where['materiale_id'] = $_POST['f'];
		}
		
		//load modelo	
		$this->load->model("contenidos");	
		
		$data = $this->contenidos->getContenidos($where['seccione_id'] , $where['materiale_id'])->result();
		
		$json = array();
		foreach($data as $row){
			echo '<tr>
					
					<td>'.$row->nombre.'<br />Publicado '.$row->fecha.'</td>
					<td>'.$row->materiale_id.'</td>
					<td><a class="btn" href="/detalle/'.$row->id.'" >Detalle</a></td>
			</tr>';
		}	
		exit;
	}
	
	public function agregarsusacriptor(){
		
		$this->load->helper('email');
		
		// 1 - Ya te encuentras suscrito a esta seccion
		// 2 - Agregado con Exito
		// 3 - Correo no valido
		if (valid_email($_POST['correo_suscriptor'])) {
			
			$verifica = $this->db->where(array('mail'=>$_POST['correo_suscriptor'],'seccione_id'=>$_POST['seccione_id']))->get('suscriptores')->row();
			
			if(isset($verifica->id)){
				echo "1";
			}else{
				$this->db->insert('suscriptores', array('mail'=>$_POST['correo_suscriptor'],'seccione_id'=>$_POST['seccione_id'])); 
				echo "2";
			}
			
		} else {
			echo "3";
		}
		exit;	
	
	}

}