<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exibir extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->usuario->is_logged();
	}
	
	/*
	 * Esta classe controla as páginas de exibição da administração de todos os cadastros.
	 * São essas páginas que exibem os detalhes completos de cada item cadastrado na tabela de cada setor.
	 */
	
	public function usuario($cpf){
		/*
		 * Carrega a página de exibição de dados de usuário. Recebe como parâmetro o CPF para realizar a busca.
		 */
		$this->load->model('Usuario_model','usuario');
		$data['usuario'] 	= $this->usuario->get_user(array('cpf' => $cpf));
		$data['title'] 		= "Exibir - Usuário";
		$data['page'] 		= "pages/admin/exibir/usuario";
		$this->load->view('template',$data);
	}
	
	public function categoria($id){
		/*
		 * Carrega a página de exibição de dados de categoria. Recebe como parâmetro o ID para realizar a busca.
		 */
		$this->load->model('categoria');
		$data['categoria'] 	= $this->categoria->get_categoria($id);
		$data['title'] 		= "Exibir - Categoria";
		$data['page'] 		= "pages/admin/exibir/categoria";
		$this->load->view('template',$data);
	}
	
	public function item($setor,$id){
		/*
		 * Carrega a página de exibição de dados de mapas e cartas. Recebe como parâmetro o ID para realizar a busca.
		 */
		$this->load->model('item');
		$data[$setor] 		= $this->item->get_item($id);
		$data['title'] 		= "Exibir - .".$this->item->title_setor($setor);
		$data['page'] 		= "pages/admin/exibir/".$setor;
		$this->load->view('template',$data);
	}
}

/* End of file exibir.php */
/* Location: ./application/controllers/exibir.php */