<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		$this->load->model('usuario_model');
		$this->load->model('perfil_model');
	}

	public function index(){
		$dados['perfis'] = $this->perfil_model->listarTodos();
		$dados['status'] = $this->usuario_model->getStatus();
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
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->validaFormCadastro()) {

		}
	}

	public function gerarModalEditar($id){
		$perfis = $this->perfil_model->listarTodos();
		$status = $this->usuario_model->getStatus();
		$usuario = $this->usuario_model->getUsuarioId($id);
		
		?> <div class="modal fade" id="modal-editar">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-blue">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Editar Usuario</h4>
          </div>
          <div id="erro" class="alert alert-danger alert-dismissible hidden">
            <h4><i class="icon fa fa-ban"></i> Erro!</h4>
            <span id="erroText"></span>
          </div> 
          <div class="modal-body">
            <div id="erro"></div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Nome:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-user"></i>
                    </div>
                    <input value="<?=$usuario->usu_nome?>" id="nome" type="text" class="form-control">
                  </div>
                  <!-- /.input group -->
                </div>  
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Usuario:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <span>@</span>
                    </div>
                    <input value="<?=$usuario->usu_login?>" id="usuario" type="text" class="form-control">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Senha:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-key"></i>
                    </div>
                    <input id="senha" type="text" class="form-control">
                  </div>
                  <!-- /.input group -->
                </div>  
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label>Confirmar Senha:</label>

                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-key"></i>
                    </div>
                    <input id="conf_senha" type="text" class="form-control">
                  </div>
                  <!-- /.input group -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="">Status</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-get-pocket"></i>
                    </div>
                    <select id="status" class="form-control">
                      <?php foreach($status as $statu) { ?>
                      <option <?=($usuario->usu_status == $statu->stu_id) ? "selected" : null?> value="<?=$statu->stu_id?>"><?=$statu->stu_status?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5">
                <div class="form-group">
                  <label for="">Perfil</label>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-get-pocket"></i>
                    </div>
                    <select id="perfil" class="form-control">
                      <?php foreach($perfis as $perfil){?>
                        <option <?=($usuario->usu_perfil == $perfil->per_id) ? "selected" : null?> value="<?=$perfil->per_id?>"><?=$perfil->per_perfil?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer text-center">
            <button id="btnCadastrar" onclick="enviarDados();" type="button" class="btn btn-primary ">Salvar</button>
            <button type="button" class="btn btn-default " data-dismiss="modal">Fechar</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div> <?php
		
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

	private function validaFormEditar($login){
		
		$this->form_validation->set_rules('login', 'login', 'trim|required|is_unique[usuario.usu_login]');
        $this->form_validation->set_rules('senha', 'senha', 'required|min_length[6]');
		$this->form_validation->set_rules('conf_senha', 'senhas devem ser iguais', 'required|matches[senha]');
		$this->form_validation->set_rules('perfil', 'Perfil','trim|required');
		$this->form_validation->set_rules('status', 'Status','trim|required');
		$this->form_validation->set_rules('nome', 'Nome','trim|required');
		$this->form_validation->set_rules(
            'usuario', 'usuario',
            array(
                'required',
                array(
                    'username_callable',
                    function ($str) {
						$dadosAnteriores = $this->usuario_model->getUsuarioId($id);
                        if ($str === $dadosAnteriores->usu_login) {
                            return true;
                        }

                        $usuario = $this->usuario_model->contaUsuario($str);

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
		$usuario['usu_senha'] = $this->input->post('senha');
		$usuario['usu_status'] = $this->input->post('status');
		$usuario['usu_perfil'] = $this->input->post('perfil');
		return $usuario;
	}
}