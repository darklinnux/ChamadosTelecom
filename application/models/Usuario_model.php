<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir($usuario)
    {
        $this->db->insert('usuario', $usuario);
        return $this->db->insert_id();
    }
    public function getUsuarioPorId($id)
    {
        $this->db->where('usu_id', $id);
        return $this->db->get('usuario')->row();
    }

    public function getSenhaPorId($id)
    {
        $this->db->select('usu_senha');
        $this->db->where('usu_id', $id);
        return $this->db->get('usuario')->row();

    }
    public function getUsuarioNvalidadoId($id)
    {
        $this->db->where('usu_id', $id);
        return $this->db->get('usuario')->row();
    }

    public function update($id, $usuario)
    {

        try {
            $this->db->where('usu_id', $id);
            $this->db->update('usuario', $usuario);
            return true;
        } catch (Exeption $e) {
            return false;
        }

    }

    public function logar($usuario, $senha)
    {
        $this->db->select('usu_id,usu_nome,usu_perfil,usu_login,usu_status');
        $this->db->where('usu_senha', $senha);
        $this->db->where('usu_login', $usuario);
        $this->db->where('usu_status = 1');
        return $this->db->get('usuario')->row();
    }

    public function contaUsuario($usuario)
    {
        $this->db->select("count(usu_usuario) as 'total' ");
        $this->db->where('usu_usuario', $usuario);
        return $this->db->get('usuario')->row();

    }

}
