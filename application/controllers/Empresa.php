<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('empresa_model');
		
	}
	
	public function index()
	{
		$dados['empresas'] = $this->empresa_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('empresa',$dados);
		$this->load->view('template/footer');
		
	}
}