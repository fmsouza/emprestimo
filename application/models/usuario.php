<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Interações com a tabela de Tipos de usuário
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 */
class Usuario extends CI_Model{
	
	/**
	 * @property Nome da tabela
	 */
	private $table = 'usuario';
	
	/**
	 * Cadastra um novo usuário
	 * @return bool
	 */
	public function cadastrar($data){
		return ($this->db->insert($this->table,$data))? TRUE:FALSE;
	}
	
	/**
	 * Retorna um usuário
	 * @param array $data Identificadores do usuário
	 * @return StdObject
	 */
	public function get_user($data){
		return $this->db->select("usuario.* , nivel_usuario.nome AS tipo")
				->from("usuario, nivel_usuario")
				->where("usuario.cpf = '{$data['cpf']}' AND usuario.nivel_usuario_id = nivel_usuario.id")
		 		->get()->result();
	}
	
	/**
	 * Retorna todos os usuários
	 * @return StdObject
	 */
	public function get(){
		return $this->db->get($this->table);
	}
	
	/**
	 * Atualiza um usuário
	 * @param array $data Dados alterados
	 * @return bool
	 */
	public function editar($data){
		$cpf = $data['cpf'];
		unset($data['cpf']);
		return ($this->db->where('cpf',$cpf)->update($this->table,$data))? TRUE:FALSE;
	}
	
	/**
	 * Apaga um usuário
	 * @param string $cpf CPF do usuário
	 * @return bool
	 */
	public function apagar($cpf){
		return ($this->db->delete($this->table,array('cpf' => $cpf)))?TRUE:FALSE;
	}
	
	/**
	 * Verifica se há um usuário logado
	 * @return void
	 */
	public function is_logged(){
		if(!$this->logged()){
			$data['title'] = "Login";
			$data['page'] = "pages/login";
			$this->load->view('template',$data);
		}
	}
	
	/**
	 * Verifica se há uma sessão de login
	 * @return bool
	 */
	private function logged(){
		return isset($this->session->userdata['logged']);
	}
}
/* End of file usuario_model.php */
/* Location: ./application/controllers/usuario_model.php */