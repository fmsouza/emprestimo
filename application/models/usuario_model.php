<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model{
	
	/*
	 * Esse modelo é responsável por todas as interações de dados de usuários entre o
	 * banco e o sistema.
	 * 
	 * */
	
	private $table = 'usuario'; //tabela que contém os dados dos usuários
	
	public function cadastrar($data){
		/*
		 * Esse método recebe como parâmetro os dados a serem inseridos no banco, já pareados
		 * de acordo com as colunas da tabela em forma de array() coluna->valor e os insere
		 * no banco. Caso os dados sejam inseridos, retorna TRUE. Caso contrário, retorna FALSE.
		 * 
		 * */
		if($this->db->insert($this->table,$data))
			return true;
		else
			return false;
	}
	
	public function get_user($data){
		/*
		 * Esse método recebe como parâmetro os dados da pesquisa do usuário da forma como se
		 * deseja buscá-lo. Padrão: pareado de acordo com as colunas do banco, nomeando como
		 * coluna->valor. Limitado para um resultado, já que se deseja buscar um único usuário,
		 * retorna os dados deste usuário caso ele exista e vazio caso contrário.
		 * 
		 * */
		return $this->db->get_where($this->table,$data,1)->result();
	}
	
	public function get(){
		/*
		 * Esse método retorna todos os registros encontrados na tabela configurada em $this->table.
		 */
		return $this->db->get($this->table);
	}
	
	public function editar($data){
		/*
		 * Esse método é semelhante ao cadastrar. Porém altera um registro ao invés de cadastrar um novo.
		 */
		$cpf = $data['cpf'];
		unset($data['cpf']);
		if($this->db->where('cpf',$cpf)->update($this->table,$data))
			return true;
		else
			return false;
	}
	
	public function apagar($cpf){
		/*
		 * Exclui um registro identificado pelo parâmetro CPF na tabela configurada em $this->table.
		 */
		if($this->db->delete($this->table,array('cpf' => $cpf)))
			return true;
		else
			return false;
	}
}

/* End of file usuario_model.php */
/* Location: ./application/controllers/usuario_model.php */