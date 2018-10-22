<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function __construct()
	{
		parent::__construct();
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
                $usuarioLogado['usu_usuario'] = $usuario->usu_usuario;
                $usuarioLogado['usu_id'] = $usuario->usu_id;
                $usuarioLogado['usu_nome'] = $usuario->usu_nome;
                $usuarioLogado['usu_per_id'] = $usuario->usu_per_id;
                $usuarioLogado['usu_email'] = $usuario->usu_email;
                $usuarioLogado['usu_stat_id'] = $usuario->usu_stat_id;
                $this->session->set_userdata($usuarioLogado);
                redirect('usuarios');
            }
        }
        $this->load->view('login');
    }
}