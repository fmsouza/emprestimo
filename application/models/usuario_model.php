<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario_model extends CI_Model{
	
	/*
	 * Esse modelo é responsável por todas as interações de dados de usuários entre o
	 * banco e o sistema.
	 * 
	 * */
	
	private $table = 'usuario'; //tabela que contém os dados dos usuários
	
	function __construct(){
		parent::__construct();
	}
	
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
}

/* End of file usuario_model.php */
/* Location: ./application/controllers/usuario_model.php */