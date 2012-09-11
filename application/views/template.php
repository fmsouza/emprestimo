<?php
$this->load->view('template/header');
$this->load->view('template/menu');
$this->load->view($page);
$this->load->view('template/footer');
exit();