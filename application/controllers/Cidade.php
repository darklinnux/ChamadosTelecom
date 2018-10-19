<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cidade extends CI_Controller {

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('cidade');
		$this->load->view('template/footer');
		
	}
}