<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->controleacesso->verificaSeEstaLogado();
		$this->load->model('chamado_model');
	}
	
	public function index()
	{
		$dados['total_aberto'] = $this->chamado_model->contaChamadoStatus(1)->total;
		$dados['total_andamento'] = $this->chamado_model->contaChamadoStatus(2)->total;
		$dados['total_fechado'] = $this->chamado_model->contaChamadoStatus(3)->total;
		$this->load->view('template/header');
		$this->load->view('dashboard',$dados);
		$this->load->view('template/footer');
		
	}
}
