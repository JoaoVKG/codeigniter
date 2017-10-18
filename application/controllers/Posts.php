<?php
class Posts extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('post_model');
    $this->load->model('grupo_model');
    $this->load->helper('url_helper');
  }

  public function index($slug, $id_post) {
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
    $data['post'] = $this->post_model->getPostBySlugGrupoPostId($slug, $id_post);
    $data['title'] = $data['post']['titulo'];
    $this->load->view('templates/header', $data);
    $this->load->view('posts/index', $data);
    $this->load->view('templates/footer');
  }

  public function carregar_posts() {
    $slug = $this->input->post('slug');
    $ultimo_id = $this->input->post('ultimo_id');
    $posts_carregados = $this->post_model->getProximos5PostsByGrupo($ultimo_id, $slug);
    foreach ($posts_carregados as $post_carregado) {
      echo '
      <article class="post ql-editor quill-fix" data-id="'.$post_carregado['id_post'].'">
      <h2 class="ui header"><a href="'.base_url("grupo/{$slug}/post/{$post_carregado['id_post']}") . '">'.$post_carregado['titulo'].'</a>
        <div class="sub header">Escrito por ' . $post_carregado['nome'] . ' ' . $post_carregado['sobrenome'] . '<p>' . strftime('%A, %d de %B de %Y', strtotime($post_carregado['data'])) . '</p></div>
      </h2>
      '. $post_carregado['conteudo'] .
      '</article>
      <div class="ui divider"></div>';
    }
  }

  public function gerenciar($slug) {
    $this->load->model('usuario_model');
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
    $data['aprovado'] = null;
    $data['admin'] = null;
    $data['title'] = 'Gerenciar postagem';
    if(isset($_SESSION['usuario_logado']['id_usuario'])) {
      $data['aprovado'] = $this->grupo_model->getGrupoByIdUserIdAprovado($data['grupo']['id_grupo'], $_SESSION['usuario_logado']['id_usuario']);
      $data['admin'] = $this->usuario_model->isAdministrador($data['grupo']['id_grupo']);
      if ($data['admin']) {
        $data['posts'] = $this->post_model->getPostsByAdminIdGrupoId($_SESSION['usuario_logado']['id_usuario'], $data['grupo']['id_grupo']);
      } else {
        $data['posts'] = $this->post_model->getPostsByUserIdGrupoId($_SESSION['usuario_logado']['id_usuario'], $data['grupo']['id_grupo']);
      }
    }

    if ($data['aprovado']) {
      $data['solicitacoes'] = $this->grupo_model->getSolicitacoesPendentes($data['grupo']['slug']);
      $this->load->view('templates/headeradmin', $data);
      $this->load->view('posts/gerenciarpost', $data);
      $this->load->view('templates/footeradmin');
    } else {
      redirect('/gerenciar-grupos', 'refresh');
    }
  }

  public function deletarPost() {
    $this->post_model->deletePost($this->input->post('id_post'));
    echo true;
  }

  public function criar($slug) {
    $this->load->model('usuario_model');
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
    $data['aprovado'] = null;
    $data['admin'] = null;
    $data['title'] = 'Criar postagem';
    $this->load->library('form_validation');
    if(isset($_SESSION['usuario_logado']['id_usuario'])) {
      $data['aprovado'] = $this->grupo_model->getGrupoByIdUserIdAprovado($data['grupo']['id_grupo'], $_SESSION['usuario_logado']['id_usuario']);
      $data['admin'] = $this->usuario_model->isAdministrador($data['grupo']['id_grupo']);
    }

    if ($data['aprovado']) {
      $data['solicitacoes'] = $this->grupo_model->getSolicitacoesPendentes($data['grupo']['slug']);
      $this->form_validation->set_rules('titulo', 'título', 'required');
      $this->form_validation->set_rules('conteudo', 'conteúdo', 'required');
      
      if($this->form_validation->run() === FALSE) {
        $this->load->view('templates/headeradmin', $data);
        $this->load->view('posts/criarpost', $data);
        $this->load->view('templates/footeradmin');
      } else {
        $postagem = $this->post_model->setPost($data['grupo']['id_grupo']);
        if ($postagem) {
          $_SESSION['sucesso'] = true;
          $this->session->mark_as_flash('sucesso');
          redirect("/grupo/{$slug}/criar-post");
        }
      }
    } else {
      redirect('/gerenciar-grupos', 'refresh');
    }
  }

  public function editar($slug, $id_post) {
    $this->load->model('usuario_model');
    $data['post'] = $this->post_model->getPostBySlugGrupoPostId($slug, $id_post);
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
    $data['aprovado'] = null;
    $data['admin'] = null;
    $data['title'] = 'Editar postagem';
    $this->load->library('form_validation');
    if(isset($_SESSION['usuario_logado']['id_usuario'])) {
      $data['aprovado'] = $this->grupo_model->getGrupoByIdUserIdAprovado($data['grupo']['id_grupo'], $_SESSION['usuario_logado']['id_usuario']);
      $data['admin'] = $this->usuario_model->isAdministrador($data['grupo']['id_grupo']);
    }

    if ($data['aprovado']) {
      $data['solicitacoes'] = $this->grupo_model->getSolicitacoesPendentes($data['grupo']['slug']);
      $this->form_validation->set_rules('titulo', 'título', 'required');
      $this->form_validation->set_rules('conteudo', 'conteúdo', 'required');
      
      if($this->form_validation->run() === FALSE) {
        $this->load->view('templates/headeradmin', $data);
        $this->load->view('posts/editarpost', $data);
        $this->load->view('templates/footeradmin');
      } else {
        $postagem = $this->post_model->setPost($data['grupo']['id_grupo']);
        if ($postagem) {
          $_SESSION['sucesso'] = true;
          $this->session->mark_as_flash('sucesso');
          redirect("/grupo/{$slug}/criar-post");
        }
      }
    } else {
      redirect('/gerenciar-grupos', 'refresh');
    }
  }

  public function editarPostagem() {
    $this->post_model->updatePost();
    echo true;
  }
}
