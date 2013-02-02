<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Interações com a tabela de categorias no banco de dados
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 */
class Categoria extends CI_Model{
	
	/**
	 * @property Tabela de categoria
	 */
	private $table = 'acervo_categoria';
	/**
	 * @property Tabela filha, item do acervo
	 */
	private $child = 'acervo_item';
	
	/**
	 * Registra nova categoria
	 * @param array $data Array de dados que serão cadastrados
	 * @return bool
	 */
	public function save($data){
		return ($this->db->insert($this->table,$data))? TRUE:FALSE;
	}
	
	/**
	 * Altera uma categoria
	 * @param array $data Identificador do registro
	 * @return bool
	 */
	public function editar($data){
		$id = $data['id'];
		unset($data['id']);
		return ($this->db->where('id',$id)->update($this->table,$data))? TRUE:FALSE;
	}
	
	/**
	 * Exclui uma categoria
	 * @param int $id Identificador da categoria
	 * @return bool
	 */
	public function apagar($id){
		if($this->get_dependencies($id)) return FALSE;
		else return ($this->db->delete($this->table,array('id' => $id)))? TRUE:FALSE;
	}
	
	/**
	 * Busca todas as categorias cadastradas na tabela
	 * @return StdObject
	 */
	public function get(){
		return $this->db->get($this->table);
	}
	
	/**
	 * Gera o ID da categoria
	 * @param string $titulo Título da categoria 
	 * @return string
	 */
	public function gera_id($titulo){
		$titulo = explode(' ',$titulo);
		$cod = '';
		if(count($titulo)>1) foreach($titulo as $parte) $cod .= substr($parte,0,1);
		else $cod .= substr($titulo[0],0,3);
		return strtolower($cod);
	}
	
	/**
	 * Busca uma categoria
	 * @param int $id Identificador da categoria
	 * @return StdObject
	 */
	public function get_categoria($id){
		return $this->db->get_where($this->table,array('id'=>$id),1)->result();
	}
	
	/**
	 * Verifica se há dados dependentes em outras tabelas
	 * @param int $id Identificador do registro pai
	 * @return bool
	 */
	private function get_dependencies($id){
		return ($this->db->where(array('acervo_categoria_id' => $id))->get($this->child)->num_rows() > 0)? TRUE:FALSE;
	}
}
/* End of file categoria.php */
/* Location: ./application/controllers/categoria.php */