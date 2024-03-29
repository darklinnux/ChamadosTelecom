<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ControleAcesso
{
    private $CI;
    private $perfil;
    public function __construct()
    {
        $this->CI = &get_instance();
        $this->perfil = $this->CI->session->usu_perfil_id;
    }

    private function is_logado()
    {
        //var_dump($_SESSION);die();
        if ($this->CI->session->usu_id) {
            return true;
        }
        return false;
    }

    public function verificaSeEstaLogado()
    {
        if( $this->CI->uri->segment(2) == 'andamento' && !$this->is_logado()){
            $pagina = $this->CI->uri->segment(1);
            $metodo = $this->CI->uri->segment(2);
            $parametro = $this->CI->uri->segment(3);
            $this->CI->session->set_userdata('andamento',$pagina.'/'.$metodo.'/'.$parametro);
            $this->CI->session->set_flashdata('erro', 'Precisa está logado para acessa a pagina!!!');
            redirect('login');
        }

        if( $this->CI->uri->segment(2) == 'aberto' && !$this->is_logado()){
            $pagina = $this->CI->uri->segment(1);
            $metodo = $this->CI->uri->segment(2);
            $parametro = $this->CI->uri->segment(3);
            $this->CI->session->set_userdata('chamado',$pagina.'/'.$metodo.'#'.$parametro);
            $this->CI->session->set_flashdata('erro', 'Precisa está logado para acessa a pagina!!!');
            redirect('login');
        }
        if (!$this->is_logado()) {
            $this->CI->session->set_flashdata('erro', 'Precisa está logado para acessa a pagina!!!');
            redirect('login');
        }
    }

    public function verficaPermisaoCadastrar($funcionalidade,$view = false)
    {
        $this->CI->load->model('permissao_model');
        $permissao = $this->CI->permissao_model->getPermissaoIdPerfil($this->perfil,$funcionalidade)->perm_cadastrar;
        if(!$permissao){
            
            if($view){
                return false;
            }else {
                $this->CI->session->set_flashdata('error', 'Seu usuário não tem permissão para essa funcionalidade.');
                redirect('dashboard');
            }
        }else {
            return true;
        }

    }

    public function verficaPermisaoEditar($funcionalidade,$view = false)
    {
        $this->CI->load->model('permissao_model');
        $permissao = $this->CI->permissao_model->getPermissaoIdPerfil($this->perfil,$funcionalidade)->perm_editar;
        if(!$permissao){
            
            if($view){
                return false;
            }else {
                $this->CI->session->set_flashdata('error', 'Seu usuário não tem permissão para essa funcionalidade.');
                redirect('dashboard');
            }
        }else {
            return true;
        }

    }

    public function verficaPermisaoListar($funcionalidade,$view = false)
    {
        $this->CI->load->model('permissao_model');
        $permissao = $this->CI->permissao_model->getPermissaoIdPerfil($this->perfil,$funcionalidade)->perm_listar;
        //var_dump($permissao);die();
        if(!$permissao){
            if($view){
                return false;
            }else {
                $this->CI->session->set_flashdata('error', 'Seu usuário não tem permissão para essa funcionalidade.');
                redirect('dashboard');
            }
        }else {
            return true;
        }

    }

    public function verficaPermisaoRemover($funcionalidade,$view = false)
    {
        $this->CI->load->model('permissao_model');
        $permissao = $this->CI->permissao_model->getPermissaoIdPerfil($this->perfil,$funcionalidade)->perm_remover;
        if(!$permissao){
            
            if($view){
                return false;
            }else {
                $this->CI->session->set_flashdata('error', 'Seu usuário não tem permissão para essa funcionalidade.');
                redirect('dashboard');
            }
        }else {
            return true;
        }

    }

    public function verificarPermissaoVerTodos($funcionalidade){
        $this->CI->load->model('permissao_model');
        $permissao = $this->CI->permissao_model->getPermissaoIdPerfil($this->perfil,$funcionalidade)->perm_todos;
        //echo $permissao;die();
        if($permissao == 0){
            return false;
        }else{
            return true;
        }
    }
}
