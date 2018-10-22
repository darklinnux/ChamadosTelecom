<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('usuario_model');
	}

	public function index(){
		$this->load->view('template/header');
		$this->load->view('usuarios');
		
	}

	public function cadastrar(){
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->usuario_model->inserir($this->popularUsuario());
			return true;
		}else {
			return false;
		}
	}

	private function validaFormCadastro(){
		
		$this->form_validation->set_rules('login', 'login', 'trim|required|is_unique[usuario.usu_login]');
        $this->form_validation->set_rules('senha', 'senha', 'required|min_length[6]');
		$this->form_validation->set_rules('conf_senha', 'senhas devem ser iguais', 'required|matches[senha]');
		$this->form_validation->set_rules('perfil', 'Perfil','trim|required');
		$this->form_validation->set_rules('status', 'Status','trim|required');
		$this->form_validation->set_rules('nome', 'Nome','trim|required');
        return $this->form_validation->run();
	}
	
	private function popularUsuario(){
		if($this->validaFormCadastro()){
			$usuario['usu_nome'] = $this->input->post('nome');
			$usuario['usu_login'] = $this->input->post('login');
			$usuario['usu_senha'] = $this->input->post('senha');
			$usuario['usu_status'] = $this->input->post('status');
			$usuario['usu_perfil'] = $this->input->post('perfil');
			return $usuario;
		}
	}
}