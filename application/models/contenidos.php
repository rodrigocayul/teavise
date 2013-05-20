<?php

class Contenidos extends CI_Model {

    function __construct()
    {
        // Call the Model constructor
        parent::__construct();
    }
    
	
	public function getContenidos($seccione_id=null , $materiale_id=null){
		
		$AND = "";
		
		if($materiale_id != null){
			if(!empty($materiale_id)){
				if(is_numeric ($materiale_id)){
					$AND = " AND a.materiale_id = {$materiale_id}";
				}
			}
		}
		
		$SQL ="SELECT
		a.id , 
		a.nombre,
		a.detalle,
		date_format(a.fecha,'%d-%m-%Y')fecha,
		b.nombre seccione_id,
		c.nombre materiale_id
		FROM contenidos a 
		JOIN secciones b ON (a.seccione_id = b.id)
		JOIN materiales c ON (a.materiale_id = c.id)
		WHERE a.seccione_id = {$seccione_id} {$AND} ORDER BY id DESC";
  		return $this->db->query($SQL);
    }
}