<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controle das páginas de exibição de dados detalhados de todos os tipos de registros.
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 * 
 */
 class Exibir extends CI_Controller{
	
	/**
	 * Verifica se o usuário possui permissão para acessar o módulo.
	 * @return void
	 */
	function __construct(){
		parent::__construct();
		$this->usuario->is_logged();
	}

	/**
	 * Renderiza a página de exibição de dados de usuário.
	 * @param string $cpf CPF do usuário
	 * @return void
	 */
	public function usuario($cpf){
		$this->load->model('Usuario_model','usuario');
		$data['usuario'] 	= $this->usuario->get_user(array('cpf' => $cpf));
		$data['title'] 		= "Exibir - Usuário";
		$data['page'] 		= "pages/admin/exibir/usuario";
		$this->load->view('template',$data);
	}
	
	/**
	 * Renderiza a página de exibição de dados de tipo de usuário.
	 * @param int $id Identificador do Tipo de usuário
	 * @return void
	 */
	public function permissao($id){
		$this->load->model('Nivel_usuario','nivel');
		$data['nivel'] 	= $this->nivel->get_nivel(array('id' => $id));
		$data['title'] 		= "Exibir - Tipo de Usuário";
		$data['page'] 		= "pages/admin/exibir/permissao";
		$this->load->view('template',$data);
	}
	
	/**
	 * Renderiza a página de exibição de dados de Categoria.
	 * @param int $id Identificador da Categoria
	 * @return void
	 */
	public function categoria($id){
		$this->load->model('categoria');
		$data['categoria'] 	= $this->categoria->get_categoria($id);
		$data['title'] 		= "Exibir - Categoria";
		$data['page'] 		= "pages/admin/exibir/categoria";
		$this->load->view('template',$data);
	}
	
	/**
	 * Renderiza a página de exibição de dados de mapas e cartas.
	 * @param string $setor Categoria sob a qual o ITEM está cadastrado
	 * @param int $id Identificador do ITEM
	 * @param $action Ação a realizar no carregamento
	 * @return void
	 */
	public function item($setor,$id,$action=''){
		/*
		 * Carrega a página de exibição de dados de mapas e cartas. Recebe como parâmetro o ID para realizar a busca.
		 */
		$this->load->model('item');
		if($action=='novoExemplar'){
			$this->load->model('exemplar');
			$item = $this->item->get_item($id);
			$item = $item[0];
			$numExemplares = count($this->exemplar->getExemplares($item->acervo_categoria_id.$item->id));
			$arr = array(
				'acervo_categoria_id' =>$item->acervo_categoria_id,
				'acervo_item_id' => $item->id
			);
			$data['msg'] = ($this->exemplar->novo($arr,$numExemplares+1))? 'Exemplar adicionado com sucesso!':'Erro na criação de um novo exemplar!';
		}
		$data[$setor] 		= $this->item->get_item($id);
		$data['title'] 		= "Exibir - ".$this->item->title_setor($setor);
		$data['numExemp']	= count($this->item->getExemplares($id));
		$data['page'] 		= "pages/admin/exibir/".$setor;
		$this->load->view('template',$data);
	}
}

/* End of file exibir.php */
/* Location: ./application/controllers/exibir.php */