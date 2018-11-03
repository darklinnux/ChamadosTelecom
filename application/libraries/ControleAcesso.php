<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ControleAcesso
{
    private $CI;
    public function __construct()
    {
        $this->CI = &get_instance();
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
        if (!$this->is_logado()) {
            $this->CI->session->set_flashdata('erro', 'Precisa está logado para acessa a pagina!!!');
            redirect('login');
        }
    }

    public function verficaPerfil()
    {

    }
}
