<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
	
	public function index(){
		/*
		 * Página inicial de login:
		 * Verifica se há sessão de login criada e redireciona para a página com o formulário de
		 * login caso não haja ou para a página interna caso positivo.
		 * 
		 */
		if(!isset($this->session->userdata['logged'])){
			$data['title'] = "Login";
			$data['page'] = "pages/login";
			$this->load->view('template',$data);
		}
		else header("Location: home");
	}
	
	public function novo(){
		//Página que contém o formulário de cadastro de novo usuário
		$data['title'] = "Novo Usuário";
		$data['page'] = "pages/cadastro/usuario";
		$this->load->view('template',$data);
	}
	
	public function auth(){
		//Faz a autenticação do usuário
		$this->load->model("Usuario_model","usuario");
		$user = $this->usuario->get_user($this->input->post());
		if(empty($user))
			$data['msg'] = "Usuário ou senha inválidos.";
		else{
			//cria a sessão e redireciona pra página inicial do usuário logado
			$this->session->set_userdata('logged',TRUE);
			$this->session->set_userdata('userdata',$user);
			header("Location: ../home");
		}
	}
	
	public function off(){
		//Destrói a sessão para realizar o logoff do usuário
		$this->session->sess_destroy();
		header("Location: home");
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */