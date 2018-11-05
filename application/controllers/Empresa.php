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
		$this->controleacesso->verficaPermisaoListar(7);
		$dados['empresas'] = $this->empresa_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('empresa',$dados);
		
	}

	public function cadastrar(){
		$this->controleacesso->verficaPermisaoCadastrar(7);
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
		$this->controleacesso->verficaPermisaoEditar(7);
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
		$this->controleacesso->verficaPermisaoEditar(7);
		$empresa = $this->empresa_model->getEmpresaId($id);
		echo json_encode($empresa);
			
	}

	public function remover($id){
		$this->controleacesso->verficaPermisaoRemover(7);
		if($this->empresa_model->deletar($id)){
			$this->session->set_flashdata('sucess', 'Empresa foi removida com sucesso!!!');
			redirect('empresa');
		}else {
			if($this->db->error()['code'] === 1451){
				$this->session->set_flashdata('error', 'Empresa não pode ser excluida devido está associada a um chamado existente.');
			}else {
				$this->session->set_flashdata('error', 'Erro desconhecido contate o suporte!');
			}
			redirect('empresa');
		}
		
		
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