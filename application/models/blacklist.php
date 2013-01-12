<?php

class Blacklist extends CI_Model{
	
	public function __construct(){
		$this->load->model('emprestimo_model','emprestimo');
	}
	
	public function isBlacklisted(){
		$data = $this->session->userdata['userdata'][0];
		return ($this->emprestimo->isLate($data->cpf))? TRUE:FALSE;
	}
	
	public function get(){
		return $this->emprestimo->getLate();
	}
	
	public function notifyAll(){
		$user = $this->get();
		$user = $user[0];
		$this->load->library('email');
			
		// E-mail de confirmação para o solicitante
		$this->email->from('naoresponda@geocart.igeo.ufrj.br','GEOCART');
		$this->email->to($user->email);
		$this->email->subject('Solicitação de Empréstimo');
		$message = file_get_contents('./application/views/template/email_blacklist.php');
		foreach($user as $key => $value)
			if(!is_object($value)) $message = $this->emprestimo->replace($key,$value,$message);
		$this->email->message($message);
		
		return ($this->email->send())? TRUE:FALSE;
	}
}