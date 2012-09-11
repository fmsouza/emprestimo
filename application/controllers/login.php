<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
	
	public function index(){
		$this->usuario->is_logged();
		// Página inicial de login
		$data['title'] = "Login";
		$data['page'] = "pages/login";
		$this->load->view('template',$data);
	}
	
	public function novo(){
		//Página que contém o formulário de cadastro de novo usuário
		$data['title'] = "Novo Usuário";
		$data['page'] = "pages/cadastro/usuario";
		$this->load->view('template',$data);
	}
	
	public function auth(){
		//Faz a autenticação do usuário
		$user = $this->usuario->get_user($this->input->post());
		if(empty($user))
			$data['msg'] = "Usuário ou senha inválidos.";
		else{
			//cria a sessão e redireciona pra página inicial do usuário logado
			$this->session->set_userdata('logged',TRUE);
			$this->session->set_userdata('userdata',$user);
			header("Location: home");
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