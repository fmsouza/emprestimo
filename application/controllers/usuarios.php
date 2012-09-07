<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends CI_Controller{
	
	public function novo(){
		/*
		 * Compara os campos de senha e confirmação de senha. Caso sejam iguais, realiza o
		 * cadastro do novo usuário.
		 * 
		 */
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
	
	public function editar(){
		/*
		 * Atualiza os dados de um usuário e depois abre a página de exibição de dados.
		 */
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