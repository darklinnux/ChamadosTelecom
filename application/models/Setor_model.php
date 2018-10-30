<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setor_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir($setor)
    {
        $this->db->insert('setor', $setor);
        return $this->db->insert_id();
    }

    public function update($setor)
    {

        try {
            $this->db->where('set_id', $setor['set_id']);
            $this->db->update('setor', $setor);
            return true;
        } catch (Exeption $e) {
            return false;
        }

    }

    public function deletar($id){
        $this->db->where('set_id',$id);
        return $this->db->delete('setor');
    }

    public function listarTodos(){
        return $this->db->get('setor')->result();
    }

    public function getSetorId($id){
        $this->db->where('set_id', $id);
        return $this->db->get('setor')->row();
    }
}