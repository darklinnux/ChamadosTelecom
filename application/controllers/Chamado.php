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
	
	public function cadastrar(){
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$chamado = $this->popularChamado();
			$this->chamado_model->inserir($chamado);
			$this->session->set_flashdata('sucess', 'chamado cadastrado com sucesso!!!');
			redirect('chamado');
		}
	}

	public function editar(){
		//var_dump($_POST);die();
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$chamado = $this->popularChamado();
			$this->chamado_model->update($chamado);
			$this->session->set_flashdata('sucess', 'chamado atualizado com sucesso!!!');
			redirect('chamado');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('chamado');
		}
	}


	public function carregarDadosEditar($id){
		$chamado = $this->chamado_model->getchamadoId($id);
		echo json_encode($chamado);
			
	}

	public function remover($id){
		$this->chamado_model->deletar($id);
		$this->session->set_flashdata('sucess', 'chamado foi removido com sucesso!!!');
		redirect('chamado');
	  }

	private function validaFormCadastro(){
		
		$this->form_validation->set_rules('sigla', 'Sigla','trim|required');
		$this->form_validation->set_rules('sigla', 'Sigla', 'trim|required|is_unique[chamado.est_sigla]');
        return $this->form_validation->run();
	}

	private function popularChamado(){
		$chamado['est_sigla'] = $this->input->post('sigla');
		if($this->input->post('id')){
			$chamado['est_id'] = $this->input->post('id');
		}
		return $chamado;
	}
}