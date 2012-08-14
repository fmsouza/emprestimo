<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{
	
	public function index(){
		if(!isset($this->session->userdata['logged'])){
			$data['title'] = "Login";
			$data['page'] = "pages/login";
			$this->load->view('template',$data);
		}
		else header("Location: home");
	}
	
	public function novo(){
		$data['title'] = "Novo Usuário";
		$data['page'] = "pages/cadastro/usuario";
		$this->load->view('template',$data);
	}
	
	public function auth(){
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