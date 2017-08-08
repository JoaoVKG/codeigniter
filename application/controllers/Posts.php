<?php
class Posts extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('post_model');
    $this->load->helper('url_helper');
  }

  public function view($slug = NULL) {
    $data['posts'] = $this->post_model->getPostsByGrupo($slug);
    if(empty($data['posts'])) {
      redirect('/grupo/'. $slug, 'refresh');
    }
    $data['title'] = $nome_grupo . ' - Posts';
    $this->load->view('templates/header', $data);
    $this->load->view('posts/index', $data);
    $this->load->view('templates/footer');
  }
}
