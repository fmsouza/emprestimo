<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Apagar extends CI_Controller{
	
	function __construct(){
		parent::__construct();
		$this->usuario->is_logged();
	}
	
	/*
	 * Esta classe controla as interações entre a requisição de exclusão de determinado registro e a sua
	 * execução no banco de dados.
	 */
	public function usuario($cpf){
		/*
		 * Apaga registro de usuário. Recebe como parâmetro o CPF para realizar a busca.
		 */
		$this->load->model('Usuario_model','usuario');
		if($this->usuario->apagar(array('cpf' => $cpf)))
			redirect("pagina/admin/usuarios");
		else{
			$data['msg'] = "Não foi possível apagar o registro.";
			$data['title'] = "Administração - Usuários";
			$data['page'] = "pages/admin/usuarios";
			$this->load->view('template',$data);
		}
	}
	
	public function categoria($id){
		/*
		 * Apaga registro de categoria. Recebe como parâmetro o ID para realizar a busca.
		 */
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
	
	public function item($setor,$id){
		/*
		 * Apaga registro de qualquer item. Recebe como parâmetros o setor e o ID para realizar a busca.
		 */
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