<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setor extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->controleacesso->verificaSeEstaLogado();
		$this->load->model('setor_model');
		
	}
	
	public function index()
	{
		$this->controleacesso->verficaPermisaoListar(8);
		$dados['setores'] = $this->setor_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('setores',$dados);
		
	}

	public function cadastrar(){
		$this->controleacesso->verficaPermisaoCadastrar(8);
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$setor = $this->popularSetor();
			$this->setor_model->inserir($setor);
			$this->session->set_flashdata('sucess', 'setor cadastrada com sucesso!!!');
			redirect('setor');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('setor');
		}
	}

	public function editar(){
		$this->controleacesso->verficaPermisaoEditar(8);
		//var_dump($_POST);die();
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$setor = $this->popularSetor();
			$this->setor_model->update($setor);
			$this->session->set_flashdata('sucess', 'setor atualizado com sucesso!!!');
			redirect('setor');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('setor');
		}
	}

	public function carregarDadosEditar($id){
		$setor = $this->setor_model->getsetorId($id);
		echo json_encode($setor);
			
	}

	public function remover($id){
		$this->controleacesso->verficaPermisaoRemover(8);
		if($this->setor_model->deletar($id)){
			$this->session->set_flashdata('sucess', 'setor foi removida com sucesso!!!');
			redirect('setor');
		}else {
			if($this->db->error()['code'] === 1451){
				$this->session->set_flashdata('error', 'setor não pode ser excluida devido está associada a um chamado existente.');
			}else {
				$this->session->set_flashdata('error', 'Erro desconhecido contate o suporte!');
			}
			redirect('setor');
		}
		
		
	}

	private function validaFormCadastro(){
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|is_unique[setor.set_nome]');
        return $this->form_validation->run();
	}

	private function popularSetor(){
		$setor['set_nome'] = $this->input->post('nome');
		if($this->input->post('id')){
			$setor['set_id'] = $this->input->post('id');
		}
		return $setor;
	}
}