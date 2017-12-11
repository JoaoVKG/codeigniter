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

  public function getUsuarioById($id_usuario) {
    $this->db->where("id_usuario", $id_usuario);
    $usuario = $this->db->get("usuario")->row_array();
    return $usuario;
  }

  public function setUsuario() {

    $senha = $this->input->post('senha');
    $opc = ['cost' => 12];
    $senha = password_hash($senha, PASSWORD_DEFAULT, $opc);

    $data = array(
      'nome' => $this->input->post('nome', TRUE),
      'sobrenome' => $this->input->post('sobrenome', TRUE),
      'email' => $this->input->post('email'),
      'senha' => $senha
    );
    return $this->db->insert('usuario', $data);
  }

  public function updateUsuario() {
    $senha = $this->input->post('senha');
    $opc = ['cost' => 12];

    if ($senha != null || $senha != '') {
      $senha = password_hash($senha, PASSWORD_DEFAULT, $opc);
    } else {
      $senha = $_SESSION['usuario_logado']['senha'];
    }

    $data = array(
      'nome' => $this->input->post('nome'),
      'sobrenome' => $this->input->post('sobrenome'),
      'email' => $this->input->post('email'),
      'senha' => $senha
    );
    $this->db->where('id_usuario', $_SESSION['usuario_logado']['id_usuario']);
    $this->db->update('usuario', $data);
    return true;
  }

  public function setSolicitacaoUsuario($id_grupo) {
    $data = array(
      'id_usuario' => $_SESSION['usuario_logado']['id_usuario'],
      'id_grupo' => $id_grupo,
      'id_papel' => 2,
      'aprovado' => false,
      'pode_editar_grupo' => false
    );

    return $this->db->insert('usuario_grupo', $data);
  }

  public function getSolicitacoesUsuario() {
    $id_usuario = $_SESSION['usuario_logado']['id_usuario'];
    $this->db->where("id_usuario", $id_usuario);
    $usuario = $this->db->get("usuario_grupo")->result_array();
    return $usuario;
  }

  public function isAdministrador($id_grupo) {
    $id_usuario = $_SESSION['usuario_logado']['id_usuario'];
    $this->db->where("id_usuario", $id_usuario);
    $this->db->where("id_grupo", $id_grupo);
    $this->db->where("pode_editar_grupo", true);
    $admin = $this->db->get("usuario_grupo")->row_array();
    return $admin;
  }
 
  public function aprovarSolicitacao($id_grupo, $id_usuario) {
    $data = array(
      'aprovado' => true
    );

    $this->db->where('id_usuario', $id_usuario);
    $this->db->where('id_grupo', $id_grupo);
    $this->db->update('usuario_grupo', $data);
  }

  public function atualizaParticipante($id_grupo, $id_usuario, $id_papel) { 
    $data = array(
      'id_papel' => $id_papel
    );

    $this->db->where('id_usuario', $id_usuario);
    $this->db->where('id_grupo', $id_grupo);
    $this->db->update('usuario_grupo', $data);
  }

  public function removeParticipante($id_grupo, $id_usuario) {
    $this->db->where('id_usuario', $id_usuario);
    $this->db->where('id_grupo', $id_grupo);
    $this->db->delete('usuario_grupo');
  }

}
