<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estado extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->controleacesso->verificaSeEstaLogado();
        $this->load->model('estado_model');
	}
	
	public function index()
	{
		$this->controleacesso->verficaPermisaoListar(6);
		$dados['estados'] = $this->estado_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('estado',$dados);
		
	}

	public function cadastrar(){
		$this->controleacesso->verficaPermisaoCadastrar(6);
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$estado = $this->popularEstado();
			$this->estado_model->inserir($estado);
			$this->session->set_flashdata('sucess', 'Estado cadastrado com sucesso!!!');
			redirect('estado');
		}
	}

	public function editar(){
		$this->controleacesso->verficaPermisaoEditar(6);
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
		$this->controleacesso->verficaPermisaoEditar(6);
		$estado = $this->estado_model->getEstadoId($id);
		echo json_encode($estado);
			
	}
	
	public function remover($id){
		$this->controleacesso->verficaPermisaoRemover(6);
		if($this->estado_model->deletar($id)){
			$this->session->set_flashdata('sucess', 'estado foi removido com sucesso!!!');
			redirect('estado');
		}else {
			if($this->db->error()['code'] === 1451){
				$this->session->set_flashdata('error', 'estado não pode ser excluido devido está associada a uma cidade existente.');
			}else {
				$this->session->set_flashdata('error', 'Erro desconhecido contate o suporte!');
			}
			redirect('estado');
		}
		
		
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