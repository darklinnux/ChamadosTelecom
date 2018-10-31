<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categoria_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir($categoria)
    {
        $this->db->insert('categoria', $categoria);
        return $this->db->insert_id();
    }

    public function update($categoria)
    {

        try {
            $this->db->where('cat_id', $categoria['cat_id']);
            $this->db->update('categoria', $categoria);
            return true;
        } catch (Exeption $e) {
            return false;
        }

    }

    public function deletar($id){
        $this->db->where('cat_id',$id);
        return $this->db->delete('categoria');
    }

    public function listarTodos(){
        return $this->db->get('categoria')->result();
    }

    public function getCategoriaId($id){
        $this->db->where('cat_id', $id);
        return $this->db->get('categoria')->row();
    }
}