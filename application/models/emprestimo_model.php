<?php

class Emprestimo_model extends CI_Model{
	
	private $table = array(
		'formulario'  => 'formulario_emprestimo',
		'finalidade'  => 'emprestimo_finalidade',
		'deferimento' => 'emprestimo_deferimento'
	);
	
	public function isBorrowed($id){
		$data = array('devolvido' => '0','acervo_exemplar_acervo_item_id' => $id);
		return ($this->db->get_where($this->table['formulario'], $data)->result())? TRUE:FALSE;
	}
	
	public function save($data){
		return ($this->db->insert($this->table['formulario'], $data);
	}
	
}