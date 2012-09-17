<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Editar extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->usuario->is_logged();
	}
	
	/*
	 * Esta classe controla as páginas de alteração da administração de todos os cadastros.
	 * São essas páginas que exibem os formulários completos de cada item cadastrado na tabela de cada setor.
	 */
	public function usuario($cpf){
		/*
		 * Carrega a página de alteração de dados de usuário. Recebe como parâmetro o CPF para realizar a busca.
		 */
		$this->load->model('Usuario_model','usuario');
		$data['usuario'] 	= $this->usuario->get_user(array('cpf' => $cpf));
		$data['title'] 		= "Editar - Usuário";
		$data['page'] 		= "pages/admin/editar/usuario";
		$this->load->view('template',$data);
	}
	
	public function categoria($id){
		/*
		 * Carrega a página de exibição de dados de categoria. Recebe como parâmetro o ID para realizar a busca.
		 * Caso receba conteúdo pelo $_POST, realiza uma atualização nos registros.
		 */
		$this->load->model('categoria');
		
		if($_POST){
			if($this->categoria->editar($_POST))
				$data['msg'] 	= "Atualização realizado com sucesso!";
			else
				$data['msg']	= "Erro no cadastro. Tente novamente.";
			
			$data['title']		= "Exibir - Categoria";
			$data['page'] 		= "pages/admin/exibir/categoria";
		}
		else{
			$data['title'] 		= "Editar - Categoria";
			$data['page'] 		= "pages/admin/editar/categoria";
		}
		$data['categoria'] 		= $this->categoria->get_categoria($id);
		$this->load->view('template',$data);
	}
	
	public function item($setor,$id){
		/*
		 * Carrega a página de exibição de dados de qualquer categoria de item. Recebe como parâmetro o ID para
		 * realizar a busca.
		 * Caso receba conteúdo pelo $_POST, realiza uma atualização nos registros.
		 */
		$this->load->model('item');
		if($_POST){
			$_POST['keywords'] = $this->item->keywords($_POST); //Gera os dados das keywords
			if($this->item->editar($_POST))
				$data['msg'] = "Atualização realizado com sucesso!";
			else
				$data['msg'] = "Erro no cadastro. Tente novamente.";
			
			$page = 'exibir';
			$data['title'] 	 = "Exibir - Mapas e Cartas";
			$data['page'] 	 = "pages/admin/exibir/mapa";
		}
		else $page = 'editar';
		
		$data['title'] 	 = ucfirst($page).' - '.$this->item->title_setor($setor);
		$data['page'] 	 = "pages/admin/".$page."/mapa";
		$data['mapa'] 	 = $this->item->get_item($id);
		$this->load->view('template',$data);
	}
}

/* End of file editar.php */
/* Location: ./application/controllers/editar.php */