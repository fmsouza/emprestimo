<?php

class Emprestimo extends CI_Controller{
	
	public function __construct(){
		parent::__construct();
		$this->usuario->is_logged();
	}
	
	public function solicitar($codigo){
		/*
		 * Verifica se há exemplares disponíveis, para então permitir que seja feita a solicitação.
		 * 
		 * Exibe uma tela com um calendário para selecionar a data de empréstimo e a de devolução.
		 */
		$this->load->model('item');
		$this->load->model('finalidade');
		$row = $this->item->get_item($codigo);
		$data['finalidades'] = $this->finalidade->get();
		$data['row'] = $row[0];
		$data['title'] = 'Item - Reservar Data';
		$data['page'] = 'pages/emprestimo/solicitar';
		$this->load->view('template',$data);
	}
	
	public function requerer(){
		$_POST['user'] = $this->session->userdata['userdata'][0];
		$this->load->model('emprestimo_model','emprestimo');
		if($this->emprestimo->save($_POST)){
			$data['msg'] = 'Empréstimo solicitado com sucesso! Você deverá receber um e-mail de confirmação em breve.';
			
			$this->load->library('email');
			$this->load->model('item');
			
			// E-mail de confirmação para o solicitante
			$this->email->from('naoresponda@geocart.igeo.ufrj.br','GEOCART');
			$this->email->to($_POST['user']->email);
			$this->email->subject('Solicitação de Empréstimo');
			$message = file_get_contents('./application/views/template/email_customer.php');
			foreach($_POST['user'] as $key => $value)
				if(!is_object($value)) $message = $this->emprestimo->replace($key,$value,$message);
			$id = preg_replace("/[^0-9]/",'', $_POST['acervo_exemplar_codigo']);
			$itemData = $this->item->get_item($id);
			foreach($itemData[0] as $key => $value)
				if(!is_object($value)) $message = $this->emprestimo->replace($key,$value,$message);
			$message = $this->emprestimo->replace('data_emprestimo',$_POST['data_emprestimo'],$message);
			$message = $this->emprestimo->replace('data_devolucao',$_POST['data_devolucao'],$message);
			$this->email->message($message);
			$this->email->send();
			//Fim do E-mail de confirmação para o solicitante
			
			// E-mail de confirmação para o administrador
			$this->email->clear();
			$this->email->from('naoresponda@geocart.igeo.ufrj.br','GEOCART');
			$this->email->to("fmsouza@ufrj.br");
			$this->email->subject('Solicitação de Empréstimo');
			$message = file_get_contents('./application/views/template/email_admin.php');
			foreach($_POST['user'] as $key => $value)
				if(!is_object($value)) $message = $this->emprestimo->replace($key,$value,$message);
			$id = preg_replace("/[^0-9]/",'', $_POST['acervo_exemplar_codigo']);
			$itemData = $this->item->get_item($id);
			foreach($itemData[0] as $key => $value)
				if(!is_object($value)) $message = $this->emprestimo->replace($key,$value,$message);
			$message = $this->emprestimo->replace('data_emprestimo',$_POST['data_emprestimo'],$message);
			$message = $this->emprestimo->replace('data_devolucao',$_POST['data_devolucao'],$message);
			$message = $this->emprestimo->replace("link_aprovar",base_url()."emprestimo/aprovar/".$id,$message);
			$message = $this->emprestimo->replace("link_negar",base_url()."emprestimo/negar/".$id,$message);
			$this->email->message($message);
			$this->email->send();
			//Fim do E-mail de confirmação para o solicitante
		}
		else{
			$data['msg'] = 'Não foi possível realizar a solicitação.';
		}
		$data['title'] = 'Solicitação de empréstimo';
		$data['page'] = 'pages/emprestimo/comprovante';
		$data['row'] = $_POST;
		$this->load->view('template',$data);	
	}
	
	public function aprovar($id){
		echo "Aprovado!";
	}
	
	public function negar($id){
		echo "Negado!";
	}
	
	public function algo(){
		$this->load->model('exemplar');
		$this->load->model('emprestimo_model','emprestimo');
		$exemplares = $this->exemplar->getExemplares($codigo);
		$exemplaresDisponiveis = count($exemplares);
		
		foreach($exemplares as $exemplar){
			if($this->emprestimo->isBorrowed($exemplar->acervo_item_id))
				$exemplaresDisponiveis--;
		}
		
		if($exemplaresDisponiveis>0)
			echo $exemplaresDisponiveis;
		else
			$data['msg'] = "Não há exemplares disponíveis.";
	}
	
}
