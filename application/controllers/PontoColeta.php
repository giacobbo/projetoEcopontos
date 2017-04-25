<?php

class PontoColeta extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('pontoColeta_model');
        $this->load->model('tipoResiduo_model');
        $this->load->model('login_model');
        $this->load->helper('url_helper');
        $this->load->library('table');
        $this->load->library('session');
    }

    public function view() {
        $data['title'] = 'Lista de pontos';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('pontoColeta/map_view');
        $this->load->view('templates/footer');
    }

    public function listar() {
        $this->login_model->verificar_login();
        $data['pontos'] = $this->pontoColeta_model->get_ponto_full();
        $data['title'] = 'Lista de pontos';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/menu');
        $this->load->view('pontoColeta/lista');
        $this->load->view('templates/footer');
    }

    public function teste() {
        $this->pontoColeta_model->teste();
    }

    public function get_map() {
        $this->pontoColeta_model->get_map();
    }

    public function cadastrar() {

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Cadastrar ponto de coleta';
        $data ['residuos'] = $this->tipoResiduo_model->get_residuo();
        $data ['estados'] = $this->pontoColeta_model->get_estados();

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');
        $this->form_validation->set_rules('cidade', 'Cidade', 'required', array('required' => 'Voce deve preencher o %s.'));

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('pontoColeta/cad_view');
            $this->load->view('templates/footer');
        } else {
            $this->pontoColeta_model->inserir();
            $this->load->view('pontoColeta/success');
        }
    }

    public function deletar() {
        $this->login_model->verificar_login();
        $id = $this->uri->segment(3);
        $this->pontoColeta_model->remover($id);
        $this->listar();
    }

    public function editar() {
        $this->login_model->verificar_login();
        $data['id'] = $this->uri->segment(3);

        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['ponto'] = $this->pontoColeta_model->get_ponto_full($data['id']);

        $data['title'] = 'Editar ponto de coleta';
        $data['residuos'] = $this->tipoResiduo_model->get_residuo();
        $data['residuosPonto'] = $this->pontoColeta_model->get_residuos_from_ponto($data['id']);
        $data['estados'] = $this->pontoColeta_model->get_estados();
        $data['cidades'] = $this->pontoColeta_model->get_cidades();

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');
        $this->form_validation->set_rules('cidade', 'Cidade', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/menu');
            $this->load->view('pontoColeta/editar');
            $this->load->view('templates/footer');
        } else {
            $this->pontoColeta_model->update();
            redirect('./pontoColeta/listar');
        }
    }

    public function estados() {
        $this->pontoColeta_model->get_estados();
    }

    public function cidades() {
        echo json_encode($this->pontoColeta_model->get_cidades());
    }

}
