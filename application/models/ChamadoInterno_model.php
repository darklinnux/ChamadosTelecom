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

    public function update($chamado)
    {

        try {
            $this->db->where('cha_id', $chamado['cha_id']);
            $this->db->update('chamado_interno', $chamado);
            return true;
        } catch (Exeption $e) {
            return false;
        }

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

    public function contaChamado($chamado)
    {
        $this->db->select("count(fil_nome) as 'total' ");
        $this->db->where('fil_nome', $chamado);
        return $this->db->get('chamado')->row();

    }

    public function contaChamadoStatus($status)
    {
        $this->db->select("count(cha_id) as 'total' ");
        $this->db->where('cha_status', $status);
        return $this->db->get('chamado')->row();

    }
}