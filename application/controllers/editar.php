<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Esta classe controla as páginas do módulo de alteração de todos os tipos de dados
 * que o sisteme gere.
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 */
class Editar extends CI_Controller{
	
	/**
	 * Verifica se o usuário pode acessar esse módulo
	 * @return void
	 */
	function __construct(){
		parent::__construct();
		$this->usuario->is_logged();
	}
	
	/**
	 * Renderiza o formulário de atualização de dados de usuário com os dados do usuário.
	 * @param string $cpf CPF do usuário que será atualizado
	 * @return void
	 */
	public function usuario($cpf){
		$this->load->model('usuario');
		$this->load->model('nivel_usuario','nivel');
		$data['usuario'] 	= $this->usuario->get_user(array('cpf' => $cpf));
		$data['niveis']		= $this->nivel->get()->result();
		$data['title'] 		= "Editar - Usuário";
		$data['page'] 		= "pages/admin/editar/usuario";
		$this->load->view('template',$data);
	}
	
	/**
	 * Renderiza o formulário de atualização de tipo de usuário.
	 * @param int $id ID do tipo de usuário
	 * @return void
	 */
	public function permissao($id){
		$this->load->model('nivel_usuario','nivel');
		if($_POST){
			$data['msg']	= ($this->nivel->editar($_POST))?"Atualização realizado com sucesso!":"Erro no cadastro. Tente novamente.";
			$data['title']	= "Exibir - Tipo de Usuário";
			$data['page']	= "pages/admin/exibir/permissao";
		}
		else{
			$data['title']	= "Editar - Tipo de Usuário";
			$data['page']	= "pages/admin/editar/permissao";
		}
		$data['nivel']		= $this->nivel->get_nivel(array('id' => $id));
		$data['title'] 		= "Editar - Tipo de usuário";
		$this->load->view('template',$data);
	}
	
	/**
	 * Renderiza o formulário de atualização de Categorias.
	 * @param int $id ID da categoria
	 * @return void
	 */
	public function categoria($id){
		$this->load->model('categoria');
		if($_POST){
			$data['msg']		= ($this->categoria->editar($_POST))?"Atualização realizado com sucesso!":"Erro no cadastro. Tente novamente.";
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
	
	/**
	 * Renderiza o formulário de atualização de Registros de itens.
	 * @param string $setor Categoria sob a qual o Item se encontra cadastrado
	 * @param int $id Identificador do Item
	 * @return void
	 */
	public function item($setor,$id){
		$this->load->model('item');
		if($_POST){
			$_POST['keywords']	= $this->item->keywords($_POST); //Gera os dados das keywords
			$data['msg'] 		= ($this->item->editar($_POST))? "Atualização realizado com sucesso!":"Erro no cadastro. Tente novamente.";
			$data['title']		= "Exibir - Mapas e Cartas";
			$data['page']		= "pages/admin/exibir/mapa";
			$page				= 'exibir';
		}
		else $page = 'editar';
		
		$data['title']			= ucfirst($page).' - '.$this->item->title_setor($setor);
		$data['page']			= "pages/admin/".$page."/mapa";
		$data['mapa']			= $this->item->get_item($id);
		$this->load->view('template',$data);
	}
	
	/**
	 * Renderiza as páginas de resposta das ações de Retirada, Cancelamento e Devolução
	 * de empréstimos.
	 * @param string $acao Ação realizada
	 * @param int id Identificador do pedido
	 * @return void
	 */
	public function emprestimo($acao,$id){
		$this->load->model('emprestimo_model','emprestimo');
		switch($acao){
			case "retirar":
				if($this->emprestimo->retirar($id)){
					$this->load->model('emprestimo_model','emprestimo');
					$data['page'] = "pages/admin/retirar";
					$data['title'] = "Retirada";
					$data['registro'] = $this->emprestimo->getARetirar();
					$this->load->view('template',$data);
				}
				else
					$this->erro();
				break;
				
			case "cancelar":
				if($this->emprestimo->cancelar($id)){
					$this->load->model('emprestimo_model','emprestimo');
					$data['page'] = "pages/admin/retirar";
					$data['title'] = "Retirada";
					$data['registro'] = $this->emprestimo->getARetirar();
					$this->load->view('template',$data);
				}
				else
					$this->erro();
				break;
				
			case "devolver":
				if($this->emprestimo->devolver($id)){
					$this->load->model('emprestimo_model','emprestimo');
					$data['page'] = "pages/admin/devolucao";
					$data['title'] = "Devolução";
					$data['registro'] = $this->emprestimo->getADevolver();
					$this->load->view('template',$data);
				}
				else
					$this->erro();
				break;
		}
	}
	
	/**
	 * Renderiza uma tela de erro
	 * @return void
	 */
	private function erro(){
		$data['title'] = 'Erro';
		$data['page'] = "pages/admin/erro";
		$this->load->view('template',$data);
	}
}

/* End of file editar.php */
/* Location: ./application/controllers/editar.php */