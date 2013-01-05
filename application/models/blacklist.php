<?php

class Blacklist extends CI_Model{
	
	public function __construct(){
		this->load->model('emprestimo_model','emprestimo');
	}
	
	public function isBlacklisted(){
		$data = $this->session->userdata['userdata'][0];
		return ($this->emprestimo->isLate($data->cpf))? TRUE:FALSE;
	}
	
	public function get(){
		return $this->emprestimo->getLate();
	}
}