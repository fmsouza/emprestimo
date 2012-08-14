<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagina extends CI_Controller {
	/*
	 * Este é o controlador de páginas. Aqui são definidos os métodos referentes ao carregamento
	 * de todas as páginas do sistema. Elas podem ser acessadas por pagina/<metodo> ou pelo endereço
	 * definido em application/config/routes.php
	 * 
	 * */

	public function index(){
		if($this->session->userdata['logged']){
			$data['title'] = "Início";
			$data['page'] = "pages/internal/home";
			$this->load->view('template',$data);
		}
		else header("Location: login");
	}
	
	public function mapas(){
		$data['title'] = "Mapas e Cartas";
		$data['page'] = "pages/internal/mapas";
		$this->load->view('template',$data);
	}
	
	public function teses(){
		$data['title'] = "Teses e Artigos";
		$data['page'] = "pages/internal/teses";
		$this->load->view('template',$data);
	}
	
	public function equipamentos(){
		$data['title'] = "Equipamentos";
		$data['page'] = "pages/internal/equipamentos";
		$this->load->view('template',$data);
	}
	
	public function cadastro($setor){
		$data['title'] = "Cadastro";
		switch($setor){
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