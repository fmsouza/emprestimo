<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Interações com a tabela de itens do acervo
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 */
class Item extends CI_Model{
	
	/**
	 * @property Tabela pai
	 */
	private $table = 'acervo_item';
	
	/**
	 * @property Tabela filha
	 */
	private $child = 'acervo_exemplar';
	
	/**
	 * Tabela de empréstimos
	 */
	private $emprestado = 'formulario_emprestimo';
	
	/**
	 * Registra um novo item
	 * @param array $data Dados do item
	 * @return bool
	 */
	public function save($data){
		return ($this->db->insert($this->table,$data))? TRUE:FALSE;
	}
	
	/**
	 * Retorna o último ID inserido no banco
	 * @return int
	 */
	public function insert_id(){
		return $this->db->insert_id();
	}
	
	/**
	 * Retorna um item
	 * @param int $id Identificador do item
	 * @return StdObject
	 */
	public function get_item($id){
		return $this->db->get_where($this->table,array('id'=>$id),1)->result();
	}
	
	/**
	 * Verifica se o item está disponível ou emprestado
	 * @param int $id Identificador do item
	 * @return StdObject|bool
	 */
	public function getFreeItemById($id){
		return $this->getExemplar($id);
	}
	
	/**
	 * Retorna os exemplares
	 * @param int $id Identificador do item
	 * @return StdObject
	 */
	public function getExemplares($id){
		return $this->db->get_where($this->child,"acervo_item_id LIKE {$id}")->result();
	}
	
	/**
	 * Verifica se o item está disponível ou emprestado
	 * @param int $id Identificador do item
	 * @return StdObject|bool
	 */
	public function getExemplar($id){
		$exemplar = $this->getExemplares($id);
		foreach($exemplar as $item){
			$emprestado = $this->db->get_where($this->emprestado, array('acervo_exemplar_codigo'=>$item->codigo),1);
			if(!$emprestado->num_rows==0) return false;
			else return $item;
		}
	}
	
	/**
	 * Altera um item
	 * @param array $data Dados identificadores do item
	 * @return bool
	 */
	public function editar($data){
		$id = $data['id'];
		unset($data['id']);
		return ($this->db->where('id',$id)->update($this->table,$data))? TRUE:FALSE;
	}
	
	/**
	 * Apaga um item
	 * @param int $id Identificador do item
	 * @return bool
	 */
	public function apagar($id){
		if($this->get_dependencies($id)) return false;
		else return ($this->db->delete($this->table,array('id' => $id)))? TRUE:FALSE;
	}
	
	/**
	 * Retorna todos os itens
	 * @param StdObject $query Objeto da consulta
	 * @return StdObject
	 */
	public function get($query){
		return $query->get($this->table);
	}
	
	/**
	 * Prepara as keywords baseado nos dados do item
	 * @param array $dados Dados do item
	 * @return string
	 */
	public function keywords($dados){
		$string="";
		foreach($dados as $data) if(!empty($data)) $string.= str_replace(' ', ',', str_replace('_', ',', str_replace('-', ',', str_replace('.', ',', $data)))).',';
		return substr($string,0,-1);
	}
	
	/**
	 * Retorna o título da categoria
	 * @param string Categoria
	 * @return string
	 */
	public function title_setor($name){
		$setor = array(
			'mapa'			=> 'Mapas e Cartas',
			'tese'			=> 'Teses, Livros e Artigos',
			'equipamento'	=> 'Equipamentos',
		);
		return $setor[$name];
	}
	
	/**
	 * Retorna todos os itens registrados sob a categoria Mapas e Cartas
	 * @return StdObject
	 */
	public function mapas(){
		return $this->db->where('acervo_categoria_id','mec')->get($this->table);
	}
	
	/**
	 * Retorna todos os itens registrados sob a categoria Livros, Teses e Artigos
	 * @return StdObject
	 */
	public function teses(){
		return $this->db->where('acervo_categoria_id','tlea')->get($this->table);
	}
	
	/**
	 * Retorna todos os itens registrados sob a categoria Equipamentos
	 * @return StdObject
	 */
	public function equipamentos(){
		return $this->db->where('acervo_categoria_id','equ')->get($this->table);
	}
	
	/**
	 * Verifica se há dados dependentes de determinado item na tabela filha
	 * @param int $id Identificador do item
	 * @return bool
	 */
	private function get_dependencies($id){
		return ($this->db->where(array('acervo_item_id' => $id))->get($this->child)->num_rows() > 0)? TRUE:FALSE;
	}
}
/* End of file item.php */
/* Location: ./application/controllers/item.php */