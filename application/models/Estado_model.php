<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Estado_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir($estado)
    {
        $this->db->insert('estado', $estado);
        return $this->db->insert_id();
    }

    public function listarTodos(){
        return $this->db->get('estado')->result();
    }
}