<?php

class TipoResiduo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('tipoResiduo_model');
        $this->load->model('login_model');
        $this->load->helper('url_helper');
        $this->load->library('table');
        $this->load->library('session');
    }

    public function view() {
        
    }

    public function cadastrar() {

        $this->login_model->verificar_login();

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Cadastrar tipo de res&iacute;duo';

        if ($this->form_validation->run('cad_tipo') === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('tipoResiduo/cad_view');
            $this->load->view('templates/footer');
        } else {
            $this->tipoResiduo_model->inserir();
            redirect(base_url('index.php/tiporesiduo/listar'));
        }
    }

    public function listar() {
        $this->login_model->verificar_login();
        $data['residuos'] = $this->tipoResiduo_model->get_residuo();
        $data['title'] = 'Lista de tipos';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('tipoResiduo/lista');
        $this->load->view('templates/footer');
    }

    public function deletar() {
        $this->login_model->verificar_login();
        $id = $this->uri->segment(3);
        $this->tipoResiduo_model->remover($id);
        redirect(base_url('index.php/tiporesiduo/listar'));
    }
    
    public function editar() {
        $this->login_model->verificar_login();
        $id = $this->uri->segment(3);

        $data['residuo'] = $this->tipoResiduo_model->get_residuo($id);

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Editar res&iacute;duo';

        if ($this->form_validation->run('cad_tipo') === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('tipoResiduo/editar');
            $this->load->view('templates/footer');
        } else {
            $data['title'] = 'Cadastro completo';
            $this->tipoResiduo_model->update();
            redirect(base_url('index.php/tiporesiduo/listar'));
        }
    }

}
