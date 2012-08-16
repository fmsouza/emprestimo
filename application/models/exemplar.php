<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exemplar extends CI_Model{
	/*
	 * Esse modelo é responsável por todas as interações de dados de categoria entre o
	 * banco e o sistema.
	 * 
	 * */
	private $table = 'acervo_exemplar'; //tabela que contém os dados dos usuários
	private $tam = 8;
	
	public function save_first($data){
		/*
		 * Esse método recebe como parâmetro os dados a serem inseridos no banco, já pareados
		 * de acordo com as colunas da tabela em forma de array() coluna->valor e os insere
		 * no banco. Caso os dados sejam inseridos, retorna TRUE. Caso contrário, retorna FALSE.
		 * 
		 * */
		$data['codigo'] = $data['acervo_categoria_id'].$data['acervo_item_id'].'-'; //Monta o início do código do exemplar
		$data['codigo'] .= $this->fill_zero(1,$this->tam - strlen($data['codigo'])); //Adiciona o código do primeiro exemplar
		$data['data_inclusao'] = date('Y-m-d');
		unset($data['acervo_categoria_id']);
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
	
	private function fill_zero($number,$n) {
		/*
		 * Parâmetros: int $number, $n
		 * Converte o número $number para um número com $n caracteres completando com zeros à
		 * esquerda.
		 * 
		 * Exemplo: fill_zero(26,5) = 00026
		 */
		return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
	}
}

/* End of file exemplar.php */
/* Location: ./application/controllers/exemplar.php */