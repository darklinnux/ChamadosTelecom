<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	
	public function __construct(){
    parent::__construct();
    $this->controleacesso->verificaSeEstaLogado();
		$this->load->model('usuario_model');
		$this->load->model('perfil_model');
	}

	public function index(){
		$dados['perfis'] = $this->perfil_model->listarTodos();
    $dados['status'] = $this->usuario_model->getStatus();
    $dados['usuarios'] = $this->usuario_model->listar();
		$this->load->view('template/header');
		$this->load->view('usuarios',$dados);
		
	}

	public function cadastrar(){
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$this->usuario_model->inserir($this->popularUsuario());
			echo json_encode(array(
				'sucess'=> true
			));
		}else {
			echo json_encode(array(
				'sucess' => false,
				'error' => validation_errors()
			));
		}
	}

	public function listar(){
		$usuarios = $this->usuario_model->listar();
		echo json_encode($usuarios);
	}

  public function editar(){
    
    if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormEditar()) {
      $usuario = $this->popularUsuario();
      $this->usuario_model->update($usuario);
        echo json_encode(array(
          'sucess'=> true
        ));
    }else{
      echo json_encode(array(
        'sucess' => false,
        'error' => validation_errors()
      )); 
    }
    
  }
  
  public function remover($id){
    $this->usuario_model->deletar($id);
    $this->session->set_flashdata('delete', 'Usuario foi removido com sucesso!!!');
    redirect('usuario');
  }

	public function carregarDadosEditar($id){
    $usuario = $this->usuario_model->getUsuarioId($id);
    echo json_encode($usuario);
		
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

	private function validaFormEditar(){
    
    $this->form_validation->set_rules('senha', 'senha', 'required|min_length[6]');
		$this->form_validation->set_rules('conf_senha', 'senhas devem ser iguais', 'required|matches[senha]');
    $this->form_validation->set_rules('perfil', 'Perfil','trim|required');
    $this->form_validation->set_rules('id', 'id','trim|required');
		$this->form_validation->set_rules('status', 'Status','trim|required');
    $this->form_validation->set_rules('nome', 'Nome','trim|required');
    $this->form_validation->set_message('login_callable', 'Usuario já em uso');
		$this->form_validation->set_rules(
            'login', 'login',
            array(
                'required',
                array(
                    'login_callable',
                    function ($login) {
                        $id= $this->input->post('id');
						            $dadosAnteriores = $this->usuario_model->getUsuarioId($id);
                        if ($login === $dadosAnteriores->usu_login) {
                            return true;
                        }

                        $usuario = $this->usuario_model->contaUsuario($login);

                        if ($usuario->total == 0) {
                            return true;
                        } else {
                            return false;
                        }
                    },
                ),
            )
        );
        return $this->form_validation->run();
	}
	
	private function popularUsuario(){
		$usuario['usu_nome'] = $this->input->post('nome');
		$usuario['usu_login'] = $this->input->post('login');
		$usuario['usu_senha'] = md5($this->input->post('senha'));
		$usuario['usu_status'] = $this->input->post('status');
    $usuario['usu_perfil'] = $this->input->post('perfil');
    if($this->input->post('id')){
      $usuario['usu_id'] = $this->input->post('id');
    }
		return $usuario;
	}
}