<?php

class Usuario extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('usuario_model');
        $this->load->model('login_model');
        $this->load->helper('url_helper');
        $this->load->library('table');
        $this->load->library('session');
    }

    public function listar() {
        $this->login_model->verificar_login();
        $data['usuarios'] = $this->usuario_model->get_usuario();
        $data['title'] = 'Lista de usuarios';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('usuario/lista');
        $this->load->view('templates/footer');
    }

    public function cadastrar() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Cadastrar usu&aacute;rio';

        if ($this->form_validation->run('cad_usuario') === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('usuario/cad_view');
            $this->load->view('templates/footer');
        } else {
            $data['title'] = 'Cadastro completo';
            $this->usuario_model->inserir();
            redirect('./usuario/listar');
        }
    }

    public function editar() {
        $this->login_model->verificar_login();
        $id = $this->uri->segment(3);

        $data['usuario'] = $this->usuario_model->get_usuario($id);

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Editar usu&aacute;rio';

        if ($this->form_validation->run('edit_usuario') === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('usuario/editar');
            $this->load->view('templates/footer');
        } else {
            $data['title'] = 'Cadastro completo';
            $this->usuario_model->update();
            redirect('./usuario/listar');
        }
    }
    public function alterarSenha() {

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Alterar senha';

        if ($this->form_validation->run('alterar_senha') === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('usuario/editarSenha');
            $this->load->view('templates/footer');
        } else {
            $data['title'] = 'Cadastro completo';
            $this->usuario_model->alterar_senha();
            redirect('./pontoColeta/view');
        }
    }

    public function deletar() {
        $this->login_model->verificar_login();
        $id = $this->uri->segment(3);
        $this->usuario_model->remover($id);
        redirect('./usuario/listar');
    }

}
