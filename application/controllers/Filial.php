<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filial extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('filial_model');
		$this->load->model('cidade_model');
	}

	public function index()
	{
		$dados['cidades'] = $this->cidade_model->listarTodos();
		$dados['filiais'] = $this->filial_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('filial',$dados);
		$this->load->view('template/footer');
		
	}
}