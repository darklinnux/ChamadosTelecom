<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function __construct()
	{
        parent::__construct();
        $this->load->helper('getip');
        $this->load->model('usuario_model');
	}
	

	public function index()
	{
		$this->logar();
		
	}

	public function logar()
    {
        $this->session->unset_userdata('usu_id');
        $this->session->unset_userdata('usu_login');
        $this->session->unset_userdata('usu_nome');
        $this->session->unset_userdata('usu_perfil');
        $this->session->unset_userdata('usu_perfil_id');
        $this->session->unset_userdata('usu_status');

        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $this->form_validation->set_rules('usuario', 'usuario', 'required');
            $this->form_validation->set_rules('senha', 'senha', 'required');
            if ($this->form_validation->run()) {
                $usuario = $this->input->post('usuario');
                $senha = md5($this->input->post('senha'));
                $usuario = $this->usuario_model->logar($usuario, $senha);
                if (is_null($usuario)) {
                    $this->session->set_flashdata('erro', 'Usuario ou senha inválida');
                    redirect('login');
                }
                $registrologin = array(
                    'hist_entrada' => date("Y-m-d H:i:s"),
                    'hist_ip' => getUserIP(),
                    'hist_usuario' => $usuario->usu_id
                );
                $usuarioLogado['registro_id'] = $this->usuario_model->registrarLogin($registrologin);
                $usuarioLogado['usu_id'] = $usuario->usu_id;
                $usuarioLogado['usu_login'] = $usuario->usu_login;
                $usuarioLogado['usu_nome'] = $usuario->usu_nome;
                $usuarioLogado['usu_perfil_id'] = $usuario->usu_perfil;
                $usuarioLogado['usu_perfil'] = $usuario->per_perfil;
                $usuarioLogado['usu_status'] = $usuario->usu_status;
                $this->session->set_userdata($usuarioLogado);
                if($this->session->andamento){
                    redirect($this->session->andamento);
                }
                if($this->session->chamado){
                    redirect($this->session->chamado);
                }
                redirect('dashboard');
            }
        }
        $this->load->view('login');
    }

    public function deslogar(){
        $this->usuario_model->registrarSaida(array(
            'hist_saida' => date("Y-m-d H:i:s")
        ));
        $this->session->unset_userdata('registro_id');
        $this->session->unset_userdata('usu_id');
        $this->session->unset_userdata('usu_login');
        $this->session->unset_userdata('usu_nome');
        $this->session->unset_userdata('usu_perfil');
        $this->session->unset_userdata('usu_perfil_id');
        $this->session->unset_userdata('usu_status');
        $this->session->set_flashdata('logout', 'Usuario deslogado com sucesso');
        redirect('login');
    }
}