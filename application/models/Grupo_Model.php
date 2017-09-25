<?php

class Grupo_Model extends CI_Model {

  public function __construct() {
    $this->load->database();
  }

  public function getGrupos() {
    $query = $this->db->get('grupo');
    return $query->result_array();
  }

  public function getGrupoBySlug($slug) {
    $query = $this->db->get_where('grupo', array('slug' => $slug));
    return $query->row_array();
  }

  public function getGruposEditaveis($id_usuario) {
    //SELECT * FROM grupo g, usuario_grupo ug
    //WHERE ug.id_usuario = 1 AND ug.pode_editar_grupo = TRUE AND ug.id_grupo = g.id_grupo;
    $query = $this->db->query("SELECT * FROM grupo g, usuario_grupo ug WHERE ug.id_usuario = '". $id_usuario ."' AND ug.aprovado = TRUE AND ug.id_grupo = g.id_grupo;");
    return $query->result_array();
  }

  public function getGrupoByIdUserIdAprovado($id_grupo, $id_usuario) {
    $this->db->where("id_grupo", $id_grupo);
    $this->db->where("id_usuario", $id_usuario);
    $this->db->where("aprovado", true);
    $query = $this->db->get("usuario_grupo")->row_array();
    return $query;
  }

  public function getGrupoByIdUserIdPodeEditar($id_grupo, $id_usuario) {
    $this->db->where("id_grupo", $id_grupo);
    $this->db->where("id_usuario", $id_usuario);
    $this->db->where("pode_editar_grupo", true);
    $query = $this->db->get("usuario_grupo")->row_array();
    return $query;
  }
  

  public function getCriadorParticipantesBySlug($slug) {
    $query = $this->db->query("SELECT u.nome, u.sobrenome, p.nome as papel from usuario u, papel p, grupo g, usuario_grupo ug WHERE g.slug = '" . $slug . "' AND g.id_grupo = ug.id_grupo AND ug.id_usuario = u.id_usuario AND ug.aprovado = true AND ug.id_papel = p.id_papel ORDER BY p.id_papel");
    return $query->result_array();
  }

  public function getParticipantesBySlug($slug) {
    $query = $this->db->query("SELECT u.id_usuario, u.nome, u.email, u.sobrenome, ug.id_papel from usuario u, papel p, grupo g, usuario_grupo ug WHERE g.slug = '" . $slug . "' AND g.id_grupo = ug.id_grupo AND ug.id_usuario = u.id_usuario AND ug.aprovado = true AND ug.pode_editar_grupo = false AND ug.id_papel = p.id_papel ORDER BY p.id_papel");
    return $query->result_array();
  }

  public function getSolicitacoesPendentes($slug) {
    // SELECT * FROM usuario u, usuario_grupo ug, grupo g
    // WHERE u.id_usuario = ug.id_usuario AND ug.id_grupo = g.id_grupo AND ug.aprovado = false;
    $query = $this->db->query("SELECT u.id_usuario, u.nome, u.sobrenome, u.email FROM usuario u, usuario_grupo ug, grupo g WHERE u.id_usuario = ug.id_usuario AND ug.id_grupo = g.id_grupo AND ug.aprovado = false AND g.slug ='" . $slug . "'");
    return $query->result_array();
  }

  public function setGrupo() {
    $this->load->model('instituicao_model');
    $instituicao = $this->instituicao_model->getInstituicaoByNome();
    $id_instituicao = $instituicao['id_instituicao'];
    $data = array(
      'nome' => $this->input->post('nome'),
      'slug' => $this->input->post('link'),
      'sobre' => $this->input->post('sobre'),
      'email_contato' => $this->input->post('email'),
      'area' => $this->input->post('area'),
      'cor_primaria' => $this->input->post('cor'),
      'id_instituicao' => $id_instituicao
    );
    $this->db->insert('grupo', $data);
    $id_grupo = $this->db->insert_id();

    $grupo_usuario = array(
      'id_usuario' => $_SESSION['usuario_logado']['id_usuario'],
      'id_grupo' => $id_grupo,
      'id_papel' => $this->input->post('posicao_grupo'),
      'aprovado' => true,
      'pode_editar_grupo' => true
    );

    return $this->db->insert('usuario_grupo', $grupo_usuario);
  }

}
