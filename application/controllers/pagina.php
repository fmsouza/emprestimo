<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagina extends CI_Controller {
	/*
	 * Este é o controlador de páginas. Aqui são definidos os métodos referentes ao carregamento
	 * de todas as páginas do sistema. Elas podem ser acessadas por pagina/<metodo> ou pelo endereço
	 * definido em application/config/routes.php
	 * 
	 * */
	
	function __construct(){
		parent::__construct();
		$this->usuario->is_logged(); // Verifica se está logado ou não
	}

	public function index(){
		// Carrega a página inicial.
		$data['title'] = "o que quiser";
		$data['page'] = "pages/internal/pesquisa";
		$this->load->view('template',$data);
	}
	
	public function pesquisa($setor){
		/*
		 * Carrega a tela de pesquisa desejada. É passado como argumento o setor de cadastro desejado.
		 * Então o sistema validará a opção fornecida de acordo com seus padrões. Caso haja conformidade,
		 * o usuário será redirecionado para a página da pesquisa que desejar. Caso contrário, será
		 * redirecionado para a página inicial.
		 * 
		 * */
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
	
	public function cadastro($setor){
		/*
		 * Carrega a tela de cadastro desejada. É passado como argumento o setor de cadastro desejado.
		 * Então o sistema validará a opção fornecida de acordo com seus padrões. Caso haja conformidade,
		 * o usuário será redirecionado para a página do cadastro que desejar. Caso contrário, será
		 * redirecionado para a página inicial.
		 * 
		 * */
		$data['title'] = "Cadastro";
		$data['page'] = "pages/".__FUNCTION__."/".$setor;
		switch($setor){
			case "categorias":
				$data['title'] 	.= " - Categorias";
				break;

			case "mapas":
				$data['title'] 	.= " - Mapas e Cartas";
				break;
			
			case "teses":
				$data['title'] 	.= " - Teses, Livros e Artigos";
				break;
			
			case "equipamentos":
				$data['title'] 	.= " - Equipamentos";
				break;
			
			default:
				header("Location: home");
				break;
		}
		$this->load->view('template',$data);
	}
	
	public function admin($setor){
		/*
		 * Carrega a tela de administração desejada. É passado como argumento o setor de administração desejado.
		 * Então o sistema validará a opção fornecida de acordo com seus padrões. Caso haja conformidade,
		 * o usuário será redirecionado para a página do cadastro que desejar. Caso contrário, será
		 * redirecionado para a página inicial.
		 * 
		 * */
		$data['title'] = "Administração";
		$data['page'] = "pages/".__FUNCTION__."/".$setor;
		switch($setor){
			case "usuarios":
				$data['title'] 		.= " - Usuários";
				$this->load->model('usuario_model','usuario');
				$data['registro']	 = $this->usuario->get()->result();
				break;
				
			case "permissoes":
				$data['title'] 	.= " - Tipos de Usuário";
				$this->load->model('nivel_usuario','nivel');
				$data['registro']	 = $this->nivel->get()->result();
				break;
				
			case "categorias":
				$data['title'] 	.= " - Categorias";
				$this->load->model('categoria');
				$data['registro']	 = $this->categoria->get()->result();
				break;

			case "mapas":
				$data['title']	.= " - Mapas e Cartas";
				$this->load->model('item');
				$data['registro']	 = $this->item->mapas()->result();
				break;
			
			case "teses":
				$data['title'] 	.= " - Teses e Artigos";
				$this->load->model('item');
				$data['registro']	 = $this->item->teses()->result();
				break;
			
			case "equipamentos":
				$data['title'] 	.= " - Equipamentos";
				$this->load->model('item');
				$data['registro']	 = $this->item->equipamentos()->result();
				break;
			
			default:
				$data['page'] 	 = "pages/internal/pesquisa";
				break;
		}
		$this->load->view('template',$data);
	}
	
	public function buscar(){
		/*
		 * Método responsável pela realização da busca
		 */
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
			$data['page'] = "pages/internal/pesquisa";
			$this->load->view('template',$data);
		}
		else header("Location: home");
	}
	
	private function prepara_dados($dados){
		/*
		 * Esse método faz todos os tratamentos necessários para usar os dados recuperados do campo de busca
		 * do formulário para realizar a pesquisa
		 */
		$delimiters = array( "/" , "." , "," , "-" , "_" ); //delimitadores para remover da frase
		
		foreach($delimiters as $del) $dados = str_replace($del," ",$dados);
		return explode(" ",$dados);
	}
	
	private function setor($name){
		/*
		 * Retorna o valor do setor na tabela
		 */
		$setor = array(
			'mapas' 		=> 'mec',
			'teses' 		=> 'tlea',
			'equipamentos'	=> 'equ'
		);
		return $setor[$name];
	}
}

/* End of file pagina.php */
/* Location: ./application/controllers/pagina.php */