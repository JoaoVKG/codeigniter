<?php

class Post_Model extends CI_Model {
  public function __construct() {
    $this->load->database();
  }

  public function getPostsByGrupo($nome_grupo){
    $query = $this->db->query("select conteudo from post p, grupo g where p.id_grupo = g.id_grupo and g.nome = '" . $nome_grupo . "'");
    return $query->result_array();
  }

  public function setPost() {
    $this->load->helper('text');
  }
}
