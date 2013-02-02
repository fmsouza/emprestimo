<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controlador de ações do usuário
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 * 
 */
class Usuarios extends CI_Controller{
	
	/**
	 * Cadastra um novo usuário
	 * @return void
	 */
	public function novo(){
		if($this->input->post('senha')==$this->input->post('csenha')){
			unset($_POST['csenha']);
			if($this->usuario->cadastrar($_POST))
				$data['msg'] = "Cadastro realizado com sucesso!";
			else
				$data['msg'] = "Erro no cadastro. Tente novamente.";
		}
		else $data['msg'] = "As senhas não conferem.";
		
		$data['title'] = "Novo Usuário";
		$data['page'] = "pages/login";
		$this->load->view('template',$data);
	}
	
	/**
	 * Atualiza os dados do usuário
	 * @return void
	 */
	public function editar(){
		if($this->usuario->editar($_POST))
			$data['msg'] = "Atualização realizado com sucesso!";
		else
			$data['msg'] = "Erro no cadastro. Tente novamente.";
		
		$data['usuario'] = $this->usuario->get_user(array('cpf' => $_POST['cpf']));
		$data['title'] = "Exibir - Usuário";
		$data['page'] = "pages/admin/exibir/usuario";
		$this->load->view('template',$data);
	}
}
/* End of file usuario.php */
/* Location: ./application/controllers/usuario.php */