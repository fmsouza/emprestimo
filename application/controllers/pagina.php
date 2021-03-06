<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador de páginas gerais do sistema
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 * 
 */
class Pagina extends CI_Controller {
	
	/**
	 * @property códigos referentes às categorias
	 */
	private $setor;
	
	/**
	 * Verifica se o usuário está logado
	 * @return void
	 */
	function __construct(){
		parent::__construct();
		$this->usuario->is_logged();
		$this->setor = array(
			'mapas' 		=> 'mec',
			'teses' 		=> 'tlea',
			'equipamentos'	=> 'equ'
		); 
	}

	/**
	 * Carrega a página inicial do sistema
	 * @return void
	 */
	public function index(){
		$data['title'] = "o que quiser";
		$data['page'] = "pages/internal/pesquisa";
		$this->load->view('template',$data);
	}
	
	/**
	 * Carrega a tela de pesquisa desejada. É passado como argumento o setor de cadastro desejado.
	 * Então o sistema validará a opção fornecida de acordo com seus padrões. Caso haja conformidade,
	 * o usuário será redirecionado para a página da pesquisa que desejar. Caso contrário, será
	 * redirecionado para a página inicial.
	 * @return void
	 */
	public function pesquisa($setor){
		$data['page']  = "pages/internal/pesquisa";
		$data['setor'] = $setor;
		switch($setor){
			case "mapas":
				$data['title'] 	= "Mapas e Cartas";
				break;
			
			case "teses":
				$data['title'] 	= "Teses, Livros e Artigos";
				break;
			
			case "equipamentos":
				$data['title'] 	= "Equipamentos";
				break;
			
			default:
				header("Location: home");
				break;
		}
		$this->load->view('template',$data);
	}
	
	/**
	 * Carrega a tela de cadastro desejada. É passado como argumento o setor de cadastro desejado.
	 * Então o sistema validará a opção fornecida de acordo com seus padrões. Caso haja conformidade,
	 * o usuário será redirecionado para a página do cadastro que desejar. Caso contrário, será
	 * redirecionado para a página inicial.
	 * @return void
	 */
	public function cadastro($setor){
		$data['title'] = "Cadastro";
		$data['page'] = "pages/".__FUNCTION__."/".$setor;
		switch($setor){
			case "categorias":
				$this->nivel_usuario->verify_access('editar_categoria');
				$data['title'] 	.= " - Categorias";
				break;

			case "mapas":
				$this->nivel_usuario->verify_access('editar_categoria');
				$data['title'] 	.= " - Mapas e Cartas";
				break;
			
			case "teses":
				$this->nivel_usuario->verify_access('editar_categoria');
				$data['title'] 	.= " - Teses, Livros e Artigos";
				break;
			
			case "equipamentos":
				$this->nivel_usuario->verify_access('editar_categoria');
				$data['title'] 	.= " - Equipamentos";
				break;
			
			case "permissoes":
				$this->nivel_usuario->verify_access('editar_usuario');
				$data['title'] 	.= " - Tipos de usuário";
				break;
			
			
			default:
				header("Location: home");
				break;
		}
		$this->load->view('template',$data);
	}
	
	/**
	 * Carrega a tela de administração desejada. É passado como argumento o setor de administração desejado.
	 * Então o sistema validará a opção fornecida de acordo com seus padrões. Caso haja conformidade,
	 * o usuário será redirecionado para a página do cadastro que desejar. Caso contrário, será
	 * redirecionado para a página inicial.
	 * @return void
	 */
	public function admin($setor,$action=''){
		$data['title'] = "Administração";
		$data['page'] = "pages/".__FUNCTION__."/".$setor;
		switch($setor){
			case "usuarios":
				$this->nivel_usuario->verify_access('editar_usuario');
				$data['title'] 		.= " - Usuários";
				$this->load->model('usuario_model','usuario');
				$data['registro']	 = $this->usuario->get()->result();
				break;
				
			case "permissoes":
				$this->nivel_usuario->verify_access('editar_usuario');
				$data['title'] 	.= " - Tipos de Usuário";
				$data['registro']	 = $this->nivel_usuario->get()->result();
				break;
				
			case "categorias":
				$this->nivel_usuario->verify_access('editar_categoria');
				$data['title'] 	.= " - Categorias";
				$this->load->model('categoria');
				$data['registro']	 = $this->categoria->get()->result();
				break;

			case "mapas":
				$this->nivel_usuario->verify_access('editar_categoria');
				$data['title']	.= " - Mapas e Cartas";
				$this->load->model('item');
				$data['registro']	 = $this->item->mapas()->result();
				break;
			
			case "teses":
				$this->nivel_usuario->verify_access('editar_categoria');
				$data['title'] 	.= " - Teses e Artigos";
				$this->load->model('item');
				$data['registro']	 = $this->item->teses()->result();
				break;
			
			case "equipamentos":
				$this->nivel_usuario->verify_access('editar_categoria');
				$data['title'] 	.= " - Equipamentos";
				$this->load->model('item');
				$data['registro']	 = $this->item->equipamentos()->result();
				break;
			
			case "retirar":
				$this->load->model('emprestimo_model','emprestimo');
				$this->nivel_usuario->verify_access('deferir_emprestimo');
				$data['title'] 	.= " - Retirada";
				$data['registro'] = $this->emprestimo->getARetirar();
				break;
			
			case "devolucao":
				$this->load->model('emprestimo_model','emprestimo');
				$this->nivel_usuario->verify_access('deferir_emprestimo');
				$data['title'] 	.= " - Devolução";
				$data['registro'] = $this->emprestimo->getADevolver();
				break;
				
			case "blacklist":
				$this->load->model('blacklist');
				if($action=='notificar') $data['msg'] = ($this->blacklist->notifyAll())?'Notificações enviadas!':'Erro no envio das notificações.';
				$this->nivel_usuario->verify_access('editar_usuario');
				$data['title'] 	.= " - Lista Negra";
				$data['registro'] = $this->blacklist->get();
				break;
				
			case "emprestimos":
				$this->load->model('emprestimo_model','emprestimo');
				$data['title'] 	.= " - Lista de pedidos";
				$cpf = $this->session->userdata['userdata'][0]->cpf;
				$data['registro'] = $this->emprestimo->getPedidos($cpf);
				break;
			
			default:
				$data['page'] 	 = "pages/internal/pesquisa";
				break;
		}
		$this->load->view('template',$data);
	}
	
	/**
	 * Exibe detalhes de um determinado item
	 * @param int $id Identificador do item
	 * @return void
	 */
	public function visualizar($id){
		$this->load->model('item');
		$row = $this->item->get_item($id);
		$data['row'] = $row[0];
		$data['title'] = 'Visualizar Item';
		$data['page'] = 'pages/internal/visualizar';
		$this->load->view('template',$data);
	}
	
	/**
	 * Realiza a busca do sistema
	 * @return void
	 */
	public function buscar(){
		if($_POST && !empty($_POST['pesquisa'])){
			$this->load->model('item');
			$dados = $this->prepara_dados($_POST['pesquisa']);
			$resultado = $this->db;
			foreach($dados as $d){
				if($d!=$dados[0]) $resultado->or_where('keywords LIKE','%'.$d.'%');
				else $resultado->where('keywords LIKE','%'.$d.'%');
			}
			if(isset($_POST['setor'])) $setor = $_POST['setor']; 
			if(isset($setor)){
				$resultado->where('acervo_categoria_id',$this->setor($setor));
				$data['setor'] = $setor;
			}
			$data['pesquisa'] = $_POST['pesquisa'];
			$data['num_rows'] = $this->item->get(clone $resultado)->num_rows;
			$data['rows'] = $this->item->get($resultado)->result();
			$data['row_link'] = 'pagina/visualizar/';
			$data['page'] = "pages/internal/pesquisa";
			$this->load->view('template',$data);
		}
		else header("Location: home");
	}
	
	/**
	 * Trata os dados da busca para realizar a pesquisa
	 * @param array $dados Dados da busca
	 * @return array
	 */
	private function prepara_dados($dados){
		/*
		 * Esse método faz todos os tratamentos necessários para usar os dados recuperados do campo de busca
		 * do formulário para realizar a pesquisa
		 */
		$delimiters = array( "/" , "." , "," , "-" , "_" ); //delimitadores para remover da frase
		
		foreach($delimiters as $del) $dados = str_replace($del," ",$dados);
		return explode(" ",$dados);
	}
	
	/**
	 * Retorna o código da categoria
	 * @param string $name Nome da categoria
	 * @return string
	 */
	private function setor($name){
		/*
		 * Retorna o valor do setor na tabela
		 */
		return $this->setor[$name];
	}
}

/* End of file pagina.php */
/* Location: ./application/controllers/pagina.php */