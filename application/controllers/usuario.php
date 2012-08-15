<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller{
	
	private $values;
	
	function __construct(){
		parent::__construct();
		$this->load->model('Usuario_model','usuario');
	}
	
	public function novo(){
		/*
		 * Compara os campos de senha e confirmação de senha. Caso sejam iguais, realiza o
		 * cadastro do novo usuário.
		 * 
		 */
		if($this->input->post('senha')==$this->input->post('csenha')){
			$this->values = array();
			/*
			 *  TODO: remover esse foreach. É muito mais fácil remover a posição 'csenha' do
			 *  array utilizando a função unset() embutida no PHP.
			 *  
			 *  http://php.net/manual/pt_BR/function.unset.php
			 */
			
			foreach($this->input->post() as $key=>$value)
				if($key!='csenha')
					$this->values[$key] = $value;
			
			if($this->usuario->cadastrar($this->values))
				$data['msg'] = "Cadastro realizado com sucesso!";
			else
				$data['msg'] = "Erro no cadastro. Tente novamente.";
		}
		else $data['msg'] = "As senhas não conferem.";
		
		$data['title'] = "Novo Usuário";
		$data['page'] = "pages/login";
		$this->load->view('template',$data);
	}
}

/* End of file usuario.php */
/* Location: ./application/controllers/usuario.php */