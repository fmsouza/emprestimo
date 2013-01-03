<?php
class Deferimento extends CI_Model{
	
	private $table = 'emprestimo_deferimento';
	
	public function aprovar($id){
		$data['formulario_emprestimo_id'] = $id;
		$data['formulario_emprestimo_usuario_cpf'] = $this->session->userdata['userdata'][0]->cpf;
		$data['deferido'] = 1;
		return $this->deferir($data);
	}
	
	public function negar($id){
		$data['formulario_emprestimo_id'] = $id;
		$data['formulario_emprestimo_usuario_cpf'] = $this->session->userdata['userdata'][0]->cpf;
		$data['deferido'] = 0;
		return $this->deferir($data);
	}
	
	public function deferir($data){
		return ($this->db->insert($this->table,$data))? TRUE:FALSE;
	}
	
}