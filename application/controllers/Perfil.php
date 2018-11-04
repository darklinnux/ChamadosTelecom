<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->controleacesso->verificaSeEstaLogado();
        $this->load->model('perfil_model');
	}
	
	public function index()
	{
		$dados['perfis'] = $this->perfil_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('perfil',$dados);
		
	}

	public function cadastrar(){
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$perfil = $this->popularPerfil();
			$this->perfil_model->inserir($perfil);
			$this->session->set_flashdata('sucess', 'Perfil cadastrado com sucesso!!!');
			redirect('perfil');
		}
	}

	public function editar(){
		//var_dump($_POST);die();
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$perfil = $this->popularPerfil();
			$this->perfil_model->update($perfil);
			$this->session->set_flashdata('sucess', 'Perfil atualizado com sucesso!!!');
			redirect('perfil');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('perfil');
		}
	}


	public function carregarDadosEditar($id){
		$perfil = $this->perfil_model->getperfilId($id);
		echo json_encode($perfil);
			
	}
	
	public function remover($id){
		if($this->perfil_model->deletar($id)){
			$this->session->set_flashdata('sucess', 'Perfil foi removido com sucesso!!!');
			redirect('perfil');
		}else {
			if($this->db->error()['code'] === 1451){
				$this->session->set_flashdata('error', 'Perfil não pode ser excluido devido está associada a uma cidade existente.');
			}else {
				$this->session->set_flashdata('error', 'Erro desconhecido contate o suporte!');
			}
			redirect('perfil');
		}
		
		
	}

	private function validaFormCadastro(){
		
		$this->form_validation->set_rules('perfil', 'Perfil','trim|required');
		$this->form_validation->set_rules('perfil', 'Perfil', 'trim|required|is_unique[perfil.per_perfil]');
        return $this->form_validation->run();
	}

	private function popularPerfil(){
		$perfil['per_perfil'] = $this->input->post('perfil');
		if($this->input->post('id')){
			$perfil['per_id'] = $this->input->post('id');
		}
		return $perfil;
	}
}