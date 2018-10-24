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
		$this->load->view('template/footer');
		
	}

	public function cadastrar(){
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$estado = $this->popularEstado();
			$this->estado_model->inserir($estado);
			$this->session->set_flashdata('sucess', 'Estado cadastrado com sucesso!!!');
			redirect('estado');
		}
	}

	private function validaFormCadastro(){
		
		$this->form_validation->set_rules('sigla', 'Sigla','trim|required');
        return $this->form_validation->run();
	}

	private function popularEstado(){
		$estado['est_sigla'] = $this->input->post('sigla');
		if($this->input->post('id')){
			$estado['usu_id'] = $this->input->post('id');
		}
		return $estado;
	}
}