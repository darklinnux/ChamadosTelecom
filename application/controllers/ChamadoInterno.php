<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChamadoInterno extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->controleacesso->verificaSeEstaLogado();
		$this->session->unset_userdata('andamento');
		$this->load->model('ChamadoInterno_model');
		$this->load->model('categoria_model');
		$this->load->model('filial_model');
		$this->load->model('setor_model');
		$this->load->model('usuario_model');
		$this->load->helper('telegram');
	}
	
	public function index()
	{
		redirect('ChamadoInterno/aberto');
		
    }
    
    public function aberto(){
		$this->controleacesso->verficaPermisaoListar(11);
        $dados['titulo'] = "Abertos/Andamento";
        $dados['categorias'] = $this->categoria_model->listarTodos();
		$dados['filiais'] = $this->filial_model->listarTodos();
		$dados['setores'] = $this->setor_model->listarTodos();
		$dados['niveis'] = $this->ChamadoInterno_model->getNivelChamado();
		$dados['status'] = $this->ChamadoInterno_model->getStatusChamado();
		$dados['chamados'] = $this->ChamadoInterno_model->listarTodosAberto();
		$this->load->view('template/header');
		$this->load->view('chamadoInterno',$dados);
    }

    public function fechado(){
		$this->controleacesso->verficaPermisaoListar(11);
        $dados['titulo'] = "Fechados";
        $dados['categorias'] = $this->categoria_model->listarTodos();
		$dados['filiais'] = $this->filial_model->listarTodos();
		$dados['setores'] = $this->setor_model->listarTodos();
		$dados['niveis'] = $this->ChamadoInterno_model->getNivelChamado();
		$dados['status'] = $this->ChamadoInterno_model->getStatusChamado();
		$dados['chamados'] = $this->ChamadoInterno_model->listarTodosFechado();
		$this->load->view('template/header');
		$this->load->view('chamadoInterno',$dados);
	}
	
	public function andamento($id = false){
		$this->controleacesso->verficaPermisaoListar(12);
		$parametro = (int) $id;
		if($parametro !== 0){
			$dados['titulo'] = "Fechados";
			$dados['categorias'] = $this->categoria_model->listarTodos();
			$dados['filiais'] = $this->filial_model->listarTodos();
			$dados['setores'] = $this->setor_model->listarTodos();
			$dados['niveis'] = $this->ChamadoInterno_model->getNivelChamado();
			$dados['status'] = $this->ChamadoInterno_model->getStatusChamado();
			$dados['usuarios'] = $this->usuario_model->listar();
			$dados['chamado'] = $this->ChamadoInterno_model->listarChamadoId($id);
			$dados['comentarios'] = $this->ChamadoInterno_model->listarComentarios($id);
			$this->load->view('template/header');
			$this->load->view('andamento',$dados);
		}else {
			$this->session->set_flashdata('error', 'Chamado Invalido');
			redirect('ChamadoInterno/aberto');
		}
		
	}
	
	public function cadastrar(){
		$this->controleacesso->verficaPermisaoCadastrar(11);
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$chamado = $this->popularChamado();
			$this->ChamadoInterno_model->inserir($chamado);
			$id = $this->db->insert_id();
			//die('sem erro');
			sendMessageGrupoInterno($this->getTextMensagem($id));
			$this->session->set_flashdata('sucess', 'chamado cadastrado com sucesso!!!');
			redirect('ChamadoInterno/aberto');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('ChamadoInterno/aberto');
		}
	}

	public function editar(){
		$this->controleacesso->verficaPermisaoEditar(11);
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$chamado = $this->popularChamado(true);
			$this->ChamadoInterno_model->update($chamado);
			$id = $chamado['cha_id'];
			//die('sem erro');
			sendMessageGrupoInterno($this->getTextMensagem($id,true));
			$this->session->set_flashdata('sucess', 'chamado atualizado com sucesso!!!');
			redirect('ChamadoInterno/aberto');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('ChamadoInterno/aberto');
		}
	}


	public function carregarDadosEditar($id){
		$chamado = $this->ChamadoInterno_model->getchamadoId($id);
		echo json_encode($chamado);
			
	}

	public function atualizarAndamento(){
		$this->controleacesso->verficaPermisaoEditar(12);

		$chamado['cha_id'] = $this->input->post("id");

		switch ($this->input->post("campo")) {
			case 'nivel':
				$chamado['cha_nivel'] = $this->input->post("nivel");
				break;
			case 'status':
				$chamado['cha_status'] = $this->input->post("status");
				break;
			case 'previsao':
				$chamado['cha_previsao'] = empty($this->input->post('previsao')) ? null : date('Y-m-d',strtotime(str_replace("/","-",$this->input->post('previsao'))));
				break;
			case 'responsavel':
				$chamado['cha_responsavel'] = $this->input->post('responsavel');
				break;
			
			default:
				# code...
				break;
		}
		/* var_dump($chamado);die(); */
		if($this->ChamadoInterno_model->update($chamado)){
			sendMessageGrupoInterno($this->getTextMensagem($chamado['cha_id'],true));
			echo json_encode(true);
		}else {
			echo json_encode(false);
		}
	}

	public function comentar(){
		$this->form_validation->set_rules('comentario', 'Comentario','trim|required');
		$this->form_validation->set_rules('idChamado', 'ID Chamado','trim|required');
        
		if($this->input->server('REQUEST_METHOD') === 'POST' && $this->form_validation->run()){
			$comentario['com_comentario'] = $this->input->post('comentario');
			$comentario['com_chamado'] = $this->input->post('idChamado');
			$comentario['com_usuario'] = $this->session->usu_id;
			$comentario['com_data'] = date('Y-m-d H:i:s');
			if($this->ChamadoInterno_model->inserirComentario($comentario)){
				$this->session->set_flashdata('sucess', 'Comentário Adicionado');
			}else {
				$this->session->set_flashdata('error', 'Comentário Não foi adicionado');
			}
			redirect("ChamadoInterno/andamento/{$this->input->post('idChamado')}");
		}else {
			$this->session->set_flashdata('error', validation_errors());
			echo 'n validou';
			echo validation_errors();
			redirect("ChamadoInterno/andamento/{$this->input->post('idChamado')}");
		}
	}

	public function remover($id){
		$this->controleacesso->verficaPermisaoRemover(11);
		if($this->ChamadoInterno_model->deletar($id)){
			$this->session->set_flashdata('sucess', 'Chamado foi removido com sucesso!!!');
			redirect('ChamadoInterno/aberto');
		}else {
			if($this->db->error()['code'] === 1451){
				//$this->session->set_flashdata('error', 'Chamado não pode ser excluida devido está associada a um chamado existente.');
				$this->session->set_flashdata('error', 'Erro desconhecido contate o suporte!');
			}else {
				$this->session->set_flashdata('error', 'Erro desconhecido contate o suporte!');
			}
			redirect('ChamadoInterno/aberto');
		}
		
		
	}
	private function validaFormCadastro(){
		
		$this->form_validation->set_rules('categoria', 'Categoria','trim|required');
		$this->form_validation->set_rules('setor', 'Setor','trim|required');
		$this->form_validation->set_rules('assunto', 'Assunto','trim|required');
		$this->form_validation->set_rules('descricao', 'Descrição','trim|required');
		$this->form_validation->set_rules('filial', 'Filial','trim|required');
		$this->form_validation->set_rules('previsao', 'Previsão','trim|required');
		$this->form_validation->set_rules('nivel', 'Nivel','trim|required');

		//$this->form_validation->set_rules('sigla', 'Sigla', 'trim|required|is_unique[chamado.est_sigla]');
        return $this->form_validation->run();
	}

	private function popularChamado($editar = false){
		$chamado['cha_categoria'] = $this->input->post('categoria');
		$chamado['cha_previsao'] = empty($this->input->post('previsao')) ? null : date('Y-m-d',strtotime(str_replace("/","-",$this->input->post('previsao'))));
		$chamado['cha_setor'] = $this->input->post('setor');
		$chamado['cha_assunto'] = $this->input->post('assunto');
		$chamado['cha_descricao'] = $this->input->post('descricao');
		$chamado['cha_filial'] = $this->input->post('filial');
		$chamado['cha_nivel'] = $this->input->post('nivel');
		
		if($this->input->post('status')){
			$chamado['cha_status'] = $this->input->post('status');
		}else {
			$chamado['cha_status'] = 1;
		}
		if($this->input->post('id')){
			$chamado['cha_id'] = $this->input->post('id');
		}

		if(!$editar){
			$chamado['cha_usuario'] = $this->session->usu_id;
			$chamado['cha_data_inicio'] = date("Y-m-d H:i:s");
		}
		return $chamado;
	}

	public function getTextMensagem($id,$editar = false){
		$chamado = $this->ChamadoInterno_model->listarChamadoId($id);
		
		if($editar){
			return 
			"Chamado Atualizado
			
			Responsavel: ".$this->session->usu_login."
			".
			"[Chamado]→Chamado Interno
			[Filial]→".$chamado->fil_numero."-".$chamado->fil_nome."
			[Nivel]→ ".$chamado->cha_nivel."
			[Categoria]→".$chamado->cat_nome."
			[Setor]→".$chamado->set_nome."
			[Data/Hora]→".$chamado->cha_data_inicio."
			[assunto]→".$chamado->cha_assunto."
			[Previsão]→".$chamado->cha_previsao."
			[status]→".$this->ChamadoInterno_model->getStatusId($chamado->cha_status)->stc_status."
			[usuario]→".$chamado->usu_login."
			[Link]→".base_url("ChamadoInterno/andamento/".$chamado->cha_id)."";
		}else {
			return 
			" [Chamado]→Chamado Interno
			[Filial]→".$chamado->fil_numero."-".$chamado->fil_nome."
			[Nivel]→ ".$chamado->cha_nivel."
			[Categoria]→".$chamado->cat_nome."
			[Setor]→".$chamado->set_nome."
			[Data/Hora]→".$chamado->cha_data_inicio."
			[assunto]→".$chamado->cha_assunto."
			[Previsão]→".$chamado->cha_previsao."
			[status]→".$this->ChamadoInterno_model->getStatusId($chamado->cha_status)->stc_status."
			[usuario]→".$chamado->usu_login."
			[Link]→".base_url("ChamadoInterno/andamento/".$chamado->cha_id)."";
			}
	}
	
}