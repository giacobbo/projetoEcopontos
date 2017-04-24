<?php

class Usuario_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->helper('url');
    }

    public function get_usuario($id = FALSE) {
        if ($id === FALSE) {
            $query = $this->db->get('usuario');
            return $query->result_array();
        }

        $query = $this->db->get_where('usuario', array('id' => $id));
        return $query->row_array();
    }

    public function inserir() {

        $data = array(
            'nome' => $this->input->post('nome'),
            'cpf' => $this->input->post('cpf'),
            'email' => $this->input->post('email'),
            'senha' => sha1($this->input->post('senha')),
            'tipo' => $this->input->post('administrador')
        );

        return $this->db->insert('usuario', $data);
    }

    public function update() {
        $data = array(
            'nome' => $this->input->post('nome'),
            'cpf' => $this->input->post('cpf'),
            'email' => $this->input->post('email'),
            'senha' => sha1($this->input->post('senha')),
            'tipo' => $this->input->post('administrador')
        );
        $this->db->where('id', $this->input->post('id'));
        $sql = $this->db->set($data)->get_compiled_update('usuario');

        return $this->db->query($sql);
    }

    public function alterar_senha() {
        $data = array(
            'senha' => sha1($this->input->post('senha'))
        );
        $this->db->where('id', $this->session->userdata('id'));
        $sql = $this->db->set($data)->update('usuario');

        return $this->db->query($sql);
    }

    public function remover($id) {

        $this->db->where('id', $id);
        return $this->db->delete('usuario');
    }

}
