<?php

class Emprestimo extends CI_Controller{
	
	private $email_admin = 'fmsouza@ufrj.br';
	
	public function __construct(){
		parent::__construct();
		$this->usuario->is_logged();
	}
	
	/**
	 * Verifica se há exemplares disponíveis, para então permitir que seja feita a solicitação.
	 * Exibe uma tela com um calendário para selecionar a data de empréstimo e a de devolução.
	 */
	public function solicitar($codigo){
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
			$this->email->to($this->email_admin);
			$this->email->subject('Solicitação de Empréstimo');
			$message = file_get_contents('./application/views/template/email_admin.php');
			foreach($_POST['user'] as $key => $value)
				if(!is_object($value)) $message = $this->emprestimo->replace($key,$value,$message);
			$id = preg_replace("/[^0-9]/",'', $_POST['acervo_exemplar_codigo']);
			$itemData = $this->item->get_item($id);
			$codigo = $this->emprestimo->ultimoId();
			foreach($itemData[0] as $key => $value)
				if(!is_object($value)) $message = $this->emprestimo->replace($key,$value,$message);
			$message = $this->emprestimo->replace('data_emprestimo',$_POST['data_emprestimo'],$message);
			$message = $this->emprestimo->replace('data_devolucao',$_POST['data_devolucao'],$message);
			$message = $this->emprestimo->replace("link_aprovar",base_url()."emprestimo/aprovar/".$codigo,$message);
			$message = $this->emprestimo->replace("link_negar",base_url()."emprestimo/negar/".$codigo,$message);
			$this->email->message($message);
			$this->email->send();
			//Fim do E-mail de confirmação para o solicitante
		}
		else $data['msg'] = 'Não foi possível realizar a solicitação.';
		
		$data['title'] = 'Solicitação de empréstimo';
		$data['page'] = 'pages/emprestimo/comprovante';
		$data['row'] = $_POST;
		$this->load->view('template',$data);	
	}
	
	public function aprovar($id){
		$this->load->model('deferimento');
		if($this->deferimento->aprovar($id))
			$this->emailFeedback("deferido",$id);
		else exit("Erro");
	}
	
	public function negar($id){
		$this->load->model('deferimento');
		if($this->deferimento->negar($id))
			$this->emailFeedback("indeferido",$id);
		else exit("Erro");
	}
	
	private function emailFeedback($resposta,$id){
		$this->load->library('email');
		$this->load->model('item');
		$this->load->model('emprestimo_model','emprestimo');
			
		// E-mail de confirmação para o solicitante
		$this->email->from('naoresponda@geocart.igeo.ufrj.br','GEOCART');
		
		/*
		 * FIXME: cade o e-mail do cara?
		 */
		$to = $this->db->get_where("emprestimo_deferimento",array('formulario_emprestimo_id'=>$id))->result();
		$to = $to[0];
		$to = $this->db->get_where("usuario",array('cpf'=>$to->formulario_emprestimo_usuario_cpf))->result();
		$to = $to[0];
		$data = $to;
		
		$this->email->to($data->email);
		
		$this->email->subject('Solicitação de Empréstimo');
		
		switch($resposta){
			case "deferido":
				$message = file_get_contents('./application/views/template/email_feedback_deferido.php');
				$message = $this->emprestimo->replace('nome',$data->nome,$message);
				break;
			
			case "indeferido":
				$message = file_get_contents('./application/views/template/email_feedback_deferido.php');
				break;
		}
		$this->email->message($message);
		$this->email->send();
		echo "O pedido foi {$resposta} com sucesso!";
		echo "<script>Window.close()</script>";		
	}
}
