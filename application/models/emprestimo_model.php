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
		$data['usuario_cpf'] = $data['user']->cpf;
		unset($data['user']);
		$data['emprestimo_finalidade_id'] = (int) $data['emprestimo_finalidade_id'];
		$data['data_emprestimo'] = $this->prepareDate($data['data_emprestimo']);
		$data['data_devolucao'] = $this->prepareDate($data['data_devolucao']);
		
		//Pega o código de um exemplar e o seta caso não esteja emprestado. Retorna false caso contrário
		$this->load->model('item');
		if($this->item->getFreeItemById($data['acervo_exemplar_codigo']))
			$data['acervo_exemplar_codigo'] = $this->item->getFreeItemById($data['acervo_exemplar_codigo'])->codigo;
		else exit(var_dump("Não achou nenhum exemplar livre: ",$data));//return false;
		
		return ($this->db->insert($this->table['formulario'], $data));
	}
	
	private function prepareDate($date){
		$date = explode("/",$date);
		return "{$date[2]}-{$date[1]}-{$date[0]}";
	}
	
}