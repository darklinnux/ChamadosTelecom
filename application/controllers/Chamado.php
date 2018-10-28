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
		$dados['empresas'] = $this->empresa_model->listarTodos();
		$dados['filiais'] = $this->filial_model->listarTodos();
		$dados['sintomas'] = $this->sintoma_model->listarTodos();
		$dados['niveis'] = $this->chamado_model->getNivelChamado();
		$dados['chamados'] = $this->chamado_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('chamado',$dados);
		
	}
	
	public function cadastrar(){
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
			sendMessageGrupo($this->getTextMensagem());
			$this->session->set_flashdata('sucess', 'chamado cadastrado com sucesso!!!');
			redirect('chamado');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('chamado');
		}
	}

	public function editar(){
		//var_dump($_POST);die();
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$chamado = $this->popularChamado();
			$this->chamado_model->update($chamado);
			$this->session->set_flashdata('sucess', 'chamado atualizado com sucesso!!!');
			redirect('chamado');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('chamado');
		}
	}


	public function carregarDadosEditar($id){
		$chamado = $this->chamado_model->getchamadoId($id);
		echo json_encode($chamado);
			
	}

	public function remover($id){
		$this->chamado_model->deletar($id);
		$this->session->set_flashdata('sucess', 'chamado foi removido com sucesso!!!');
		redirect('chamado');
	  }

	private function validaFormCadastro(){
		
		$this->form_validation->set_rules('protocolo', 'Previsão','trim|required');
		$this->form_validation->set_rules('previsao', 'Previsão','trim');
		$this->form_validation->set_rules('designacao', 'Designação','trim|required');
		$this->form_validation->set_rules('atendente', 'Atendente','trim|required');
		$this->form_validation->set_rules('empresa', 'Empresa','trim|required');
		$this->form_validation->set_rules('filial[]', 'Filiais','trim|required');
		$this->form_validation->set_rules('sintoma[]', 'Sintomas','trim|required');
		$this->form_validation->set_rules('motivo', 'Motivo','trim|required');
		$this->form_validation->set_rules('nivel', 'Nivel','trim|required');

		//$this->form_validation->set_rules('sigla', 'Sigla', 'trim|required|is_unique[chamado.est_sigla]');
        return $this->form_validation->run();
	}

	private function popularChamado(){
		$chamado['cha_protocolo'] = $this->input->post('protocolo');
		$chamado['cha_previsao'] = empty($this->input->post('previsao')) ? '' : date('Y-m-d',strtotime($this->input->post('previsao')));
		$chamado['cha_atendente'] = $this->input->post('atendente');
		$chamado['cha_designacao'] = $this->input->post('designacao');
		$chamado['cha_empresa'] = $this->input->post('empresa');
		$chamado['cha_motivo'] = $this->input->post('motivo');
		$chamado['cha_usuario'] = $this->session->usu_id;
		$chamado['cha_status'] = 1;
		$chamado['cha_nivel'] = $this->input->post('nivel');
		$chamado['cha_data_inicio'] = date("Y-m-d H:i:s");
		if($this->input->post('id')){
			$chamado['cha_id'] = $this->input->post('id');
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

	private function getTextMensagem(){
		$empresa = $this->empresa_model->getEmpresaId($this->input->post('empresa'))->emp_nome;
		$usuario = $this->session->usu_login;
		$protocolo = $this->input->post('protocolo');
		$inicio = date("d-m-y H:i");
		$previsao = date('d-m-y',strtotime($this->input->post('previsao')));
		$nivel = "Nivel ".$this->input->post('nivel');
		$atendente = $this->input->post('atendente');
		$designacao = $this->input->post('designacao');
		$motivo = $this->input->post('motivo');
		$listaFiliais = $this->input->post('filial[]');
		$listaSintoma = $this->input->post('sintoma[]');
		$status = $this->chamado_model->getStatusId(1)->stc_status;
		$filiais = null;
		$sintomas = null;
		for($i = 0; $i < count($listaFiliais); $i++){
			$filiais = $filiais . $this->filial_model->getFilialId($listaFiliais[$i])->fil_nome .', ';
		}

		for($i = 0; $i < count($listaSintoma); $i++){
			$sintomas = $sintomas . $this->sintoma_model->getSintomaId($listaSintoma[$i])->sin_sintoma .', ';
		}

		return 
		"[Chamado]→".$empresa."
		[Localidade]→".$filiais."
		[Designação]→ ".$designacao."
		[Atendente]→".$atendente."
		[Protocolo]→".$protocolo."
		[Data/Hora]→".$inicio."
		[Sintoma]→".$sintomas."
		[Motivo]→".$motivo."
		[Previsão]→".$previsao."
		[Nivel]→".$nivel."
		[status]→".$status."
		[usuario]→".$usuario."";
	}

	public function enviar(){
		sendMessageGrupo($this->getTextMensagem());
	}
}