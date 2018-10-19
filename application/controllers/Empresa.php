<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('empresa');
		$this->load->view('template/footer');
		
	}
}