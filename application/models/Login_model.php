<?php

class Login_model extends CI_Model {

    public function __construct() {
        $this->load->library('session');
    }

    public function verificar_login() {
        if (!$this->session->has_userdata('nome')) {
            redirect(base_url('index.php/login'));
        } elseif ($this->session->userdata('tipo') != '1') {
            redirect(base_url('index.php/pontocoleta/view'));
        }
    }

}
