<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Filial extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->controleacesso->verificaSeEstaLogado();
		$this->load->model('filial_model');
		$this->load->model('cidade_model');
	}

	public function index()
	{
		$dados['cidades'] = $this->cidade_model->listarTodos();
		$dados['filiais'] = $this->filial_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('filial',$dados);
		
	}

	public function cadastrar(){
		//var_dump($_POST);die();
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$filial = $this->popularFilial();
			$this->filial_model->inserir($filial);
			$this->session->set_flashdata('sucess', 'filial cadastrada com sucesso!!!');
			redirect('filial');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('filial');
		}
	}

	public function editar(){
		//var_dump($_POST);die();
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro(true)) {
			$filial = $this->popularFilial();
			$this->filial_model->update($filial);
			$this->session->set_flashdata('sucess', 'filial atualizada com sucesso!!!');
			redirect('filial');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('filial');
		}
	}

	public function carregarDadosEditar($id){
		$filial = $this->filial_model->getFilialId($id);
		echo json_encode($filial);
			
	}

	public function remover($id){
		if($this->filial_model->deletar($id)){
			$this->session->set_flashdata('sucess', 'Filial foi removida com sucesso!!!');
			redirect('filial');
		}else {
			if($this->db->error()['code'] === 1451){
				$this->session->set_flashdata('error', 'Filial não pode ser excluida devido está associada a um chamado existente.');
			}else {
				$this->session->set_flashdata('error', 'Erro desconhecido contate o suporte!');
			}
			redirect('filial');
		}
		
		
	}

	private function validaFormCadastro($editar = false){
		$this->form_validation->set_rules('numero', 'Numero', 'trim|required');
		$this->form_validation->set_rules('cidade', 'cidade', 'trim|required');
		if($editar){
			$this->form_validation->set_message('nome_callable', 'Nome da filial já em uso');
			$this->form_validation->set_rules(
				'nome', 'Nome',
				array(
					'required',
					array(
						'nome_callable',
						function ($nome) {
							$id= $this->input->post('id');
										$dadosAnteriores = $this->filial_model->getFilialId($id);
							if ($nome === $dadosAnteriores->fil_nome) {
								return true;
							}

							$filial = $this->filial_model->contaFilial($nome);

							if ($filial->total == 0) {
								return true;
							} else {
								return false;
							}
						},
					),
				)
			);
		}else {
			$this->form_validation->set_rules('nome', 'Nome','trim|required|is_unique[filial.fil_nome]');
		}
        return $this->form_validation->run();
	}

	private function popularFilial(){
		$filial['fil_nome'] = $this->input->post('nome');
		$filial['fil_numero'] = $this->input->post('numero');
		$filial['fil_cidade'] = $this->input->post('cidade');
		if($this->input->post('id')){
			$filial['fil_id'] = $this->input->post('id');
		}
		return $filial;
	}
}