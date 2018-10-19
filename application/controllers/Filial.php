<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filial extends CI_Controller {

	public function index()
	{
		$this->load->view('template/header');
		$this->load->view('filial');
		$this->load->view('template/footer');
		
	}
}