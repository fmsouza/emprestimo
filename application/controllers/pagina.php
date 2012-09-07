<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagina extends CI_Controller {
	/*
	 * Este é o controlador de páginas. Aqui são definidos os métodos referentes ao carregamento
	 * de todas as páginas do sistema. Elas podem ser acessadas por pagina/<metodo> ou pelo endereço
	 * definido em application/config/routes.php
	 * 
	 * */
	
	function __construct(){
		parent::__construct();
		$this->usuario->is_logged();
	}

	public function index(){
		// Carrega a página inicial.
		$data['title'] = "Início";
		$data['page'] = "pages/internal/home";
		$this->load->view('template',$data);
	}
	
	public function mapas(){
		/*
		 * Carrega a tela de consulta de Mapas e Cartas.
		 * 
		 * */
		$data['title'] = "Mapas e Cartas";
		$data['page'] = "pages/internal/mapas";
		$this->load->view('template',$data);
	}
	
	public function teses(){
		/*
		 * Carrega a tela de consulta de Teses, Livros e Artigos.
		 * 
		 * */
		$data['title'] = "Teses, Livros e Artigos";
		$data['page'] = "pages/internal/teses";
		$this->load->view('template',$data);
	}
	
	public function equipamentos(){
		/*
		 * Carrega a tela de consulta de Equipamentos.
		 * 
		 * */
		$data['title'] = "Equipamentos";
		$data['page'] = "pages/internal/equipamentos";
		$this->load->view('template',$data);
	}
	
	public function cadastro($setor){
		/*
		 * Carrega a tela de cadastro desejada. É passado como argumento o setor de cadastro desejado.
		 * Então o sistema validará a opção fornecida de acordo com seus padrões. Caso haja conformidade,
		 * o usuário será redirecionado para a página do cadastro que desejar. Caso contrário, será
		 * redirecionado para a página inicial.
		 * 
		 * */
		$data['title'] = "Cadastro";
		$data['page'] = "pages/".__FUNCTION__."/".$setor;
		switch($setor){
			case "categorias":
				$data['title'] 	.= " - Categorias";
				break;

			case "mapas":
				$data['title'] 	.= " - Mapas e Cartas";
				break;
			
			case "teses":
				$data['title'] 	.= " - Teses e Artigos";
				break;
			
			case "equipamentos":
				$data['title'] 	.= " - Equipamentos";
				break;
			
			default:
				$data['page']	 = "pages/internal/home";
				break;
		}
		$this->load->view('template',$data);
	}
	
	public function admin($setor){
		/*
		 * Carrega a tela de administração desejada. É passado como argumento o setor de administração desejado.
		 * Então o sistema validará a opção fornecida de acordo com seus padrões. Caso haja conformidade,
		 * o usuário será redirecionado para a página do cadastro que desejar. Caso contrário, será
		 * redirecionado para a página inicial.
		 * 
		 * */
		$data['title'] = "Administração";
		$data['page'] = "pages/".__FUNCTION__."/".$setor;
		switch($setor){
			case "usuarios":
				$data['title'] 		.= " - Usuários";
				$this->load->model('usuario_model','usuario');
				$data['registro']	 = $this->usuario->get()->result();
				break;
				
			case "categorias":
				$data['title'] 	.= " - Categorias";
				$this->load->model('categoria');
				$data['registro']	 = $this->categoria->get()->result();
				break;

			case "mapas":
				$data['title']	.= " - Mapas e Cartas";
				$this->load->model('item');
				$data['registro']	 = $this->item->mapas()->result();
				break;
			
			case "teses":
				$data['title'] 	.= " - Teses e Artigos";
				$this->load->model('item');
				$data['registro']	 = $this->item->teses()->result();
				break;
			
			case "equipamentos":
				$data['title'] 	.= " - Equipamentos";
				$this->load->model('item');
				$data['registro']	 = $this->item->equipamentos()->result();
				break;
			
			default:
				$data['page'] 	 = "pages/internal/home";
				break;
		}
		$this->load->view('template',$data);
	}
}

/* End of file pagina.php */
/* Location: ./application/controllers/pagina.php */