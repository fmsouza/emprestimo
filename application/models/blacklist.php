<?php

class Blacklist extends CI_Model{
	
	private $table = 'blacklist';

	public function isBlacklisted(){
		$data = $this->session->userdata['userdata'][0];
		return ($this->db->get_where($this->table, array('usuario_cpf',$data->cpf)))? TRUE:FALSE;
	}
	
	public function removeFromBlacklist($cpf){
		return ($this->db->delete($this->table,array('usuario_cpf',$cpf)))? TRUE:FALSE;
	}
	
	public function get(){
		return $this->db->get($this->table)->result();
	}
	
}