<?php

class tipoResiduo_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_last_id() {
        $this->db->select_max('id');
        $query = $this->db->get('tiporesiduo')->row();
        return $query->id;
    }

    public function get_residuo($id = FALSE) {
        if ($id === FALSE) {
            $this->db->order_by('nome');
            $query = $this->db->get('tiporesiduo');
            return $query->result_array();
        }

        $this->db->order_by('nome');
        $query = $this->db->get_where('tiporesiduo', array('id' => $id));
        return $query->row_array();
    }

    public function inserir() {
        $this->load->helper('url');

        $data = array(
            'nome' => $this->input->post('nome'),
            'descricao' => $this->input->post('descricao')
        );

        return $this->db->insert('tiporesiduo', $data);
    }

    public function remover($id) {

        $this->db->where('id', $id);
        $delPonto = $this->db->delete('tiporesiduo');

        if ($delPonto) {
            $this->db->where('id', $id);
            return $this->db->delete('tiporesiduo');
        }
    }

    public function update() {
        $data = array(
            'nome' => $this->input->post('nome'),
            'descricao' => $this->input->post('descricao'),
        );
        $this->db->where('id', $this->input->post('id'));
        $sql = $this->db->set($data)->get_compiled_update('tiporesiduo');

        return $this->db->query($sql);
    }

}
