<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChamadoInterno extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->controleacesso->verificaSeEstaLogado();
		$this->load->model('ChamadoInterno_model');
		$this->load->model('categoria_model');
		$this->load->model('filial_model');
		$this->load->model('setor_model');
		$this->load->helper('telegram');
	}
	
	public function index()
	{
		redirect('ChamadoInterno/aberto');
		
    }
    
    public function aberto(){
        $dados['titulo'] = "Abertos/Andamento";
        $dados['categorias'] = $this->categoria_model->listarTodos();
		$dados['filiais'] = $this->filial_model->listarTodos();
		$dados['setores'] = $this->setor_model->listarTodos();
		$dados['niveis'] = $this->ChamadoInterno_model->getNivelChamado();
		$dados['status'] = $this->ChamadoInterno_model->getStatusChamado();
		$dados['chamados'] = $this->ChamadoInterno_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('chamadoInterno',$dados);
    }

    public function fechado(){
        $dados['titulo'] = "Fechados";
        $dados['empresas'] = $this->empresa_model->listarTodos();
		$dados['filiais'] = $this->filial_model->listarTodos();
		$dados['sintomas'] = $this->sintoma_model->listarTodos();
		$dados['niveis'] = $this->ChamadoInterno_model->getNivelChamado();
		$dados['status'] = $this->ChamadoInterno_model->getStatusChamado();
		$dados['chamados'] = $this->ChamadoInterno_model->listarTodos();
		$this->load->view('template/header');
		$this->load->view('chamadoInterno',$dados);
    }
	
	public function cadastrar(){
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {
			$chamado = $this->popularChamado();
			$this->ChamadoInterno_model->inserir($chamado);
			//Pega o utimo id e inseri na tabela de lista filiais do chamado
			$id = $this->db->insert_id();
			$this->inserirFilialChamado($id,function($filiais){
				$this->ChamadoInterno_model->inserirListaFilial($filiais);
			});
			$this->inserirSintomaChamado($id,function($sintomas){
				$this->ChamadoInterno_model->inserirListaSintoma($sintomas);
			});
			//die('sem erro');
			//sendMessageGrupo($this->getTextMensagem($id));
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
			$chamado = $this->popularChamado(true);
			$this->ChamadoInterno_model->update($chamado);
			$id = $chamado['cha_id'];
			$this->ChamadoInterno_model->deletarFiliaisChamado($id);
			$this->ChamadoInterno_model->deletarSintomasChamado($id);

			$this->inserirFilialChamado($id,function($filiais){
				$this->ChamadoInterno_model->inserirListaFilial($filiais);
			});
			$this->inserirSintomaChamado($id,function($sintomas){
				$this->ChamadoInterno_model->inserirListaSintoma($sintomas);
			});
			//die('sem erro');
			//sendMessageGrupo($this->getTextMensagem($id,true));
			$this->session->set_flashdata('sucess', 'chamado atualizado com sucesso!!!');
			redirect('chamado');
		}else {
			$this->session->set_flashdata('error', validation_errors());
			redirect('chamado');
		}
	}


	public function carregarDadosEditar($id){
		$chamado = $this->ChamadoInterno_model->getchamadoId($id);
		echo json_encode($chamado);
			
	}

	public function carregarDadosFilialEditar($id){
		$chamado = $this->ChamadoInterno_model->getFilialChamadoId($id);
		echo json_encode($chamado);
	}

	public function carregarDadosSintomaEditar($id){
		$chamado = $this->ChamadoInterno_model->getSintomaChamadoId($id);
		echo json_encode($chamado);
	}

	public function remover($id){
		$this->ChamadoInterno_model->deletar($id);
		$this->session->set_flashdata('sucess', 'chamado foi removido com sucesso!!!');
		redirect('chamado');
	  }

	private function validaFormCadastro(){
		
		$this->form_validation->set_rules('categoria', 'Categoria','trim|required');
		$this->form_validation->set_rules('setor', 'Setor','trim|required');
		$this->form_validation->set_rules('designacao', 'Designação','trim|required');
		$this->form_validation->set_rules('atendente', 'Atendente','trim|required');
		$this->form_validation->set_rules('empresa', 'Empresa','trim|required');
		$this->form_validation->set_rules('filial', 'Filial','trim|required');
		$this->form_validation->set_rules('assunto', 'Assunto','trim|required');
		$this->form_validation->set_rules('descricao', 'Descrição','trim|required');
		$this->form_validation->set_rules('nivel', 'Nivel','trim|required');

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
		$chamado = $this->ChamadoInterno_model->listarChamadoId($id);
		$filiais = null;
		$sintomas = null;
		$listaSintoma = $this->ChamadoInterno_model->getSintomaChamadoId($id);
		$listaFilial = $this->ChamadoInterno_model->getFilialChamadoId($id);
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
			[status]→".$this->ChamadoInterno_model->getStatusId($chamado->cha_status)->stc_status."
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
			[status]→".$this->ChamadoInterno_model->getStatusId($chamado->cha_status)->stc_status."
			[usuario]→".$chamado->usu_login."";
			}
	}
	
}