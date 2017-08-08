<?php

class Usuario_Model extends CI_Model {
  public function __construct() {
    $this->load->database();
  }

  public function getUsuarioByEmail() {
    $email = $this->input->post('email');
    $this->db->where("email", $email);
    $usuario = $this->db->get("usuario")->row_array();
    return $usuario;
  }

  public function setUsuario() {

    $senha = $this->input->post('senha');
    $opc = ['cost' => 12];
    $senha = password_hash($senha, PASSWORD_DEFAULT, $opc);

    $data = array(
      'nome' => $this->input->post('nome'),
      'sobrenome' => $this->input->post('sobrenome'),
      'email' => $this->input->post('email'),
      'senha' => $senha
    );

    return $this->db->insert('usuario', $data);
  }
}
