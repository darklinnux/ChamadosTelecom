<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chamado extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->controleacesso->verificaSeEstaLogado();
		$this->load->model('chamado_model');
		$this->load->model('empresa_model');
		$this->load->model('filial_model');
		$this->load->model('sintoma_model');
		$this->load->helper('telegram');
	}
	
	public function index()
	{
		redirect('chamado/aberto');
	}

	public function aberto(){
		$this->controleacesso->verficaPermisaoListar(10);
		$dados = $this->loadDadosViewDefault('aberto');
		if($this->controleacesso->verificarPermissaoVerTodos(10)){
			$dados['chamados'] = $this->chamado_model->listarTodosAberto();	
		}else{
			$dados['chamados'] = $this->chamado_model->listarAbertoUsuario();
		}
		$this->load->view('template/header');
		$this->load->view('chamado',$dados);
	}

	public function fechado(){
		$this->controleacesso->verficaPermisaoListar(10);
		$dados = $this->loadDadosViewDefault('aberto');
		if($this->controleacesso->verificarPermissaoVerTodos(10)){
			$dados['chamados'] = $this->chamado_model->listarTodosFechado();	
		}else{
			$dados['chamados'] = $this->chamado_model->listarFechadoUsuario();
		}
		$this->load->view('template/header');
		$this->load->view('chamado',$dados);
	}
	
	public function cadastrar(){
		$this->controleacesso->verficaPermisaoCadastrar(10);
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$chamado = $this->popularChamado();
			$this->chamado_model->inserir($chamado);
			//Pega o utimo id e inseri na tabela de lista filiais do chamado
			$id = $this->db->insert_id();
			$this->inserirFilialChamado($id,function($filiais){
				$this->chamado_model->inserirListaFilial($filiais);
			});
			$this->inserirSintomaChamado($id,function($sintomas){
				$this->chamado_model->inserirListaSintoma($sintomas);
			});
			//die('sem erro');
			//sendMessageGrupo($this->getTextMensagem($id));
			$this->session->set_flashdata('sucess', 'chamado cadastrado com sucesso!!!');
			redirect('chamado/aberto');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('chamado/aberto');
		}
	}

	public function editar(){
		$this->controleacesso->verficaPermisaoEditar(10);
		//var_dump($_POST);die();
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$chamado = $this->popularChamado(true);
			$this->chamado_model->update($chamado);
			$id = $chamado['cha_id'];
			$this->chamado_model->deletarFiliaisChamado($id);
			$this->chamado_model->deletarSintomasChamado($id);

			$this->inserirFilialChamado($id,function($filiais){
				$this->chamado_model->inserirListaFilial($filiais);
			});
			$this->inserirSintomaChamado($id,function($sintomas){
				$this->chamado_model->inserirListaSintoma($sintomas);
			});
			//die('sem erro');
			//sendMessageGrupo($this->getTextMensagem($id,true));
			$this->session->set_flashdata('sucess', 'chamado atualizado com sucesso!!!');
			redirect('chamado/aberto');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('chamado/aberto');
		}
	}


	public function carregarDadosEditar($id){
		$this->controleacesso->verficaPermisaoEditar(10);
		$chamado = $this->chamado_model->getchamadoId($id);
		echo json_encode($chamado);
			
	}

	public function carregarDadosFilialEditar($id){
		$this->controleacesso->verficaPermisaoEditar(10);
		$chamado = $this->chamado_model->getFilialChamadoId($id);
		echo json_encode($chamado);
	}

	public function carregarDadosSintomaEditar($id){
		$this->controleacesso->verficaPermisaoEditar(10);
		$chamado = $this->chamado_model->getSintomaChamadoId($id);
		echo json_encode($chamado);
	}

	public function remover($id){
		$this->controleacesso->verficaPermisaoRemover(10);
		$this->chamado_model->deletar($id);
		$this->session->set_flashdata('sucess', 'chamado foi removido com sucesso!!!');
		redirect('chamado/aberto');
	  }

	private function validaFormCadastro(){
		
		$this->form_validation->set_rules('protocolo', 'Previsão','trim|required');/* 
		$this->form_validation->set_rules('previsao', 'Previsão','trim');
		$this->form_validation->set_rules('designacao', 'Designação','trim|required');
		$this->form_validation->set_rules('atendente', 'Atendente','trim|required'); */
		$this->form_validation->set_rules('empresa', 'Empresa','trim|required');
		$this->form_validation->set_rules('filial[]', 'Filiais','trim|required');
		$this->form_validation->set_rules('sintoma[]', 'Sintomas','trim|required');/* 
		$this->form_validation->set_rules('motivo', 'Motivo','trim|required');
		$this->form_validation->set_rules('nivel', 'Nivel','trim|required'); */

		//$this->form_validation->set_rules('sigla', 'Sigla', 'trim|required|is_unique[chamado.est_sigla]');
        return $this->form_validation->run();
	}

	private function popularChamado($editar = false){
		$chamado['cha_protocolo'] = $this->input->post('protocolo');
		$chamado['cha_previsao'] = empty($this->input->post('previsao')) ? '' : date('Y-m-d',strtotime(str_replace("/","-",$this->input->post('previsao'))));
		$chamado['cha_atendente'] = $this->input->post('atendente');
		$chamado['cha_designacao'] = $this->input->post('designacao');
		$chamado['cha_empresa'] = $this->input->post('empresa');
		$chamado['cha_motivo'] = $this->input->post('motivo');
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

	private function inserirFilialChamado($idChamado,$callback){
		$listaFiliais = $this->input->post('filial[]');
		for ($i = 0 ; $i < count($listaFiliais);$i++){
			$filiais['chf_chamado'] = $idChamado;
			$filiais['chf_filial'] = $listaFiliais[$i];
			$callback($filiais);
		}
	}

	private function inserirSintomaChamado($idChamado,$callback){
		$listaSintoma = $this->input->post('sintoma[]');
		for ($i = 0 ; $i < count($listaSintoma);$i++){
			$sintomas['chs_chamado'] = $idChamado;
			$sintomas['chs_sintoma'] = $listaSintoma[$i];
			$callback($sintomas);
		}
	}

	public function getTextMensagem($id,$editar = false){
		$chamado = $this->chamado_model->listarChamadoId($id);
		$filiais = null;
		$sintomas = null;
		$listaSintoma = $this->chamado_model->getSintomaChamadoId($id);
		$listaFilial = $this->chamado_model->getFilialChamadoId($id);
		foreach($listaFilial as $filial){
			$filiais = $filiais.$filial->fil_nome.", ";
		}

		foreach($listaSintoma as $sintoma){
			$sintomas = $sintomas.$sintoma->sin_sintoma.", ";
		}
		
		if($editar){
			return 
			"Chamado Atualizado
			
			Responsavel: ".$this->session->usu_login."
			".
			"[Chamado]→".$chamado->emp_nome."
			[Localidade]→".$filiais."
			[Designação]→ ".$chamado->cha_designacao."
			[Atendente]→".$chamado->cha_atendente."
			[Protocolo]→".$chamado->cha_protocolo."
			[Data/Hora]→".$chamado->cha_data_inicio."
			[Sintoma]→".$sintomas."
			[Motivo]→".$chamado->cha_motivo."
			[Previsão]→".$chamado->cha_previsao."
			[Nivel]→Nivel ".$chamado->cha_nivel."
			[status]→".$this->chamado_model->getStatusId($chamado->cha_status)->stc_status."
			[usuario]→".$chamado->usu_login."";
		}else {
			return 
			"[Chamado]→".$chamado->emp_nome."
			[Localidade]→".$filiais."
			[Designação]→ ".$chamado->cha_designacao."
			[Atendente]→".$chamado->cha_atendente."
			[Protocolo]→".$chamado->cha_protocolo."
			[Data/Hora]→".$chamado->cha_data_inicio."
			[Sintoma]→".$sintomas."
			[Motivo]→".$chamado->cha_motivo."
			[Previsão]→".$chamado->cha_previsao."
			[Nivel]→Nivel ".$chamado->cha_nivel."
			[status]→".$this->chamado_model->getStatusId($chamado->cha_status)->stc_status."
			[usuario]→".$chamado->usu_login."";
			}
	}

	private function loadDadosViewDefault($view){
		
		if($view == 'aberto'){
			$dados['titulo'] = "Abertos/Andamento";
			$dados['empresas'] = $this->empresa_model->listarTodos();
			$dados['filiais'] = $this->filial_model->listarTodos();
			$dados['sintomas'] = $this->sintoma_model->listarTodos();
			$dados['niveis'] = $this->chamado_model->getNivelChamado();
			$dados['status'] = $this->chamado_model->getStatusChamado();
		}

		if($view == 'fechado'){
			$dados['titulo'] = "Fechados";
			$dados['empresas'] = $this->empresa_model->listarTodos();
			$dados['filiais'] = $this->filial_model->listarTodos();
			$dados['sintomas'] = $this->sintoma_model->listarTodos();
			$dados['niveis'] = $this->chamado_model->getNivelChamado();
			$dados['status'] = $this->chamado_model->getStatusChamado();
		}
		
		return $dados;
	}
	
}