<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sintoma extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->controleacesso->verificaSeEstaLogado();
        $this->load->model('sintoma_model');
	}
	
	public function index()
	{
		$dados['sintomas'] = $this->sintoma_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('sintoma',$dados);
		
	}

	public function cadastrar(){
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$sintoma = $this->popularSintoma();
			$this->sintoma_model->inserir($sintoma);
			$this->session->set_flashdata('sucess', 'sintoma cadastrado com sucesso!!!');
			redirect('sintoma');
		}
	}

	public function editar(){
		//var_dump($_POST);die();
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$sintoma = $this->popularSintoma();
			$this->sintoma_model->update($sintoma);
			$this->session->set_flashdata('sucess', 'sintoma atualizado com sucesso!!!');
			redirect('sintoma');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('sintoma');
		}
	}


	public function carregarDadosEditar($id){
		$sintoma = $this->sintoma_model->getsintomaId($id);
		echo json_encode($sintoma);
			
	}
	
	public function remover($id){
		if($this->sintoma_model->deletar($id)){
			$this->session->set_flashdata('sucess', 'Sintoma foi removida com sucesso!!!');
			redirect('sintoma');
		}else {
			if($this->db->error()['code'] === 1451){
				$this->session->set_flashdata('error', 'Sintoma não pode ser excluida devido está associada a um chamado existente.');
			}else {
				$this->session->set_flashdata('error', 'Erro desconhecido contate o suporte!');
			}
			redirect('sintoma');
		}
		
		
	}

	private function validaFormCadastro(){
		
		$this->form_validation->set_rules('sintoma', 'Sintoma','trim|required');
		$this->form_validation->set_rules('sintoma', 'Sintoma', 'trim|required|is_unique[sintoma.sin_sintoma]');
        return $this->form_validation->run();
	}

	private function popularSintoma(){
		$sintoma['sin_sintoma'] = $this->input->post('sintoma');
		if($this->input->post('id')){
			$sintoma['sin_id'] = $this->input->post('id');
		}
		return $sintoma;
	}
}