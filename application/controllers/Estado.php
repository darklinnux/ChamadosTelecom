<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estado extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
        $this->load->model('estado_model');
	}
	
	public function index()
	{
		$dados['estados'] = $this->estado_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('estado',$dados);
		
	}

	public function cadastrar(){
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$estado = $this->popularEstado();
			$this->estado_model->inserir($estado);
			$this->session->set_flashdata('sucess', 'Estado cadastrado com sucesso!!!');
			redirect('estado');
		}
	}

	public function editar(){
		//var_dump($_POST);die();
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$estado = $this->popularEstado();
			$this->estado_model->update($estado);
			$this->session->set_flashdata('sucess', 'Estado atualizado com sucesso!!!');
			redirect('estado');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('estado');
		}
	}


	public function carregarDadosEditar($id){
		$estado = $this->estado_model->getEstadoId($id);
		echo json_encode($estado);
			
	}

	public function remover($id){
		$this->estado_model->deletar($id);
		$this->session->set_flashdata('sucess', 'Estado foi removido com sucesso!!!');
		redirect('estado');
	  }

	private function validaFormCadastro(){
		
		$this->form_validation->set_rules('sigla', 'Sigla','trim|required');
		$this->form_validation->set_rules('sigla', 'Sigla', 'trim|required|is_unique[estado.est_sigla]');
        return $this->form_validation->run();
	}

	private function popularEstado(){
		$estado['est_sigla'] = $this->input->post('sigla');
		if($this->input->post('id')){
			$estado['est_id'] = $this->input->post('id');
		}
		return $estado;
	}
}