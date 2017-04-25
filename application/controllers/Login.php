<?php

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url_helper');
        $this->load->helpers('form');
        $this->load->library('form_validation');
        $this->load->database();
        $this->load->library('session');
    }

    function index() {
        $data['title'] = 'Fazer login';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('login');
        $this->load->view('templates/footer');
    }

    function login() {

        $data['title'] = 'Fazer login';

        if ($this->form_validation->run('login') === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('login');
            $this->load->view('templates/footer');
        } else {

            $email = trim($this->input->post('email'));
            $senha = sha1(trim($this->input->post('senha')));

            $this->db->where('email', $email);
            $this->db->where('senha', $senha);
            $query = $this->db->get('usuario');

            if ($query->num_rows() > 0) {
                $usuarios_data = $query->row();

                $data['idUsuario'] = $usuarios_data->id;
                $data['nome'] = $usuarios_data->nome;
                $data['email'] = $usuarios_data->email;
                $data['tipo'] = $usuarios_data->tipo;

                $this->session->set_userdata($data);

                redirect('./pontoColeta/view');
            } else {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/menu');
                $this->load->view('login');
                $this->load->view('templates/footer');
            }
        }
    }

    function logout() {

        $this->session->sess_destroy();
        redirect(base_url());
    }

}
