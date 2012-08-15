<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagina extends CI_Controller {
	/*
	 * Este é o controlador de páginas. Aqui são definidos os métodos referentes ao carregamento
	 * de todas as páginas do sistema. Elas podem ser acessadas por pagina/<metodo> ou pelo endereço
	 * definido em application/config/routes.php
	 * 
	 * */

	public function index(){
		/*
		 * Carrega a página inicial. Caso exista uma sessão com os dados do usuário ativa, o usuário
		 * poderá acessar o sistema. Caso contrário, ele será redirecionado para a tela de login.
		 * 
		 * */
		if($this->session->userdata['logged']){
			$data['title'] = "Início";
			$data['page'] = "pages/internal/home";
			$this->load->view('template',$data);
		}
		else header("Location: login");
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
		switch($setor){
			case "categorias":
				$data['title'] .= " - Categorias";
				$data['page'] = "pages/cadastro/categorias";
				break;

			case "mapas":
				$data['title'] .= " - Mapas e Cartas";
				$data['page'] = "pages/cadastro/mapas";
				break;
			
			case "teses":
				$data['title'] .= " - Teses e Artigos";
				$data['page'] = "pages/cadastro/teses";
				break;
			
			case "equipamentos":
				$data['title'] .= " - Equipamentos";
				$data['page'] = "pages/cadastro/equipamentos";
				break;
			
			default:
				$data['page'] = "pages/internal/home";
				break;
		}
		$this->load->view('template',$data);
	}
}

/* End of file pagina.php */
/* Location: ./application/controllers/pagina.php */