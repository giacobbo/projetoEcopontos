<?php

class PontoColeta_model extends CI_Model {

    public function __construct() {
        $this->load->database();
        $this->load->model('tipoResiduo_model');
    }

    public function get_ponto($id = NULL) {
        if ($id === NULL) {
            $query = $this->db->get('pontocoleta');
            return $query->result_array();
        }

        $query = $this->db->get_where('pontocoleta', array('id' => $id));
        return $query->row_array();
    }

    public function get_ponto_full($id = NULL) {
        if ($id !== NULL) {
            $this->db->where('pontocoleta.id', $id);
        }
        $this->db->select('pontocoleta.id as id, pontocoleta.nome as nomePonto,rua,cidades.id as idCidade, cidades.nome as nomeCidade,estados.id as idEstado, estados.nome as nomeEstado,numero,complemento, cep, lat,lng, tiporesiduo.nome as residuo');
        $this->db->join('estab_has_tiporesiduo', 'pontocoleta.id = estab_has_tiporesiduo.estabelecimento');
        $this->db->join('tiporesiduo', 'tiporesiduo.id = estab_has_tiporesiduo.residuo');
        $this->db->join('cidades', 'pontocoleta.cidade = cidades.id');
        $this->db->join('estados', 'pontocoleta.estado = estados.id');
        $this->db->order_by('pontocoleta.id');
        $res = $this->db->get('pontocoleta')->result();

        foreach ($res as $data) {
            $final[$data->id]['id'] = $data->id;
            $final[$data->id]['nomePonto'] = $data->nomePonto;
            $final[$data->id]['rua'] = $data->rua;
            $final[$data->id]['numero'] = $data->numero;
            $final[$data->id]['idCidade'] = $data->idCidade;
            $final[$data->id]['cidade'] = $data->nomeCidade;
            $final[$data->id]['idEstado'] = $data->idEstado;
            $final[$data->id]['estado'] = $data->nomeEstado;
            $final[$data->id]['complemento'] = $data->complemento;
            $final[$data->id]['cep'] = $data->cep;
            $final[$data->id]['lat'] = $data->lat;
            $final[$data->id]['lng'] = $data->lng;
            $temp[$data->id][] = $data->residuo;
            $final[$data->id]['residuo'] = implode(", ", $temp[$data->id]);
        }

        return $final;
    }

    public function get_residuos_from_ponto($id) {
        $this->db->where('estabelecimento', $id);
        $res = $this->db->get('estab_has_tiporesiduo')->result();
        foreach ($res as $data) {
            $array[] = $data->residuo;
        }
        return $array;
    }

    public function get_coord($num, $rua, $cidade, $estado) {

        $nomeCidade = $this->get_cidades($cidade)->nome;
        $nomeEstado = $this->get_estados($estado)->nome;

        $key = "AIzaSyCsvB4xzTiZu-mIlrU2zuRJMwWb24uNh08";
        $numFinal = trim($num);
        $ruaFinal = str_replace(' ', '+', trim($rua));
        $cidadeFinal = str_replace(' ', '+', trim($nomeCidade));
        $estadoFinal = str_replace(' ', '+', trim($nomeEstado));

        $url = "https://maps.googleapis.com/maps/api/geocode/xml?address=" . $numFinal . "+" . $ruaFinal . "+" . $cidadeFinal . "+" . $estadoFinal . "&key=" . $key;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $xml = curl_exec($ch);
        curl_close($ch);

        $cont = new SimpleXMLElement($xml);
        
        $coord['lat'] = (float) $cont->result->geometry->location->lat;
        $coord['lng'] = (float) $cont->result->geometry->location->lng;
        
        return $coord;
    }

    public function inserir() {
        $residuos_db = $this->tipoResiduo_model->get_residuo();

        $coord = $this->get_coord($this->input->post('numero'), $this->input->post('rua'), $this->input->post('cidade'), $this->input->post('estado'));

        $data = array(
            'nome' => $this->input->post('nome'),
            'estado' => $this->input->post('estado'),
            'cidade' => $this->input->post('cidade'),
            'rua' => $this->input->post('rua'),
            'numero' => $this->input->post('numero'),
            'complemento' => $this->input->post('complemento'),
            'cep' => $this->input->post('cep'),
            'lat' => $coord['lat'],
            'lng' => $coord['lng']
        );

        $this->db->trans_begin();
        $sql = $this->db->set($data)->get_compiled_insert('pontocoleta');
        $this->db->query($sql);
        $idPonto = $this->db->insert_id();


        foreach ($residuos_db as $residuo) {

            if ($this->input->post('residuo-' . $residuo['id'])) {
                $pht[] = array("estabelecimento" => $idPonto, "residuo" => $residuo['id']);
            }
        }
        if (count($pht) > 0) {
            $this->db->insert_batch('estab_has_tiporesiduo', $pht);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function update() {
        $residuos_db = $this->tipoResiduo_model->get_residuo();
        $coord = $this->get_coord($this->input->post('numero'), $this->input->post('rua'), $this->input->post('cidade'), $this->input->post('estado'));

        $data = array(
            'nome' => $this->input->post('nome'),
            'estado' => $this->input->post('estado'),
            'cidade' => $this->input->post('cidade'),
            'rua' => $this->input->post('rua'),
            'numero' => $this->input->post('numero'),
            'complemento' => $this->input->post('complemento'),
            'cep' => $this->input->post('cep'),
            'lat' => $coord['lat'],
            'lng' => $coord['lng']
        );

        $this->db->trans_begin();
        $this->db->where('id', $this->input->post('id'));
        $sql = $this->db->set($data)->get_compiled_update('pontocoleta');
        $this->db->query($sql);


        $this->db->delete('estab_has_tiporesiduo', array('estabelecimento' => $this->input->post('id')));

        foreach ($residuos_db as $residuo) {

            if ($this->input->post('residuo-' . $residuo['id'])) {
                $pht[] = array("estabelecimento" => $this->input->post('id'), "residuo" => $residuo['id']);
            }
        }
        if (count($pht) > 0) {
            $this->db->set($pht)->insert_batch('estab_has_tiporesiduo');
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function remover($id) {

        $this->db->where('id', $id);
        $delPonto = $this->db->delete('pontocoleta');

        if ($delPonto) {
            $this->db->where('estabelecimento', $id);
            return $this->db->delete('estab_has_tiporesiduo');
        }
    }

    public function get_estados($id = NULL) {
        if ($id === NULL) {
            return $this->db->get('estados')->result();
        } else {
            $this->db->where('id', $id);
            return $this->db->get('estados')->row();
        }
    }

    public function get_cidades($id = NULL) {
        if ($id === NULL) {
            if ($this->input->post('estado')) {
                $this->db->where("estados_id", $this->input->post('estado', true));
            }

            $this->db->order_by('nome');
            $cidades = $this->db->get('cidades')->result();
            return array('cidades' => $cidades);
        } else {
            $this->db->where('id', $id);
            return $this->db->get('cidades')->row();
        }
    }

    public function get_markers() {
        $this->db->select('pontocoleta.id, pontocoleta.nome as nomePonto,rua,cidades.nome as nomeCidade,estados.nome as nomeEstado,numero,complemento, lat,lng, tiporesiduo.nome as residuo');
        $this->db->join('estab_has_tiporesiduo', 'pontocoleta.id = estab_has_tiporesiduo.estabelecimento');
        $this->db->join('tiporesiduo', 'tiporesiduo.id = estab_has_tiporesiduo.residuo');
        $this->db->join('cidades', 'pontocoleta.cidade = cidades.id');
        $this->db->join('estados', 'pontocoleta.estado = estados.id');
        $this->db->order_by('pontocoleta.id');
        $res = $this->db->get('pontocoleta')->result();

        foreach ($res as $data) {
            $final[$data->id]['id'] = $data->id;
            $final[$data->id]['nomePonto'] = $data->nomePonto;
            $final[$data->id]['endereco'] = "Rua " . $data->rua . ", " . $data->numero . " - " . $data->nomeCidade . ", " . $data->nomeEstado;
            $final[$data->id]['lat'] = $data->lat;
            $final[$data->id]['lng'] = $data->lng;
            $temp[$data->id][] = $data->residuo;
            $final[$data->id]['residuo'] = implode(", ", $temp[$data->id]);
        }
        return $final;
    }

    public function get_map() {


// Start XML file, create parent node

        $dom = new DOMDocument("1.0");
        $node = $dom->createElement("markers");
        $parnode = $dom->appendChild($node);

// Select all the rows in the markers table
        $result = $this->get_markers();

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }

        header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each

        foreach ($result as $row) {
            // Add to XML document node
            $node = $dom->createElement("marker");
            $newnode = $parnode->appendChild($node);
            $newnode->setAttribute("id", $row['id']);
            $newnode->setAttribute("nomePonto", $row['nomePonto']);
            $newnode->setAttribute("endereco", $row['endereco']);
            $newnode->setAttribute("lat", $row['lat']);
            $newnode->setAttribute("lng", $row['lng']);
            $newnode->setAttribute("residuo", $row['residuo']);
        }

        echo $dom->saveXML();
    }

}
