<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->controleacesso->verificaSeEstaLogado();
		$this->load->model('chamado_model');
		$this->load->model('ChamadoInterno_model');
	}
	
	public function index()
	{
		$dados = $this->loadDados();
		$this->load->view('template/header');
		$this->load->view('dashboard',$dados);
		$this->load->view('template/footer');
		
	}

	private function loadDados(){
		$permissaoInterno = $this->controleacesso->verficaPermisaoListar(11,true);
		$permissaoProvedor = $this->controleacesso->verficaPermisaoListar(10,true);
		if($permissaoInterno){
			$dados['interno'] = true;
			$dados['total_aberto_interno'] = $this->ChamadoInterno_model->contaChamadoStatus(1)->total;
			$dados['total_andamento_interno'] = $this->ChamadoInterno_model->contaChamadoStatus(2)->total;
			$dados['total_fechado_interno'] = $this->ChamadoInterno_model->contaChamadoStatus(3)->total;
		}else {
			$dados['interno'] = false;
		}

		if($permissaoProvedor){
			$dados['provedor'] = true;
			$dados['total_aberto'] = $this->chamado_model->contaChamadoStatus(1)->total;
			$dados['total_andamento'] = $this->chamado_model->contaChamadoStatus(2)->total;
			$dados['total_fechado'] = $this->chamado_model->contaChamadoStatus(3)->total;
		}else {
			$dados['provedor'] = false;
		}
		return $dados;
	}
}
