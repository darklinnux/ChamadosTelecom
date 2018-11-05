<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->controleacesso->verificaSeEstaLogado();
		$this->load->model('perfil_model');
		$this->load->model('permissao_model');
	}
	
	public function index()
	{
		$this->controleacesso->verficaPermisaoListar(2);
		$dados['perfis'] = $this->perfil_model->listarTodos();
		$dados['funcionalidades'] = $this->permissao_model->getFuncionalidades();
		$this->load->view('template/header');
		$this->load->view('perfil',$dados);
		
	}

	public function cadastrar(){
		$this->controleacesso->verficaPermisaoCadastrar(2);
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$perfil = $this->popularPerfil();
			$this->perfil_model->inserir($perfil);
			$id = $this->db->insert_id();
			//Todo perfil é criado com todas as permissões zeradas!
			$funcionalidades = $this->permissao_model->getFuncionalidades();
			foreach($funcionalidades as $func){
				$permissao['perm_cadastrar'] = empty($this->input->post("func{$func->fun_id}Cadastrar") ? false : true);
				$permissao['perm_listar'] = empty($this->input->post("func{$func->fun_id}Listar") ? false : true);
				$permissao['perm_editar'] = empty($this->input->post("func{$func->fun_id}Editar") ? false : true);
				$permissao['perm_remover'] = empty($this->input->post("func{$func->fun_id}Remover") ? false : true);
				$permissao['perm_funcionalidade'] = $func->fun_id;
				$permissao['perm_perfil'] = $id;
				$this->permissao_model->inserir($permissao);
			}
			$this->session->set_flashdata('sucess', 'Perfil cadastrado com sucesso!!!');
			redirect('perfil');
		}
	}

	public function editar(){
		$this->controleacesso->verficaPermisaoEditar(2);
		//var_dump($_POST);die();
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro(true)) {
			$perfil = $this->popularPerfil();
			$this->perfil_model->update($perfil);
			$funcionalidades = $this->permissao_model->getFuncionalidades();
			foreach($funcionalidades as $func){
				$permissao['perm_cadastrar'] = empty($this->input->post("func{$func->fun_id}Cadastrar") ? false : true);
				$permissao['perm_listar'] = empty($this->input->post("func{$func->fun_id}Listar") ? false : true);
				$permissao['perm_editar'] = empty($this->input->post("func{$func->fun_id}Editar") ? false : true);
				$permissao['perm_remover'] = empty($this->input->post("func{$func->fun_id}Remover") ? false : true);
				$permissao['perm_perfil'] = $perfil['per_id'];
				/* echo '<pre>';
			var_dump($permissao);
			echo '</pre>'; */
				$this->permissao_model->update($permissao,$func->fun_id);
			}
			 //die();
			$this->session->set_flashdata('sucess', 'Perfil atualizado com sucesso!!!');
			redirect('perfil');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('perfil');
		}
	}


	public function carregarDadosEditar($id){
		$this->controleacesso->verficaPermisaoEditar(2);
		$perfil = $this->perfil_model->getPerfilId($id);
		$permissoes = $this->perfil_model->getPermissaoPerfilId($id);
		echo json_encode(array(
			'perfil' => $perfil,
			'permissao' => $permissoes
		));
			
	}
	
	public function remover($id){
		$this->controleacesso->verficaPermisaoRemover(2);
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

	private function validaFormCadastro($editar = false){
		
		$this->form_validation->set_rules('perfil', 'Perfil','trim|required');
		if($editar){
			$this->form_validation->set_message('perfil_callable', 'Perfil já em uso');
			$this->form_validation->set_rules(
				'perfil', 'perfil',
				array(
					'required',
					array(
						'perfil_callable',
						function ($perfil) {
							$id= $this->input->post('id');
							$dadosAnteriores = $this->perfil_model->getPerfilId($id);
							if ($perfil === $dadosAnteriores->per_perfil) {
								return true;
							}

							$perfil = $this->perfil_model->contaUsuario($perfil);

							if ($perfil->total == 0) {
								return true;
							} else {
								return false;
							}
						},
					),
				)
			);
		}else {
			$this->form_validation->set_rules('perfil', 'Perfil', 'trim|required|is_unique[perfil.per_perfil]');
		}
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