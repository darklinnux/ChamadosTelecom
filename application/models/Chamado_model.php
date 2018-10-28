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
        $this->db->where('cha_id',$id);
        $this->db->delete('chamado');
    }

    public function listarTodos(){
        $this->db->select('chamado.*,fil_nome,fil_numero,emp_nome,usu_nome,usu_login, stc_status, cni_nivel');
        $this->db->join('empresa','cha_empresa = emp_id');
        $this->db->join('usuario','cha_usuario = usu_id');
        $this->db->join('chamado_status','cha_status = stc_id');
        $this->db->join('chamado_nivel','cha_nivel = cni_id');
        $this->db->join('chamado_filial','chf_chamado = cha_id');
        $this->db->join('filial','chf_filial = fil_id');
        return $this->db->get('chamado')->result();
    }

    public function getNivelChamado(){
        return $this->db->get('chamado_nivel')->result();
    }

    public function getStatusId(){
        return $this->db->get('chamado_status')->row();
    }

    public function getChamadoId($id){
        $this->db->where('cha_id', $id);
        return $this->db->get('chamado')->row();
    }

    public function contaChamado($chamado)
    {
        $this->db->select("count(fil_nome) as 'total' ");
        $this->db->where('fil_nome', $chamado);
        return $this->db->get('chamado')->row();

    }
}