<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Interações com a tabela de emprestimo
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 */
class Emprestimo_model extends CI_Model{
	
	/**
	 * @property nomes das tabelas
	 */
	private $table;
	
	/**
	 * @ignore
	 */
	public function __construct(){
		$this->table = array(
			'formulario'  => 'formulario_emprestimo',
			'finalidade'  => 'emprestimo_finalidade',
			'deferimento' => 'emprestimo_deferimento'
		);
	}
	
	/**
	 * Verifica se determinado item está emprestado
	 * @param int $id Identificador
	 * @return bool
	 */
	public function isBorrowed($id){
		$data = array('devolvido' => '0','acervo_exemplar_acervo_item_id' => $id);
		return ($this->db->get_where($this->table['formulario'], $data)->result())? TRUE:FALSE;
	}
	
	/**
	 * Realiza uma solicitação de empréstimo
	 * @param array $data Dados da solicitação
	 * @return bool
	 */
	public function save($data){
		$data['usuario_cpf'] = $data['user']->cpf;
		unset($data['user']);
		$data['emprestimo_finalidade_id'] = (int) $data['emprestimo_finalidade_id'];
		$data['data_emprestimo'] = $this->prepareDate($data['data_emprestimo']);
		$data['data_devolucao'] = $this->prepareDate($data['data_devolucao']);
		$limite = (int) $_POST['prazo'];
		unset($data['prazo']);
		if($this->comparaData($data['data_devolucao'],$data['data_emprestimo'],$limite)){
			//Pega o código de um exemplar e o seta caso não esteja emprestado. Retorna false caso contrário
			$this->load->model('item');
			$item = $this->item->getFreeItemById($data['acervo_exemplar_codigo']);
			
			if($item) $data['acervo_exemplar_codigo'] = $item->codigo;
			else return FALSE;
			
			return ($this->db->insert($this->table['formulario'], $data));
		}
		else return FALSE;
	}
	
	/**
	 * Substitui dados em uma string
	 * @param string $key Palavra ou trecho identificador
	 * @param string $value Valor substituidor
	 * @param string $string String tratada
	 * @return string
	 */
	public function replace($key,$value,$string){
		return str_replace("::$key::",$value,$string);
	}
	
	/**
	 * Inverte uma data
	 * @param string $date Data
	 * @return string
	 */
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
	 * @return bool
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
	
	/**
	 * Verifica se um usuário está com algum item em atraso
	 * @param string $cpf CPF do usuário
	 * @return StdObect
	 */
	public function isLate($cpf){
		$data = array(
					'usuario_cpf'		=> $cpf,
					'data_devolucao <'  => 'CURDATE()',
					'devolvido'			=> '0',
					'retirado'			=> '1'
				);
		return $this->db->get_where($this->table['formulario'],$data);
	}
	
	/**
	 * Retorna todos os itens atrasados
	 * @return StdObject
	 */
	public function getLate(){
		$data = "`{$this->table['formulario']}`.`data_devolucao` < CURDATE() AND `{$this->table['formulario']}`.`devolvido` = 0 AND `{$this->table['formulario']}`.`retirado` = 1 AND `usuario`.`cpf` = `{$this->table['formulario']}`.`usuario_cpf`";
		return $this->db->select("{$this->table['formulario']}.usuario_cpf as cpf, usuario.nome, usuario.email, {$this->table['formulario']}.data_devolucao, {$this->table['formulario']}.devolvido, {$this->table['formulario']}.retirado")->from($this->table['formulario'].',usuario')->where($data)->group_by('usuario.email')->get()->result();
	}
	
	/**
	 * Retorna todos os pedidos de determinado usuário
	 * @param string $cpf CPF do usuário
	 * @return StdObject
	 */
	public function getPedidos($cpf){
		$data = array('usuario_cpf' => $cpf);
		return $this->db->select('id, usuario_cpf as cpf, acervo_exemplar_codigo as item, data_emprestimo, data_devolucao, retirado, devolvido')->from($this->table['formulario'])->where($data)->order_by("data_devolucao DESC")->get()->result();
	}
	
	/**
	 * Retorna todos os itens que foram deferidos e ainda não foram retirados
	 * @return StdObject
	 */
	public function getARetirar(){
		$data = array(
					'retirado' => '0'
				);
		return $this->db->select('id, usuario_cpf as cpf, acervo_exemplar_codigo as item, data_emprestimo, data_devolucao, retirado')->from($this->table['formulario'])->where($data)->get()->result();
	}
	
	/**
	 * Retorna todos os itens que foram retirados e ainda não foram devolvidos
	 * @return StdObject
	 */
	public function getADevolver(){
		$data = array(
					'retirado'  => '1',
					'devolvido' => '0'
				);
		return $this->db->select('id, usuario_cpf as cpf, acervo_exemplar_codigo as item, data_devolucao, retirado')->from($this->table['formulario'])->where($data)->get()->result();
	}
	
	/**
	 * Realiza uma retirada
	 * @param int $id Identificador do pedido
	 * @return bool
	 */
	public function retirar($id){
		$this->db->where(array('id'=>$id));
		return $this->db->update($this->table['formulario'],array('retirado'=>1));
	}
	
	/**
	 * Realiza um cancelamento
	 * @param int $id Identificador do pedido
	 * @return bool
	 */
	public function cancelar($id){
		return $this->db->delete($this->table['formulario'],array('id'=>$id));
	}
	
	/**
	 * Realiza uma devolução
	 * @param int $id Identificador do pedido
	 * @return bool
	 */
	public function devolver($id){
		$this->db->where(array('id'=>$id));
		return $this->db->update($this->table['formulario'],array('devolvido'=>1));
	}
	
	/**
	 * Retorna o último ID incluído na tabela
	 * @return int
	 */
	public function ultimoId(){
		return $this->db->insert_id();
	}
}