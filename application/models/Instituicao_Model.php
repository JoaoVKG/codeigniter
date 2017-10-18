<?php

class Instituicao_Model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function getInstituicao() {
    $query = $this->db->get('instituicao');
    return $query->result_array();
  }

  public function getInstituicaoByNome() {
    $nome = $this->input->post('instituicao');
    $this->db->where("nome", $nome);
    $query = $this->db->get("instituicao")->row_array();
    return $query;
  }

  public function setInstituicao() {

    $data = array(
      'nome' => $this->input->post('nome_instituicao')
    );

    $this->db->insert('instituicao', $data);
    return $this->db->insert_id();
  }

}
