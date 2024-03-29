<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cidade extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('cidade_model');
		$this->load->model('estado_model');
		$this->controleacesso->verificaSeEstaLogado();
	}
	
	public function index()
	{
		$this->controleacesso->verficaPermisaoListar(5);
		$dados['cidades'] = $this->cidade_model->listarTodos();
		$dados['estados'] = $this->estado_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('cidade',$dados);
		
	}

	public function cadastrar(){
		$this->controleacesso->verficaPermisaoCadastrar(5);
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$cidade = $this->popularCidade();
			$this->cidade_model->inserir($cidade);
			$this->session->set_flashdata('sucess', 'cidade cadastrada com sucesso!!!');
			redirect('cidade');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('cidade');
		}
	}

	public function editar(){
		$this->controleacesso->verficaPermisaoEditar(5);
		//var_dump($_POST);die();
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$cidade = $this->popularCidade();
			$this->cidade_model->update($cidade);
			$this->session->set_flashdata('sucess', 'Cidade atualizada com sucesso!!!');
			redirect('cidade');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('cidade');
		}
	}

	public function carregarDadosEditar($id){
		$this->controleacesso->verficaPermisaoEditar(5);
		$cidade = $this->cidade_model->getCidadeId($id);
		echo json_encode($cidade);
			
	}

	public function remover($id){
		$this->controleacesso->verficaPermisaoRemover(5);
		if($this->cidade_model->deletar($id)){
			$this->session->set_flashdata('sucess', 'Cidade foi removida com sucesso!!!');
			redirect('cidade');
		}else {
			if($this->db->error()['code'] === 1451){
				$this->session->set_flashdata('error', 'Cidade não pode ser excluida devido está associada a uma filial existente.');
			}else {
				$this->session->set_flashdata('error', 'Erro desconhecido contate o suporte!');
			}
			redirect('cidade');
		}
		
		
	}

	private function validaFormCadastro(){
		
		$this->form_validation->set_rules('estado', 'Estado','trim|required');
		$this->form_validation->set_rules('cidade', 'Cidade', 'trim|required|is_unique[cidade.cid_nome]');
        return $this->form_validation->run();
	}

	private function popularCidade(){
		$cidade['cid_nome'] = $this->input->post('cidade');
		$cidade['cid_estado'] = $this->input->post('estado');
		if($this->input->post('id')){
			$cidade['cid_id'] = $this->input->post('id');
		}
		return $cidade;
	}

}