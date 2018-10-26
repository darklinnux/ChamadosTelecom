<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chamado extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('chamado_model');
	}
	
	public function index()
	{
		$dados['chamados'] = $this->chamado_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('chamado',$dados);
		
    }
}