<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chamado_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function inserir($chamado)
    {
        $this->db->insert('chamado', $chamado);
        return $this->db->insert_id();
    }

    public function inserirListaFilial($listaFiliais)
    {
        $this->db->insert('chamado_filial', $listaFiliais);
        return $this->db->insert_id();
    }

    public function inserirListaSintoma($listaSintoma)
    {
        $this->db->insert('chamado_sintoma', $listaSintoma);
        return $this->db->insert_id();
    }

    public function update($chamado)
    {

        try {
            $this->db->where('cha_id', $chamado['cha_id']);
            $this->db->update('chamado', $chamado);
            return true;
        } catch (Exeption $e) {
            return false;
        }

    }

    public function deletar($id){
        $this->db->query("CALL remover_chamado({$id})");
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
        $this->db->select('chamado.*,fil_nome,fil_numero,emp_nome,usu_nome,usu_login, stc_status, cni_nivel');
        $this->db->join('empresa','cha_empresa = emp_id');
        $this->db->join('usuario','cha_usuario = usu_id');
        $this->db->join('chamado_status','cha_status = stc_id');
        $this->db->join('chamado_nivel','cha_nivel = cni_id');
        $this->db->join('chamado_filial','chf_chamado = cha_id');
        $this->db->join('filial','chf_filial = fil_id');
        $this->db->where('cha_status != 3');
        return $this->db->get('chamado')->result();
    }

    public function listarAbertoUsuario(){
        $this->db->select('chamado.*,fil_nome,fil_numero,emp_nome,usu_nome,usu_login, stc_status, cni_nivel');
        $this->db->join('empresa','cha_empresa = emp_id');
        $this->db->join('usuario','cha_usuario = usu_id');
        $this->db->join('chamado_status','cha_status = stc_id');
        $this->db->join('chamado_nivel','cha_nivel = cni_id');
        $this->db->join('chamado_filial','chf_chamado = cha_id');
        $this->db->join('filial','chf_filial = fil_id');
        $this->db->where('cha_status != 3');
        $this->db->where('cha_usuario',$this->session->usu_id);
        return $this->db->get('chamado')->result();
    }

    public function listarFechadoUsuario(){
        $this->db->select('chamado.*,fil_nome,fil_numero,emp_nome,usu_nome,usu_login, stc_status, cni_nivel');
        $this->db->join('empresa','cha_empresa = emp_id');
        $this->db->join('usuario','cha_usuario = usu_id');
        $this->db->join('chamado_status','cha_status = stc_id');
        $this->db->join('chamado_nivel','cha_nivel = cni_id');
        $this->db->join('chamado_filial','chf_chamado = cha_id');
        $this->db->join('filial','chf_filial = fil_id');
        $this->db->where('cha_status = 3');
        $this->db->where('cha_usuario',$this->session->usu_id);
        return $this->db->get('chamado')->result();
    }

    public function listarTodosFechado(){
        $this->db->select('chamado.*,fil_nome,fil_numero,emp_nome,usu_nome,usu_login, stc_status, cni_nivel');
        $this->db->join('empresa','cha_empresa = emp_id');
        $this->db->join('usuario','cha_usuario = usu_id');
        $this->db->join('chamado_status','cha_status = stc_id');
        $this->db->join('chamado_nivel','cha_nivel = cni_id');
        $this->db->join('chamado_filial','chf_chamado = cha_id');
        $this->db->join('filial','chf_filial = fil_id');
        $this->db->where('cha_status = 3');
        return $this->db->get('chamado')->result();
    }

    public function listarChamadoId($id){
        $this->db->select('chamado.*,emp_nome,usu_nome,usu_login, stc_status, cni_nivel');
        $this->db->join('empresa','cha_empresa = emp_id');
        $this->db->join('usuario','cha_usuario = usu_id');
        $this->db->join('chamado_status','cha_status = stc_id');
        $this->db->join('chamado_nivel','cha_nivel = cni_id');
        $this->db->where('cha_id',$id);
        return $this->db->get('chamado')->row();
    }

    public function getNivelChamado(){
        return $this->db->get('chamado_nivel')->result();
    }

    public function getStatusId($id){
        $this->db->where('stc_id',$id);
        return $this->db->get('chamado_status')->row();
    }

    public function getStatusChamado(){
        return $this->db->get('chamado_status')->result();
    }

    public function getChamadoId($id){
        $this->db->where('cha_id', $id);
        return $this->db->get('chamado')->row();
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