<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Filial_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir($filial)
    {
        $this->db->insert('filial', $filial);
        return $this->db->insert_id();
    }

    public function update($filial)
    {

        try {
            $this->db->where('fil_id', $filial['fil_id']);
            $this->db->update('filial', $filial);
            return true;
        } catch (Exeption $e) {
            return false;
        }

    }

    public function deletar($id){
        $this->db->where('fil_id',$id);
        return $this->db->delete('filial');
    }

    public function listarTodos(){
        $this->db->select('fil_id, fil_nome, fil_numero, cid_nome, est_sigla');
        $this->db->join('cidade','fil_cidade = cid_id');
        $this->db->join('estado','cid_estado = est_id');
        return $this->db->get('filial')->result();
    }

    public function getFilialId($id){
        $this->db->where('fil_id', $id);
        return $this->db->get('filial')->row();
    }

    public function contaFilial($filial)
    {
        $this->db->select("count(fil_nome) as 'total' ");
        $this->db->where('fil_nome', $filial);
        return $this->db->get('filial')->row();

    }
}