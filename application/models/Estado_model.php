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

    public function update($estado)
    {

        try {
            $this->db->where('est_id', $estado['est_id']);
            $this->db->update('estado', $estado);
            return true;
        } catch (Exeption $e) {
            return false;
        }

    }

    public function deletar($id){
        $this->db->where('est_id',$id);
        $this->db->delete('estado');
    }

    public function listarTodos(){
        return $this->db->get('estado')->result();
    }

    public function getEstadoId($id){
        $this->db->where('est_id', $id);
        return $this->db->get('estado')->row();
    }
}