<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exemplar extends CI_Model{
	
	/*
	 * Esse modelo é responsável por todas as interações de dados de categoria entre o
	 * banco e o sistema.
	 * 
	 * */
	
	private $table = 'acervo_exemplar'; //tabela que contém os dados dos usuários
	
	function __construct(){
		parent::__construct();
	}
	
	public function save($data){
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
	
	public function get_exemplar($id){
		/*
		 * Esse método recebe como parâmetro o id da categoria para que se possa buscar seus
		 * dados na base.
		 * 
		 * */
		$data['id'] = $id;
		return $this->db->get_where($this->table,$data,1)->result();
	}
}

/* End of file categoria.php */
/* Location: ./application/controllers/categoria.php */