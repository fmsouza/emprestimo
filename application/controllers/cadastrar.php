<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Esta classe controla os cadastros. Realiza todas as operações de interação com as tabelas de cadastro
 * do banco do sistema.
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 */
class Cadastrar extends CI_Controller{
	
	/**
	 * Verifica se o usuário está logado para acessar o módulo.
	 * @return void
	 */
	function __construct(){
		parent::__construct();
		$this->usuario->is_logged();
	}
	
	/**
	 * Trata os dados do formulário de cadastro de Categoria e registra no banco.
	 * @return void
	 */
	public function categoria(){
		$this->load->model('categoria'); //carrega o modelo de categoria
		$_POST['id'] = $this->categoria->gera_id($this->input->post('titulo'));
		$data['msg'] = ($this->categoria->save($_POST))? "Cadastro realizado com sucesso!":"Erro no cadastro. Tente novamente.";
		$data['page'] = 'pages/cadastro/categorias';
		$data['title'] = 'Cadastro - Categorias';
		$this->load->view('template',$data);
	}
	
	/**
	 * Trata os dados do formulário de cadastro de Mapas e Cartas e registra no banco.
	 * @return void
	 */
	public function mapas(){
		$_POST['acervo_categoria_id'] = 'mec';
		$data['msg'] = $this->inserir_item($_POST);
		$data['page'] = 'pages/cadastro/mapas';
		$data['title'] = 'Cadastro - Mapas e Cartas';
		$this->load->view('template',$data);
	}
	
	/**
	 * Trata dos dados do formulário de cadastro de Livros, Teses ou Artigos e registra no banco.
	 * @return void
	 */
	public function teses(){
		$_POST['acervo_categoria_id'] = 'tlea';
		$data['msg'] = $this->inserir_item($_POST);
		$data['page'] = 'pages/cadastro/teses';
		$data['title'] = 'Cadastro - Teses, Livros e Artigos';
		$this->load->view('template',$data);
	}
	
	/**
	 * Trata os dados do formulário de registro de Equipamentos e registra no banco.
	 * @return void
	 */
	public function equipamentos(){
		$_POST['acervo_categoria_id'] = 'equ';
		$data['msg'] = $this->inserir_item($_POST);
		$data['page'] = 'pages/cadastro/equipamentos';
		$data['title'] = 'Cadastro - Equipamentos';
		$this->load->view('template',$data);
	}
	
	/**
	 * Realiza o cadastro do novo item e de seu primeiro exemplar.
	 * @return void
	 */
	private function inserir_item($dados){
		$this->load->model('item'); //Carrega o modelo de item
		$this->load->model('exemplar'); //Carrega o modelo de exemplar
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
	
	/**
	 * Trata os dados do formulário de cadastro de Tipos de Usuário e os registra no banco.
	 * @return void
	 */
	public function permissao(){
		$this->load->model('nivel_usuario','nivel'); //carrega o modelo de nível
		$data['msg'] = ($this->nivel->cadastrar($_POST))?"Cadastro realizado com sucesso!":"Erro no cadastro. Tente novamente.";
		$data['page'] = 'pages/cadastro/permissoes';
		$data['title'] = 'Cadastro - Tipos de Usuário';
		$this->load->view('template',$data);
	}
}
/* End of file cadastrar.php */
/* Location: ./application/controllers/cadastrar.php */