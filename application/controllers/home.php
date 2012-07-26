<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){
		if($this->session->userdata['logged']){
			$data['title'] = "Início";
			$data['page'] = "home";
			$this->load->view('template',$data);
		}
		else header("Location: login");
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */