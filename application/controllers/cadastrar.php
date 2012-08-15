<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cadastrar extends CI_Controller{
	
	/*
	 * Este é o controlador de cadastros. É responsável por realizar todas as operações de
	 * interação com o banco de dados de cadastros do sistema.
	 * 
	 * */
	
	function __construct(){
		$this->load->model('categoria');
		$this->load->model('item');
		$this->load->model('exemplar');
		parent::__construct();
	}
	
	public function categoria(){
		/*
		 * Este método recebe os dados do formulário do cadastro de Categorias, os armazena
		 * em $this->values e então registra no banco de dados.
		 * 
		 * */
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
		$this->inserir_item($_POST);
		$data['page'] = 'pages/cadastro/mapas';
		$this->load->view('template',$data);
	}
	
	public function teses(){
		/*
		 * Este método recebe os dados do formulário do cadastro de Teses, Livros e Artigos, os
		 * armazena em $this->values e então registra no banco de dados.
		 * 
		 * */
		$_POST['acervo_categoria_id'] = 'tlea';
		$this->inserir_item($_POST);
		$data['page'] = 'pages/cadastro/teses';
		$this->load->view('template',$data);
	}
	
	public function equipamentos(){
		/*
		 * Este método recebe os dados do formulário do cadastro de Equipamentos, os armazena
		 * em $this->values e então registra no banco de dados.
		 * 
		 * */
		$_POST['acervo_categoria_id'] = 'equ';
		$this->inserir_item($_POST);
		$data['page'] = 'pages/cadastro/equipamentos';
		$this->load->view('template',$data);
	}
	
	private function inserir_item($dados){
		/*
		 * Como essa ação é executada igualmente em todos os métodos, há um método que a realiza e
		 * basta chamá-lo dentro dos outros. É privado para poder ser acessado apenas através de outros
		 * métodos dentro desta classe.
		 * 
		 */
		if($this->item->save($dados))
			$data['msg'] = "Cadastro realizado com sucesso!";
		else
			$data['msg'] = "Erro no cadastro. Tente novamente.";
	}
}

/* End of file cadastrar.php */
/* Location: ./application/controllers/cadastrar.php */