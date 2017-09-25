<?php

class Post_Model extends CI_Model {
  public $limitePosts = 2;
  
  public function __construct() {
    $this->load->database();
  }

  public function getPostBySlugGrupoPostId($slug, $id_post) {
    $query = $this->db->query("select g.id_grupo from grupo g where g.slug = '" . $slug . "'");
    $grupo = $query->row_array();
    $id_grupo = $grupo['id_grupo'];
    $query = $this->db->query("select u.nome, u.sobrenome, p.id_post, p.titulo, p.conteudo, p.data from post p, grupo g, usuario u, usuario_post up where p.id_post = up.id_post and up.id_usuario = u.id_usuario and p.id_grupo = g.id_grupo and g.slug = '" . $slug . "' and p.id_post = " . $id_post);
    return $query->row_array();
  }

  public function getPrimeiros5PostsByGrupo($slug){
    $query = $this->db->query("select u.nome, u.sobrenome, p.id_post, p.titulo, p.conteudo, p.data from post p, grupo g, usuario u, usuario_post up where p.id_post = up.id_post and up.id_usuario = u.id_usuario and p.id_grupo = g.id_grupo and g.slug = '" . $slug . "' limit $this->limitePosts");
    return $query->result_array();
  }

  public function getProximos5PostsByGrupo($ultimo_id, $slug) {
    $query = $this->db->query("select u.nome, u.sobrenome, p.id_post, p.titulo, p.conteudo, p.data from post p, grupo g, usuario u, usuario_post up where p.id_post = up.id_post and up.id_usuario = u.id_usuario and p.id_grupo = g.id_grupo and g.slug = '" . $slug . "' and p.id_post > $ultimo_id limit $this->limitePosts");
    return $query->result_array();
  }

  public function setPost($id_grupo) {
    $data = array(
      'titulo' => $this->input->post('titulo'),
      'conteudo' => $this->input->post('conteudo'),
      'data' => date('Y-m-d'),
      'id_grupo' => $id_grupo
    );
    $this->db->insert('post', $data);
    $id_post = $this->db->insert_id();

    $post_usuario = array(
      'id_usuario' => $_SESSION['usuario_logado']['id_usuario'],
      'id_post' => $id_post,
      'pode_editar_post' => true,
      'autor' => true
    );

    return $this->db->insert('usuario_post', $post_usuario);
  }


}
