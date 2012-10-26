<?php
class Finalidade extends CI_Model{
	
	private $table = 'emprestimo_finalidade';
	
	public function get(){
		return $this->db->get($this->table)->result();
	}
	
}