<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controle de login
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 * 
 */
class Login extends CI_Controller{
	
	/**
	 * Página de login
	 * @return void
	 */
	public function index(){
		$this->usuario->is_logged();
		$data['title'] = "Login";
		$data['page'] = "pages/login";
		$this->load->view('template',$data);
	}
	
	/**
	 * Formulário de novo usuário
	 * @return void
	 */
	public function novo(){
		$data['title'] = "Novo Usuário";
		$data['page'] = "pages/cadastro/usuario";
		$this->load->view('template',$data);
	}
	
	/**
	 * Autentica o usuário
	 * @return void
	 */
	public function auth(){
		$user = $this->usuario->get_user($this->input->post());
		if(empty($user))
			$data['msg'] = "Usuário ou senha inválidos.";
		else{
			//cria a sessão e redireciona pra página inicial do usuário logado
			$nivel = $this->nivel_usuario->get_nivel(array('id'=>$user[0]->nivel_usuario_id));
			$user[0]->nivel = $nivel[0];
			$this->session->set_userdata('logged',TRUE);
			$this->session->set_userdata('userdata',$user);
			header("Location: ../home");
		}
	}
	
	/**
	 * Destrói a sessão do usuário
	 * @return void
	 */
	public function off(){
		$this->session->sess_destroy();
		header("Location: home");
	}
}

/* End of file login.php */
/* Location: ./application/controllers/login.php */