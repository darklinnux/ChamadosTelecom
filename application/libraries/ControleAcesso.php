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
        if (!$this->is_logado()) {
            $this->CI->session->set_flashdata('erro', 'Precisa está logado para acessa a pagina!!!');
            redirect('login');
        }
    }

    public function verficaPerfil()
    {

    }
}
