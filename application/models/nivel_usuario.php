<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Interações com a tabela de Tipos de usuário
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 */
class Nivel_usuario extends CI_Model{

	/**
	 * @property Valores de cada coluna da tabela
	 */
	private $values;
	
	/**
	 * @property Nome da tabela
	 */
	private $table = 'nivel_usuario'; //tabela que contém os dados dos usuários
	
	/**
	 * Seta os valores de cada coluna
	 * @return void
	 */
	public function __construct(){
		$this->$values = array(
			'nome' => '',
			'ver_usuario' => 0,
			'editar_usuario' => 0,
			'ver_categoria' => 0,
			'editar_categoria' => 0,
			'apagar_usuario' => 0,
			'editar_acervo' => 0,
			'apagar_acervo' => 0,
			'deferir_emprestimo' => 0,
			'cancelar_emprestimo' => 0
		);
	}
	
	/**
	 * Cadastra um novo tipo de usuário
	 * @param array $data Dados a serem cadastrados na tabela
	 * @return bool
	 */
	public function cadastrar($data){
		return ($this->db->insert($this->table,$data))? TRUE:FALSE;
	}
	
	/**
	 * Retorna um tipo de usuário
	 * @param array $data Identificadores do tipo de usuário
	 * @return StdObject
	 */
	public function get_nivel($data){
		return $this->db->get_where($this->table,$data,1)->result();
	}
	
	/**
	 * Retorna todos os tipos de usuário
	 * @return StdObject
	 */
	public function get(){
		return $this->db->get($this->table);
	}
	
	/**
	 * Altera os dados de um tipo de usuário
	 * @param array $data Dados de alteração
	 * @return bool
	 */
	public function editar($data){
		$id = $data['id'];
		unset($data['id']);
		foreach($data as $key => $value) $this->values[$key] = ($key!='nome')? (($value=='on')? 1:0):$value;
		return ($this->db->where('id',$id)->update($this->table,$this->values))? TRUE:FALSE;
	}
	
	/**
	 * Verifica se o usuário logado é administrador
	 * @return bool
	 */
	public function getNivel($setor){
		return ($this->session->userdata['userdata'][0]->nivel->$setor)==1;
	}
	
	/**
	 * Verifica se o usuário possui acesso ao módulo
	 * @return void
	 */
	public function verify_access($param){
		if(!$this->getNivel($param)) header("Location: home");
	}
	
	/**
	 * Apaga um registro
	 * @param int $id Identificador do tipo de usuário
	 * @return bool
	 */
	public function apagar($id){
		return ($this->db->delete($this->table,array('id' => $id)))? TRUE:FALSE;
	}
}
/* End of file nivel_usuario.php */
/* Location: ./application/models/nivel_usuario.php */