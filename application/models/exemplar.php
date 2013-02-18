<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Interações com a tabela de exeplares do acervo
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 */
class Exemplar extends CI_Model{
	
	/**
	 * @property Nome da tabela
	 */
	private $table = 'acervo_exemplar'; //tabela que contém os dados dos usuários
	
	/**
	 * @property Tamanho máximo de caracteres no código do item
	 */
	private $tam = 8;
	
	/**
	 * Salva um primeiro exemplar para um item
	 * @param array $data Dados do item
	 * @return bool
	 */
	public function save_first($data){
		$data['codigo'] = $data['acervo_categoria_id'].$data['acervo_item_id'].'-'.$this->fill_zero(1,$this->tam - strlen($data['codigo']));
		$data['data_inclusao'] = date('Y-m-d');
		unset($data['acervo_categoria_id']);
		return ($this->db->insert($this->table,$data))? TRUE:FALSE;
	}
	
	/**
	 * Registra um novo exemplar para determinado item
	 * @param string $data Dados para a tabela
	 * @param int $num Identificador do exemplar
	 * @return bool
	 */
	public function novo($data,$num){
		$data['codigo'] = $data['acervo_categoria_id'].$data['acervo_item_id'].'-'.$this->fill_zero($num,$this->tam - strlen($data['codigo']));
		$data['data_inclusao'] = date('Y-m-d');
		unset($data['acervo_categoria_id']);
		return ($this->db->insert($this->table,$data))? TRUE:FALSE;
	}
	
	/**
	 * Retorna os exemplares de um item
	 * @param int $id Identificador do Item
	 * @return StdObject
	 */
	public function get_exemplar($id){
		return $this->db->get_where($this->table,array('id'=>$id),1)->result();
	}
	
	/**
	 * Retorna os exemplares de uma categoria
	 * @param string $cod Código da categoria
	 * @return StdObject
	 */
	public function getExemplares($cod){
		$data['codigo LIKE '] = $cod."%";
		return $this->db->get_where($this->table,$data)->result();
	}
	
	/**
	 * Completa um número com zeros à esquerda
	 * @param int $number O número
	 * @param int $n O número de zeros
	 * @example fill_zero(26,5) = 00026
	 * @return int
	 */
	private function fill_zero($number,$n){
		return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
	}
}
/* End of file exemplar.php */
/* Location: ./application/controllers/exemplar.php */