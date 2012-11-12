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
		$data['msg'] = ($this->emprestimo->save($_POST))? 'Empréstimo solicitado com sucesso!':'Não foi possível realizar a solicitação';
		//exit($this->db->last_query());
		$data['title'] = 'Solicitação de empréstimo';
		$data['page'] = 'pages/emprestimo/comprovante';
		$data['row'] = $_POST;
		$this->load->view('template',$data);	
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