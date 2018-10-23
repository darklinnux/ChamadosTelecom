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

    public function listar(){
        $this->db->select('usu_id,usu_nome,usu_login, stu_status, per_perfil');
        $this->db->join('perfil','usu_perfil = per_id');
        $this->db->join('usuario_status', 'usu_status = stu_id');
        return $this->db->get('usuario')->result();
    }

    public function getUsuarioId($id){
        $this->db->where('usu_id', $id);
        return $this->db->get('usuario')->row();
    }

    public function getStatus(){
        return $this->db->get('usuario_status')->result();
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
        $this->db->select("count(usu_login) as 'total' ");
        $this->db->where('usu_login', $usuario);
        return $this->db->get('usuario')->row();

    }

}
