<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estado extends CI_Controller {

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('estado');
		$this->load->view('template/footer');
		
	}
}