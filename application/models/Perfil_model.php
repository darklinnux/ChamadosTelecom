<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Perfil_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir($perfil)
    {
        $this->db->insert('perfil', $perfil);
        return $this->db->insert_id();
    }

    public function update($perfil)
    {

        try {
            $this->db->where('per_id', $perfil['per_id']);
            $this->db->update('perfil', $perfil);
            return true;
        } catch (Exeption $e) {
            return false;
        }

    }

    public function deletar($id){
        $this->db->where('per_id',$id);
        return $this->db->delete('perfil');
    }

    public function listarTodos(){
        return $this->db->get('perfil')->result();
    }

    public function getPerfilId($id){
        $this->db->where('per_id', $id);
        return $this->db->get('perfil')->row();
    }
}