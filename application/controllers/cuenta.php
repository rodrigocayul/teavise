<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cuenta extends CI_Controller {

	public $layout = "layout/default";	
	
	public function index()
	{
	
		$view['content'] 	=  "cuenta/index";
				
		$this->load->view($this->layout,$view);
		
	}
	
	public function nuevo(){
	
		$consulta = $this->db->where('username',$_POST['email'])->count_all_results('usuarios');

		
		if($consulta == 0){
		
			$data = array(
			   'username' 	=> $this->security->xss_clean($_POST['email']),
			   'email' 		=> $this->security->xss_clean($_POST['email']) ,
			   'password' 	=> md5(md5($this->config->item('salto').$this->security->xss_clean($_POST['password']))),
			   'estado' 	=> 0
			);
			
			//crear cuenta	
			$this->db->insert('usuarios', $data); 
			//ultimo cuenta creada
			$ultimo_id = $this->db->insert_id();
			
			echo base64_encode(base64_encode($ultimo_id."__[-]__".$data['email']));	
				
		}else{
			echo '0';
		}
		
		
	}
	
	public function existecuenta(){
		
		$consulta = $this->db->where('username',$_POST['email'])->count_all_results('usuarios');

		
		if($consulta == 0){
			
			echo '0';
		}
		else{
			// Ya existe cuenta
			echo '1';
		}
	}
	
	public function iniciar_session(){
		
		$consulta = $this->db->where(array('username'=>$_POST['usuario'] , 'password'=>md5(md5($this->config->item('salto').$this->security->xss_clean($_POST['clave']))) , 'estado'=>1))->get('usuarios')->result();
		
		if(count($consulta) > 0){
						
			foreach($consulta as $row){
				$newdata = array('data'=>array(
					   'id'  => $row->id,
					   'username' => $row->username,
					  
				   ));
			}
			   
			$this->session->sess_create();   
			$this->session->set_userdata($newdata);
			echo "1";
			
		}else{
			echo "0";
			
		}
	}
	
	private function private_iniciar_session(){
		
		$consulta = $this->db->where(array('username'=>$_POST['usuario'] , 'password'=>md5(md5($this->config->item('salto').$this->security->xss_clean($_POST['clave'])))))->get('usuarios')->result();
		
		if(count($consulta) > 0){
						
			foreach($consulta as $row){
				$newdata = array('data'=>array(
					   'id'  => $row->id,
					   'username' => $row->username,
					  
				   ));
			}
			   
			$this->session->sess_create();   
			$this->session->set_userdata($newdata);
			echo "1";
			
		}else{
			echo "no";
			
		}
	}
	
	/*
	* Cerrar Session
	*/
	public function salir(){
	
		$this->session->sess_create(); 
		
		redirect('home');
	}
	
	/*
	* Validar si mail es valido
	*/
	public function isMail(){
		$this->load->helper('email');

		if (valid_email($_POST['email'])){
			echo "1";
		}else{
			echo "0";
		}
		
	}
}