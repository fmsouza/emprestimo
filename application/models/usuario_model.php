<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model{
	
	private $table = 'usuario';
	
	function __construct(){
		parent::__construct();
	}
	
	public function cadastrar($data){
		if($this->db->insert($this->table,$data))
			return true;
		else
			return false;
	}
	
	public function get_user($data){
		return $this->db->get_where($this->table,$data,1)->result();
	}
}