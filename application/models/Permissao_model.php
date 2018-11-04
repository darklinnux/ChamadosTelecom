<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Permissao_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir($perfil,$funcionalidade)
    {
        $permissao['perm_cadastrar'] = false;
        $permissao['perm_listar'] = false;
        $permissao['perm_editar'] = false;
        $permissao['perm_remover'] = false;
        $permissao['perm_funcionalidade'] = $funcionalidade;
        $permissao['perm_perfil'] = $perfil;
        $this->db->insert('permissao', $permissao);
        return $this->db->insert_id();
    }

    public function update($permissao)
    {

        try {
            $this->db->where('perm_id', $permissao['perm_id']);
            $this->db->update('permissao', $permissao);
            return true;
        } catch (Exeption $e) {
            return false;
        }

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