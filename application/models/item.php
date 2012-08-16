<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends CI_Model{
	
	/*
	 * Esse modelo é responsável por todas as interações de dados de categoria entre o
	 * banco e o sistema.
	 * 
	 * */
	
	private $table = 'acervo_item'; //tabela que contém os dados do item no acervo
	
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
	
	public function insert_id(){
		/*
		 * Retorna o id do último registro inserido no banco logo após ser gravado.
		 * 
		 */
		return $this->db->insert_id();
	}
	
	public function get_item($id){
		/*
		 * Esse método recebe como parâmetro o id da categoria para que se possa buscar seus
		 * dados na base.
		 * 
		 * */
		$data['id'] = $id;
		return $this->db->get_where($this->table,$data,1)->result();
	}
}

/* End of file item.php */
/* Location: ./application/controllers/item.php */