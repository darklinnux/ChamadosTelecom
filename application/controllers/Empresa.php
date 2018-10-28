<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->controleacesso->verificaSeEstaLogado();
		$this->load->model('empresa_model');
		
	}
	
	public function index()
	{
		$dados['empresas'] = $this->empresa_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('empresa',$dados);
		
	}

	public function cadastrar(){
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$empresa = $this->popularEmpresa();
			$this->empresa_model->inserir($empresa);
			$this->session->set_flashdata('sucess', 'empresa cadastrada com sucesso!!!');
			redirect('empresa');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('empresa');
		}
	}

	public function editar(){
		//var_dump($_POST);die();
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$empresa = $this->popularEmpresa();
			$this->empresa_model->update($empresa);
			$this->session->set_flashdata('sucess', 'empresa atualizado com sucesso!!!');
			redirect('empresa');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('empresa');
		}
	}

	public function carregarDadosEditar($id){
		$empresa = $this->empresa_model->getEmpresaId($id);
		echo json_encode($empresa);
			
	}

	public function remover($id){
		$this->empresa_model->deletar($id);
		$this->session->set_flashdata('sucess', 'Empresa foi removida com sucesso!!!');
		redirect('empresa');
	}

	private function validaFormCadastro(){
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|is_unique[empresa.emp_nome]');
        return $this->form_validation->run();
	}

	private function popularEmpresa(){
		$empresa['emp_nome'] = $this->input->post('nome');
		if($this->input->post('id')){
			$empresa['emp_id'] = $this->input->post('id');
		}
		return $empresa;
	}
}