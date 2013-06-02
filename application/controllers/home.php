<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

    }
	
	public $layout = "layout/bienvenida";	
	
	public function index()
	{
		$session = $this->session->userdata('data'); 
		if(isset($session['id'])){
			redirect('app/index');
		}
		
		$view['content'] 	=  "home/index";
		$view['secciones'] 	= $this->db->where(array('tipo'=>'0'))->order_by("nombre","desc")->get("secciones")->result();
		$this->load->view($this->layout,$view);
		
	}	
	
	public function listado()
	{
	
		$view['content'] 	=  "home/listado";
		$view['title'] 	=  "Grupos - teavise.cl";
		$view['secciones'] 	= $this->db->where(array('tipo'=>'0'))->order_by("nombre","desc")->get("secciones")->result();

		$this->load->view("layout/default",$view);
		
	}	
	
	public function comofunciona()
	{
	
		$view['content'] 	=  "home/comofunciona";
		$view['title'] 	=  "Como Funciona - teavise.cl";
		$this->load->view("layout/default",$view);
		
	}	
	
	public function login()
	{
	
		$view['content'] 	=  "home/login";
		$view['title'] 	=  "Login - teavise.cl";
		$this->load->view("layout/default",$view);
		
	}
	
}