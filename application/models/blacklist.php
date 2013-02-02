<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Realiza as ações de Blacklist
 * 
 * @author Frederico Souza (fredericoamsouza@gmail.com)
 * @copyright 2012 Frederico Souza
 */
class Blacklist extends CI_Model{
	
	/**
	 * Carrega o modelo de Empréstimo
	 * @return void
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('emprestimo_model','emprestimo');
	}
	
	/**
	 * Verifica se o usuário está na blacklist
	 * @return bool
	 */
	public function isBlacklisted(){
		$data = $this->session->userdata['userdata'][0];
		return ($this->emprestimo->isLate($data->cpf))? TRUE:FALSE;
	}
	
	/**
	 * Retorna os Usuários que estão na Blacklist
	 * @return StdObject
	 */
	public function get(){
		return $this->emprestimo->getLate();
	}
	
	/**
	 * Notifica via e-mail todos os usuários que estão na blacklist
	 * @return bool
	 */
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