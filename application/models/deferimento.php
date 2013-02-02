<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Interações com a tabela de deferimento
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 */
class Deferimento extends CI_Model{
	
	/**
	 * @property Nome da tabela
	 */
	private $table = 'emprestimo_deferimento';
	
	/**
	 * Aprova uma solicitação
	 * @param int $id Identificador da solicitação
	 * @return bool
	 */
	public function aprovar($id){
		$data['formulario_emprestimo_id'] = (int) $id;
		$data['formulario_emprestimo_usuario_cpf'] = $this->session->userdata['userdata'][0]->cpf;
		$data['deferido'] = 1;
		return $this->deferir($data);
	}
	
	/**
	 * Nega uma solicitação
	 * @param int $id Identificador da solicitação
	 * @return bool
	 */
	public function negar($id){
		$data['formulario_emprestimo_id'] = (int) $id;
		$data['formulario_emprestimo_usuario_cpf'] = $this->session->userdata['userdata'][0]->cpf;
		$data['deferido'] = 0;
		return $this->deferir($data);
	}
	
	/**
	 * Realiza a operação
	 * @param array $data Dados necessários para o registro
	 * @return bool
	 */
	public function deferir($data){
		return ($this->db->insert($this->table,$data))? TRUE:FALSE;
	}
}