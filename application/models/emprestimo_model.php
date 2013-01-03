<?php

class Emprestimo_model extends CI_Model{
	
	private $table = array(
		'formulario'  => 'formulario_emprestimo',
		'finalidade'  => 'emprestimo_finalidade',
		'deferimento' => 'emprestimo_deferimento'
	);
	
	public function isBorrowed($id){
		$data = array('devolvido' => '0','acervo_exemplar_acervo_item_id' => $id);
		return ($this->db->get_where($this->table['formulario'], $data)->result())? TRUE:FALSE;
	}
	
	public function save($data){
		$data['usuario_cpf'] = $data['user']->cpf;
		unset($data['user']);
		$data['emprestimo_finalidade_id'] = (int) $data['emprestimo_finalidade_id'];
		$data['data_emprestimo'] = $this->prepareDate($data['data_emprestimo']);
		$data['data_devolucao'] = $this->prepareDate($data['data_devolucao']);
		$limite = (int) $_POST['prazo'];
		
		if($this->comparaData($data['data_devolucao'],$data['data_emprestimo'],$limite)){
			//Pega o código de um exemplar e o seta caso não esteja emprestado. Retorna false caso contrário
			$this->load->model('item');
			$item = $this->item->getFreeItemById($data['acervo_exemplar_codigo']);
			
			if($item) $data['acervo_exemplar_codigo'] = $item->codigo;
			else return false;
			
			return ($this->db->insert($this->table['formulario'], $data));
		}
		else return FALSE;
	}
	
	public function replace($key,$value,$string){
		return str_replace("::$key::",$value,$string);
	}
	
	private function prepareDate($date){
		$date = explode("/",$date);
		return "{$date[2]}-{$date[1]}-{$date[0]}";
	}
	
	/**
	 * 
	 * Recebe duas datas no padrão default do PHP ("Y-m-d") e verifica,
	 * primeiro, se a primeira é maior que a segunda, e então verifica se
	 * a diferença entre as duas está dentro do limite definido por $foo.
	 * 
	 * @param string $data1
	 * @param string $data2
	 * @param int $foo
	 * @return boolean
	 */
	public function comparaData($data1,$data2,$foo){
		if(strtotime($data1)>=strtotime($data2)){
			$dt1 = explode("-",$data1); // Y-m-d
			$dt2 = explode("-",$data2); // Y-m-d
			$diff[0] = $dt1[0]-$dt2[0]; // diferença dos anos
			$diff[1] = $dt1[1]-$dt2[1]; // diferença dos meses
			$diff[2] = $dt1[2]-$dt2[2]; // diferença dos dias
			$difDias = ((($diff[0]*12)+$diff[1])*30)+$diff[2]; // total de dias de dif.
			return ($difDias>$foo)? FALSE:TRUE; // verifica se a dif. respeita o limite
		}
		else return FALSE;
	}
}