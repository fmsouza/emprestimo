<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
/**
 * Esta classe controla as interações entre a requisição de exclusão de determinado registro e a sua
 * execução no banco de dados.
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 */
class Apagar extends CI_Controller{
	
	/**
	 * Verifica se o usuário está logado no sistema
	 * @return void
	 */
	function __construct(){
		parent::__construct();
		$this->usuario->is_logged();
	}
	
	/**
	 * Apaga registro de usuário.
	 * @param string $cpf CPF do usuário
	 * @return void
	 */
	public function usuario($cpf){
		$this->load->model('Usuario_model','usuario');
		if($this->usuario->apagar($cpf))
			redirect("pagina/admin/usuarios");
		else{
			$data['msg'] = "Não foi possível apagar o registro.";
			$data['title'] = "Administração - Usuários";
			$data['page'] = "pages/admin/usuarios";
			$this->load->view('template',$data);
		}
	}
	
	/**
	 * Apaga registro de categoria.
	 * @param int $id Identificador da Categoria
	 * @return void 
	 */
	public function categoria($id){
		$this->load->model('categoria');
		if($this->categoria->apagar($id))
			redirect("pagina/admin/categorias");
		else{
			$data['msg'] = "Não foi possível apagar o registro.";
			$data['registro'] = $this->categoria->get()->result();
			$data['title'] = "Administração - Categorias";
			$data['page'] = "pages/admin/categorias";
			$this->load->view('template',$data);
		}
	}
	
	/**
	 * Apaga registro de qualquer ITEM.
	 * @param string $setor Categoria sob a qual o item esta registrado
	 * @param int $id Identificador do item
	 */
	public function item($setor,$id){
		$this->load->model('item');
		if($this->item->apagar($id))
			redirect("pagina/admin/".$setor);
		else{
			$data['msg'] = "Não foi possível apagar o registro.";
			$data['registro'] = $this->item->{$setor}()->result();
			$data['title'] = "Administração - ".$this->item->title_setor(substr($setor,0,-1));
			$data['page'] = "pages/admin/".$setor;
			$this->load->view('template',$data);
		}
	}
}

/* End of file apagar.php */
/* Location: ./application/controllers/apagar.php */
