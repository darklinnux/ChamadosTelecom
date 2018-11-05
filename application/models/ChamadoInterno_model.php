<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ChamadoInterno_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir($chamado)
    {
        $this->db->insert('chamado_interno', $chamado);
        return $this->db->insert_id();
    }
    
    public function inserirComentario($comentario)
    {
        return $this->db->insert('comentario_interno', $comentario);
    }

    public function update($chamado)
    {
        $this->db->where('cha_id', $chamado['cha_id']);
        return $this->db->update('chamado_interno', $chamado); 
    }

    public function deletar($id){
        $this->db->where('cha_id',$id);
        return $this->db->delete('chamado_interno');
    }

    public function deletarFiliaisChamado($id){
        $this->db->where('chf_chamado',$id);
        $this->db->delete('chamado_filial');
    }

    public function deletarSintomasChamado($id){
        $this->db->where('chs_chamado',$id);
        $this->db->delete('chamado_sintoma');
    }

    public function listarTodosAberto(){
        $this->db->select('chamado_interno.*, fil_numero, fil_nome, set_nome, niv_nivel, stc_status, usu_login');
        $this->db->join('filial','cha_filial = fil_id');
        $this->db->join('setor','cha_setor = set_id');
        $this->db->join('nivel_interno','cha_nivel = niv_id');
        $this->db->join('usuario','cha_usuario = usu_id');
        $this->db->join('status_interno','cha_status = stc_id');
        $this->db->where('cha_status != 3');
        return $this->db->get('chamado_interno')->result();
    }

    public function listarAbertoUsuario(){
        $this->db->select('chamado_interno.*, fil_numero, fil_nome, set_nome, niv_nivel, stc_status, usu_login');
        $this->db->join('filial','cha_filial = fil_id');
        $this->db->join('setor','cha_setor = set_id');
        $this->db->join('nivel_interno','cha_nivel = niv_id');
        $this->db->join('usuario','cha_usuario = usu_id');
        $this->db->join('status_interno','cha_status = stc_id');
        $this->db->where('cha_status != 3');
        $this->db->where('cha_usuario',$this->session->usu_id);
        $this->db->or_where('cha_responsavel',$this->session->usu_id);
        return $this->db->get('chamado_interno')->result();
    }

    public function listarFechadoUsuario(){
        $this->db->select('chamado_interno.*, fil_numero, fil_nome, set_nome, niv_nivel, stc_status, usu_login');
        $this->db->join('filial','cha_filial = fil_id');
        $this->db->join('setor','cha_setor = set_id');
        $this->db->join('nivel_interno','cha_nivel = niv_id');
        $this->db->join('usuario','cha_usuario = usu_id');
        $this->db->join('status_interno','cha_status = stc_id');
        $this->db->where('cha_status = 3');
        $this->db->where('cha_usuario',$this->session->usu_id);
        $this->db->or_where('cha_responsavel',$this->session->usu_id);
        return $this->db->get('chamado_interno')->result();
    }

    public function listarTodosFechado(){
        $this->db->select('chamado_interno.*, fil_numero, fil_nome, set_nome, niv_nivel, stc_status, usu_login');
        $this->db->join('filial','cha_filial = fil_id');
        $this->db->join('setor','cha_setor = set_id');
        $this->db->join('nivel_interno','cha_nivel = niv_id');
        $this->db->join('usuario','cha_usuario = usu_id');
        $this->db->join('status_interno','cha_status = stc_id');
        $this->db->where('cha_status = 3');
        return $this->db->get('chamado_interno')->result();
    }

    public function listarChamadoId($id){
        $this->db->select('chamado_interno.*, fil_numero, fil_nome, set_nome, niv_nivel, stc_status, a.usu_login, cat_nome, r.usu_login as responsavel');
        $this->db->join('filial','cha_filial = fil_id');
        $this->db->join('setor','cha_setor = set_id');
        $this->db->join('nivel_interno','cha_nivel = niv_id');
        $this->db->join('usuario as a','cha_usuario = a.usu_id');
        $this->db->join('usuario as r','cha_responsavel = r.usu_id','left');
        $this->db->join('status_interno','cha_status = stc_id');
        $this->db->join('categoria','cha_categoria = cat_id');
        $this->db->where('cha_id',$id);
        return $this->db->get('chamado_interno')->row();
    }

    public function listarComentarios($id){
        $this->db->select('com_id, com_comentario, com_data, usu_nome');
        $this->db->join('usuario','com_usuario = usu_id');
        $this->db->order_by("com_data", "asc");
        $this->db->where('com_chamado',$id);
        return $this->db->get('comentario_interno')->result();
    }

    public function getNivelChamado(){
        return $this->db->get('chamado_nivel')->result();
    }

    public function getStatusId($id){
        $this->db->where('stc_id',$id);
        return $this->db->get('status_interno')->row();
    }

    public function getStatusChamado(){
        return $this->db->get('chamado_status')->result();
    }

    public function getChamadoId($id){
        $this->db->where('cha_id', $id);
        return $this->db->get('chamado_interno')->row();
    }

    public function getFilialChamadoId($id){
        $this->db->select('chf_filial, fil_nome');
        $this->db->join('filial','chf_filial = fil_id');
        $this->db->where('chf_chamado', $id);
        return $this->db->get('chamado_filial')->result();
    }

    public function getSintomaChamadoId($id){
        $this->db->select('chs_sintoma,sin_sintoma');
        $this->db->join('sintoma','chs_sintoma = sin_id');
        $this->db->where('chs_chamado', $id);
        return $this->db->get('chamado_sintoma')->result();
    }

    public function contaChamadoUsuario($id,$usuario)
    {
        $this->db->select("count(cha_id) as 'total' ");
        $this->db->where('cha_id', $id);
        $this->db->where('cha_usuario', $usuario);
        $this->db->or_where('cha_responsavel',$usuario);
        return $this->db->get('chamado_interno')->row();

    }
}