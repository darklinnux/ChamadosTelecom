<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chamado extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('chamado_model');
		$this->load->model('empresa_model');
		$this->load->model('filial_model');
		$this->load->model('sintoma_model');
	}
	
	public function index()
	{
		$dados['empresas'] = $this->empresa_model->listarTodos();
		$dados['filiais'] = $this->filial_model->listarTodos();
		$dados['sintomas'] = $this->sintoma_model->listarTodos();
		$dados['chamados'] = $this->chamado_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('chamado',$dados);
		
    }
}