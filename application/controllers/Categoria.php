<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categoria extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
		$this->controleacesso->verificaSeEstaLogado();
		$this->load->model('categoria_model');
		
	}
	
	public function index()
	{
		$this->controleacesso->verficaPermisaoListar(9);
		$dados['categorias'] = $this->categoria_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('categorias',$dados);
		
	}

	public function cadastrar(){
		$this->controleacesso->verficaPermisaoCadastrar(9);
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$categoria = $this->popularCategoria();
			$this->categoria_model->inserir($categoria);
			$this->session->set_flashdata('sucess', 'categoria cadastrada com sucesso!!!');
			redirect('categoria');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('categoria');
		}
	}

	public function editar(){
		$this->controleacesso->verficaPermisaoEditar(9);
		//var_dump($_POST);die();
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$categoria = $this->popularCategoria();
			$this->categoria_model->update($categoria);
			$this->session->set_flashdata('sucess', 'categoria atualizado com sucesso!!!');
			redirect('categoria');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('categoria');
		}
	}

	public function carregarDadosEditar($id){
		$this->controleacesso->verficaPermisaoEditar(9);
		$categoria = $this->categoria_model->getcategoriaId($id);
		echo json_encode($categoria);
			
	}

	public function remover($id){
		$this->controleacesso->verficaPermisaoRemover(9);
		if($this->categoria_model->deletar($id)){
			$this->session->set_flashdata('sucess', 'categoria foi removida com sucesso!!!');
			redirect('categoria');
		}else {
			if($this->db->error()['code'] === 1451){
				$this->session->set_flashdata('error', 'categoria não pode ser excluida devido está associada a um chamado existente.');
			}else {
				$this->session->set_flashdata('error', 'Erro desconhecido contate o suporte!');
			}
			redirect('categoria');
		}
		
		
	}

	private function validaFormCadastro(){
		$this->form_validation->set_rules('nome', 'Nome', 'trim|required|is_unique[categoria.cat_nome]');
        return $this->form_validation->run();
	}

	private function popularCategoria(){
		$categoria['cat_nome'] = $this->input->post('nome');
		if($this->input->post('id')){
			$categoria['cat_id'] = $this->input->post('id');
		}
		return $categoria;
	}
}