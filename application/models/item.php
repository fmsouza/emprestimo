<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item extends CI_Model{
	
	/*
	 * Esse modelo é responsável por todas as interações de dados de categoria entre o
	 * banco e o sistema.
	 * 
	 * */
	
	private $table = 'acervo_item'; //tabela que contém os dados do item no acervo
	private $child = 'acervo_exemplar'; //tabela que contém registros dependentes da tabela $this->table.
	
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
	
	public function editar($data){
		/*
		 * Esse método é semelhante ao save. Porém altera um registro ao invés de cadastrar um novo.
		 */
		$id = $data['id'];
		unset($data['id']);
		if($this->db->where('id',$id)->update($this->table,$data))
			return true;
		else
			return false;
	}
	
	public function apagar($id){
		/*
		 * Exclui um registro identificado pelo parâmetro ID na tabela configurada em $this->table.
		 */
		if($this->get_dependencies($id))
			return false;
		else{
			if($this->db->delete($this->table,array('id' => $id)))
				return true;
			else
				return false;
		}
	}
	
	public function get($query){
		/*
		 * Esse método retorna todos os registros encontrados na tabela configurada em $this->table.
		 */
		return $query->get($this->table);
	}
	
	public function keywords($dados){
		/*
		 * Esse método retorna uma concatenação separada por vírgula de todos os dados presente no cadastro
		 */
		$string=NULL;
		foreach($dados as $data){
			if(!empty($data)){
				$data = str_replace('.', ',', $data);
				$data = str_replace('-', ',', $data);
				$data = str_replace('_', ',', $data);
				$data = str_replace(' ', ',', $data);
				$string.= $data.',';
			}
		}
		return substr($string,0,-1);
	}
	
	public function title_setor($name){
		$setor = array(
			'mapa'			=> 'Mapas e Cartas',
			'tese'			=> 'Teses, Livros e Artigos',
			'equipamento'	=> 'Equipamentos',
		);
		return $setor[$name];
	}
	
	public function mapas(){
		/*
		 * Esse método retorna todos os registros de mapas encontrados na tabela configurada em $this->table.
		 */
		return $this->db->where('acervo_categoria_id','mec')->get($this->table);
	}
	
	public function teses(){
		/*
		 * Esse método retorna todos os registros de teses encontrados na tabela configurada em $this->table.
		 */
		return $this->db->where('acervo_categoria_id','tlea')->get($this->table);
	}
	
	public function equipamentos(){
		/*
		 * Esse método retorna todos os registros de equipamentos encontrados na tabela configurada em $this->table.
		 */
		return $this->db->where('acervo_categoria_id','equ')->get($this->table);
	}
	
	private function get_dependencies($id){
		/*
		 * Verifica se há algum registro associado cadastrado em alguma outra tabela.
		 * Retorna TRUE caso haja e FALSE caso contrário.
		 */
		if($this->db->where(array('acervo_item_id' => $id))->get($this->child)->num_rows() > 0)
			return true;
		else
			return false;
	}
}

/* End of file item.php */
/* Location: ./application/controllers/item.php */