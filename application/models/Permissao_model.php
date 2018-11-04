<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permissao_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir($permissoes)
    {
        $this->db->insert('permissao', $permissoes);
        return $this->db->insert_id();
    }

    public function update($permissao,$funcionalidade)
    {
        $this->db->where('perm_perfil', $permissao['perm_perfil']);
        $this->db->where('perm_funcionalidade', $funcionalidade);
        $this->db->update('permissao', $permissao);
    }

    public function listarTodos(){
        return $this->db->get('permissao')->result();
    }

    public function getPermissaoId($id){
        $this->db->where('perm_id', $id);
        return $this->db->get('permissao')->row();
    }

    public function getPermissaoIdPerfil($perfil,$funcionalidade){
        $this->db->where('perm_perfil', $perfil);
        $this->db->where('perm_funcionalidade',$funcionalidade);
        return $this->db->get('permissao')->row();
    }

    public function getFuncionalidades(){
        return $this->db->get('funcionalidade')->result();
    }

}