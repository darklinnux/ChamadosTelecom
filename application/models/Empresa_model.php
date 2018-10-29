<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Empresa_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir($empresa)
    {
        $this->db->insert('empresa', $empresa);
        return $this->db->insert_id();
    }

    public function update($empresa)
    {

        try {
            $this->db->where('emp_id', $empresa['emp_id']);
            $this->db->update('empresa', $empresa);
            return true;
        } catch (Exeption $e) {
            return false;
        }

    }

    public function deletar($id){
        $this->db->where('emp_id',$id);
        return $this->db->delete('empresa');
    }

    public function listarTodos(){
        return $this->db->get('empresa')->result();
    }

    public function getEmpresaId($id){
        $this->db->where('emp_id', $id);
        return $this->db->get('empresa')->row();
    }
}