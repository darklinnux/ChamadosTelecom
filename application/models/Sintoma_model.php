<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sintoma_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir($sintoma)
    {
        $this->db->insert('sintoma', $sintoma);
        return $this->db->insert_id();
    }

    public function update($sintoma)
    {

        try {
            $this->db->where('sin_id', $sintoma['sin_id']);
            $this->db->update('sintoma', $sintoma);
            return true;
        } catch (Exeption $e) {
            return false;
        }

    }

    public function deletar($id){
        $this->db->where('sin_id',$id);
        $this->db->delete('sintoma');
    }

    public function listarTodos(){
        return $this->db->get('sintoma')->result();
    }

    public function getSintomaId($id){
        $this->db->where('sin_id', $id);
        return $this->db->get('sintoma')->row();
    }
}