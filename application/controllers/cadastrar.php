<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadastrar extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->usuario->is_logged();
	}
	
	/*
	 * Este é o controlador de cadastros. É responsável por realizar todas as operações de
	 * interação com o banco de dados de cadastros do sistema.
	 * 
	 * */
	
	public function categoria(){
		/*
		 * Este método recebe os dados do formulário do cadastro de Categorias, os armazena
		 * em $this->values e então registra no banco de dados.
		 * 
		 * */
		$this->load->model('categoria'); //carrega o modelo de categoria
		
		$_POST['id'] = $this->categoria->gera_id($this->input->post('titulo'));
		if($this->categoria->save($_POST))
			$data['msg'] = "Cadastro realizado com sucesso!";
		else
			$data['msg'] = "Erro no cadastro. Tente novamente.";

		$data['page'] = 'pages/cadastro/categorias';
		$data['title'] = 'Cadastro - Categorias';
		$this->load->view('template',$data);
	}
	
	public function mapas(){
		/*
		 * Este método recebe os dados do formulário do cadastro de Mapas e Cartas, os armazena
		 * em $this->values e então registra no banco de dados.
		 * 
		 * */
		$_POST['acervo_categoria_id'] = 'mec';
		$data['msg'] = $this->inserir_item($_POST);
		$data['page'] = 'pages/cadastro/mapas';
		$data['title'] = 'Cadastro - Mapas e Cartas';
		$this->load->view('template',$data);
	}
	
	public function teses(){
		/*
		 * Este método recebe os dados do formulário do cadastro de Teses, Livros e Artigos, os
		 * armazena em $this->values e então registra no banco de dados.
		 * 
		 * */
		$_POST['acervo_categoria_id'] = 'tlea';
		$data['msg'] = $this->inserir_item($_POST);
		$data['page'] = 'pages/cadastro/teses';
		$data['title'] = 'Cadastro - Teses, Livros e Artigos';
		$this->load->view('template',$data);
	}
	
	public function equipamentos(){
		/*
		 * Este método recebe os dados do formulário do cadastro de Equipamentos, os armazena
		 * em $this->values e então registra no banco de dados.
		 * 
		 * */
		$_POST['acervo_categoria_id'] = 'equ';
		$data['msg'] = $this->inserir_item($_POST);
		$data['page'] = 'pages/cadastro/equipamentos';
		$data['title'] = 'Cadastro - Equipamentos';
		$this->load->view('template',$data);
	}
	
	private function inserir_item($dados){
		/*
		 * Como essa ação é executada igualmente em todos os métodos, há um método que a realiza e
		 * basta chamá-lo dentro dos outros. É privado para poder ser acessado apenas através de outros
		 * métodos dentro desta classe.
		 * 
		 */
		$this->load->model('item'); //Carrega o modelo de item
		$this->load->model('exemplar'); //Carrega o modelo de exemplar
		$dados['keywords'] = $this->item->keywords($dados); //Gera os dados das keywords
		if($this->item->save($dados)){
			$exemplar['acervo_categoria_id'] = $dados['acervo_categoria_id'];
			$exemplar['acervo_item_id'] = $this->item->insert_id();
			if($this->exemplar->save_first($exemplar))
				return "Cadastro realizado com sucesso!";
			else
				return "Cadastro realizado, porém não foi possível cadastrar primeiro exemplar.";
		}
		else
			return "Erro no cadastro. Tente novamente.";
	}
}

/* End of file cadastrar.php */
/* Location: ./application/controllers/cadastrar.php */