<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Interações com a tabela de finalidades de solicitação
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 */
class Finalidade extends CI_Model{
	
	/**
	 * @property Nome da tabela
	 */
	private $table = 'emprestimo_finalidade';
	
	/**
	 * Retorna todos os registros
	 * @return StdObject
	 */
	public function get(){
		return $this->db->get($this->table)->result();
	}
}