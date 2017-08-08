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

  public function getGrupoByIdUserId($id_grupo, $id_usuario) {
    $this->db->where("id_grupo", $id_grupo);
    $this->db->where("id_usuario", $id_usuario);
    $query = $this->db->get("usuario_grupo")->row_array();
    return $query;
  }

  public function getParticipantesBySlug($slug) {
    // SELECT u.nome, p.nome as papel from usuario u, papel p, grupo g, usuario_grupo ug
    // WHERE g.slug = 'tecnologias-inovadoras-com-android' AND g.id_grupo = ug.id_grupo
    // AND ug.id_usuario = u.id_usuario AND ug.id_papel = p.id_papel ORDER BY p.id_papel;

    // $this->db->select('u.nome, u.sobrenome, p.nome as papel');
    // $this->db->from('usuario u, papel p, grupo g, usuario_grupo ug');
    // $this->db->where('g.slug', $slug);
    // $this->db->where('g.id_grupo = ug.id_grupo');
    // $this->db->where('ug.id_usuario = u.id_usuario');
    // $this->db->where('ug.id_papel = p.id_papel');
    // $this->db->order_by('p.id_papel', 'ASC');
    // $query = $this->db->get();
    // return $query->result_array();
    $query = $this->db->query("SELECT u.nome, u.sobrenome, p.nome as papel from usuario u, papel p, grupo g, usuario_grupo ug WHERE g.slug = '" . $slug . "' AND g.id_grupo = ug.id_grupo AND ug.id_usuario = u.id_usuario AND ug.id_papel = p.id_papel ORDER BY p.id_papel");
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
      'senha_admin' => $this->input->post('senha'),
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
      'aprovado' => TRUE
    );

    return $this->db->insert('usuario_grupo', $grupo_usuario);
  }

}
