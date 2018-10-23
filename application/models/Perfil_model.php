<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perfil_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function listarTodos(){
        return $this->db->get('perfil')->result();
    }
}