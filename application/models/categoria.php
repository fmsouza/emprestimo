<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categoria extends CI_Model{
	/*
	 * Esse modelo é responsável por todas as interações de dados de categoria entre o
	 * banco e o sistema.
	 * 
	 * */
	private $table = 'acervo_categoria'; //tabela que contém os dados dos usuários
	
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
	
	public function gera_id($titulo){
		/*
		 * Esse método recebe como parâmetro o título informado na tela de cadastro de categoria
		 * e devole um código gerado à partir dele da seguinte maneira:
		 * -transforma o título em array dividido pelos espaços
		 * -se esse array tiver mais que uma posição, ele pega o primeiro caracter de cada posição
		 * -caso contrário, pega os 3 primeiro caracteres do título fornecido e retorna o código.
		 * 
		 */
		$titulo = explode(' ',$titulo);
		$cod = '';
		if(count($titulo)>1)
			foreach($titulo as $parte) $cod .= substr($parte,0,1);
		else
			$cod .= substr($titulo[0],0,3);
		return strtolower($cod);
	}
	
	public function get_categoria($id){
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