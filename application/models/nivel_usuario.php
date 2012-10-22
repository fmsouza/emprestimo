<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Nivel_usuario extends CI_Model{
	
	/*
	 * Esse modelo é responsável por todas as interações de dados de usuários entre o
	 * banco e o sistema.
	 * 
	 * */
	private $values = array(
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
	
	private $table = 'nivel_usuario'; //tabela que contém os dados dos usuários
	
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
	
	public function get_nivel($data){
		/*
		 * Esse método recebe como parâmetro os dados da pesquisa do nível do usuário da forma
		 * como se deseja buscá-lo. Padrão: pareado de acordo com as colunas do banco, nomeando como
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
		$id = $data['id'];
		unset($data['id']);
		foreach($data as $key => $value){
			if($key!='nome') $this->values[$key] = ($value=='on')? 1:0;
			else $this->values[$key] = $value;
		}
		if($this->db->where('id',$id)->update($this->table,$this->values))
			return true;
		else
			return false;
	}
	
	public function getNivel($setor){
		return ($this->session->userdata['userdata'][0]->nivel->$setor)==1;
	}
	
	public function verify_access($param){
		if(!$this->getNivel($param)) header("Location: home");
	}
	
	public function apagar($id){
		/*
		 * Exclui um registro identificado pelo parâmetro CPF na tabela configurada em $this->table.
		 */
		if($this->db->delete($this->table,array('id' => $id)))
			return true;
		else
			return false;
	}
}

/* End of file nivel_usuario.php */
/* Location: ./application/models/nivel_usuario.php */