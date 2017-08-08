<?php

class UsuarioGrupo_Model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function setUsuarioGrupo() {
    $data = array(
      'nome' => $this->input->post('nome_instituicao')
    );
    return $this->db->insert('instituicao', $data);
  }

}
