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
	
	public function mapa($id){
		/*
		 * Apaga registro de mapa ou carta. Recebe como parâmetro o ID para realizar a busca.
		 */
		$this->load->model('item');
		if($this->item->apagar($id))
			redirect("pagina/admin/mapas");
		else{
			$data['msg'] = "Não foi possível apagar o registro.";
			$data['registro'] = $this->item->mapas()->result();
			$data['title'] = "Administração - Mapas e Cartas";
			$data['page'] = "pages/admin/mapas";
			$this->load->view('template',$data);
		}
	}
	
	public function tese($id){
		/*
		 * Apaga registro de tese, livro ou artigo. Recebe como parâmetro o ID para realizar a busca.
		 */
		$this->load->model('item');
		if($this->item->apagar($id))
			redirect("pagina/admin/teses");
		else{
			$data['msg'] = "Não foi possível apagar o registro.";
			$data['registro'] = $this->item->teses()->result();
			$data['title'] = "Administração - Teses, Livros e Artigos";
			$data['page'] = "pages/admin/teses";
			$this->load->view('template',$data);
		}
	}
	
	public function equipamento($id){
		/*
		 * Apaga registro de equipamentos. Recebe como parâmetro o ID para realizar a busca.
		 */
		$this->load->model('item');
		if($this->item->apagar($id))
			redirect("pagina/admin/equipamentos");
		else{
			$data['msg'] = "Não foi possível apagar o registro.";
			$data['registro'] = $this->item->equipamentos()->result();
			$data['title'] = "Administração - Equipamento";
			$data['page'] = "pages/admin/equipamentos";
			$this->load->view('template',$data);
		}
	}
}

/* End of file apagar.php */
/* Location: ./application/controllers/apagar.php */