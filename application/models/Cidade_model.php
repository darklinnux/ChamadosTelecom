<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cidade_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir($cidade)
    {
        $this->db->insert('cidade', $cidade);
        return $this->db->insert_id();
    }

    public function update($cidade)
    {

        try {
            $this->db->where('cid_id', $cidade['cid_id']);
            $this->db->update('cidade', $cidade);
            return true;
        } catch (Exeption $e) {
            return false;
        }

    }

    public function deletar($id){
        $this->db->where('cid_id',$id);
        $this->db->delete('cidade');
    }

    public function listarTodos(){
        $this->db->select('cid_id, cid_nome, est_sigla');
        $this->db->join('estado','cid_estado = est_id');
        return $this->db->get('cidade')->result();
    }

    public function getCidadeId($id){
        $this->db->where('cid_id', $id);
        return $this->db->get('cidade')->row();
    }
}