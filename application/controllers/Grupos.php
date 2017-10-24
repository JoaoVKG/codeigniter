<?php

class Grupos extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('grupo_model');
    $this->load->model('post_model');
    $this->load->helper('url_helper');
  }

  public function index() {
    $data['grupos'] = $this->grupo_model->getgrupos();
    $data['title'] = 'Grupos';
    $this->load->view('templates/header', $data);
    $this->load->view('grupos/index');
    $this->load->view('templates/footer');
  }

  public function grupo($slug) {
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
    $data['posts'] = $this->post_model->getPrimeiros5PostsByGrupo($slug);
    if (isset($_SESSION['usuario_logado']['id_usuario']))
    $data['notificacao'] = $this->grupo_model->getNotificaoByIdGrupoIdUsuario($data['grupo']['id_grupo'], $_SESSION['usuario_logado']['id_usuario']);
    if(empty($data['grupo'])) {
      redirect('/', 'refresh');
    }
    $data['title'] = $data['grupo']['nome'];

    $this->load->view('templates/header', $data);
    $this->load->view('grupos/grupo', $data);
    $this->load->view('templates/footer');
  }

  public function sobre($slug) {
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
    
     $data['title'] = 'Sobre o grupo ' . $data['grupo']['nome'];

     $this->load->view('templates/header', $data);
    $this->load->view('grupos/sobre', $data);
    $this->load->view('templates/footer');

  }

  public function participantes($slug) {
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
    $data['participantes'] = $this->grupo_model->getCriadorParticipantesBySlug($slug);

    $data['title'] = 'Participantes do grupo ' . $data['grupo']['nome'];

    $this->load->view('templates/header', $data);
    $this->load->view('grupos/participantes', $data);
    $this->load->view('templates/footer');
  }

  public function contato($slug) {
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
   
    $data['title'] = 'Contato do grupo ' . $data['grupo']['nome'];

    $this->load->view('templates/header', $data);
    $this->load->view('grupos/contato', $data);
    $this->load->view('templates/footer');
  }

  public function enviarEmail($slug) {
    $grupo = $this->grupo_model->getgrupobyslug($slug);
    if(isset($_SESSION['usuario_logado']['nome'])) {
      $email_from = $_SESSION['usuario_logado']['email'];
      $nome_from = $_SESSION['usuario_logado']['nome'] . " " . $_SESSION['usuario_logado']['sobrenome'];
    } else {
      $email_from = $this->input->post('email');
      $nome_from = $this->input->post('nome');
    }
    
    $assunto = $this->input->post('assunto') . ' - Contato SGCGP - ' . $grupo['nome'];
    $mensagem = $this->input->post('mensagem');
    $this->email->from($email_from, $nome_from);
    $this->email->subject($assunto);
    $this->email->to($grupo['email_contato']); 
    $this->email->message($mensagem);
    if ($this->email->send()) {
      $_SESSION['sucesso'] = true;
      $this->session->mark_as_flash('sucesso');
      redirect('/grupo/' . $grupo['slug'] . '/contato', 'refresh');
    }
  }

  public function gerenciarparticipantes($slug) {
    $this->load->model('usuario_model');
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
    $data['title'] = 'Administração '.$data['grupo']['nome'];
    $data['aprovado'] = null;
    $data['admin'] = true;
    if(isset($_SESSION['usuario_logado']['id_usuario'])) {
      $data['aprovado'] = $this->usuario_model->isAdministrador($data['grupo']['id_grupo']);
    }

    if ($data['aprovado']) {
      $data['solicitacoes'] = $this->grupo_model->getSolicitacoesPendentes($data['grupo']['slug']);
      $data['participantes'] = $this->grupo_model->getCriadorParticipantesBySlug($data['grupo']['slug']);
      $this->load->view('templates/headeradmin', $data);
      $this->load->view('grupos/gerenciarparticipantes');
      $this->load->view('templates/footeradmin');
    } else {
      redirect('/gerenciar-grupos', 'refresh');
    }
  }

  public function gerenciar($slug) {
    $this->load->library('form_validation');
    $this->load->model('area_model');
    $this->load->model('instituicao_model');
    $this->load->model('usuario_model');
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
    $data['title'] = 'Administração '.$data['grupo']['nome'];
    $data['areas'] = $this->area_model->getAreas();
    $data['instituicoes'] = $this->instituicao_model->getInstituicao();
    $data['aprovado'] = null;
    $data['admin'] = true;
    if(isset($_SESSION['usuario_logado']['id_usuario'])) {
      $data['aprovado'] = $this->usuario_model->isAdministrador($data['grupo']['id_grupo']);
    }

    if ($data['aprovado']) {
      $data['solicitacoes'] = $this->grupo_model->getSolicitacoesPendentes($data['grupo']['slug']);
      $this->load->view('templates/headeradmin', $data);
      $this->load->view('grupos/editar');
      $this->load->view('templates/footeradmin');
    } else {
      redirect('/gerenciar-grupos', 'refresh');
    }
  }

  public function solicitacoes($slug) {
    $this->load->model('usuario_model');
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
    $data['title'] = 'Administração '.$data['grupo']['nome'];
    $data['aprovado'] = null;
    $data['admin'] = true;
    if(isset($_SESSION['usuario_logado']['id_usuario'])) {
      $data['aprovado'] = $this->usuario_model->isAdministrador($data['grupo']['id_grupo']);
    }

    if ($data['aprovado']) {
      $data['solicitacoes'] = $this->grupo_model->getSolicitacoesPendentes($data['grupo']['slug']);
      $this->load->view('templates/headeradmin', $data);
      $this->load->view('grupos/solicitacoespendentes', $data);
      $this->load->view('templates/footeradmin');
    } else {
      redirect('/gerenciar-grupos', 'refresh');
    }
  }

  public function primeirospassos() {
    $this->load->library('form_validation');
    $this->load->model('area_model');
    $this->load->model('instituicao_model');
    $this->load->model('usuario_model');
    $data['title'] = 'Entre em um grupo';
    $data['grupos'] = $this->grupo_model->getgrupos();
    $data['area_grupo'] = $this->getGruposAreas();
    $data['areas'] = $this->area_model->getAreas();
    $data['instituicoes'] = $this->instituicao_model->getInstituicao();
    $data['solicitacoes'] = $this->usuario_model->getSolicitacoesUsuario($_SESSION['usuario_logado']['id_usuario']);

    $this->form_validation->set_rules('nome', 'nome', 'required');
    $this->form_validation->set_rules('link', 'link', 'required|is_unique[grupo.slug]');
    $this->form_validation->set_rules('sobre', 'sobre o grupo', 'required');
    $this->form_validation->set_rules('email', 'email', 'required|valid_email');
    $this->form_validation->set_rules('area', 'área do conhecimento', 'required');
    $this->form_validation->set_rules('instituicao', 'instituição', 'required');
    $this->form_validation->set_rules('cor', 'cor');
    $this->form_validation->set_rules('posicao_grupo', 'posição no grupo', 'required|in_list[1,2]');

    if($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('usuario/primeirospassos');
      $this->load->view('templates/footer');
    } else {
      $grupo = $this->grupo_model->setgrupo();
      if($grupo) {
        redirect('entre-em-um-grupo', 'refresh');
      } else {
        $this->load->view('templates/header', $data);
        $this->load->view('usuario/primeirospassos');
        $this->load->view('templates/footer');
      }
    }
  }

  public function procurargrupos() {
    $this->load->model('area_model');
    $this->load->model('instituicao_model');
    $data['title'] = 'Procurar grupos';
    $data['grupos'] = $this->grupo_model->getgrupos();
    $data['instituicoes'] = $this->instituicao_model->getInstituicao();
    $data['area_grupo'] = $this->getGruposAreas();
    $this->load->view('templates/header', $data);
    $this->load->view('usuario/procurargrupos');
    $this->load->view('templates/footer');
  }

  public function alternarnotificacao() {
    $id_grupo = $this->input->post('id_grupo');
    $id_usuario = $this->input->post('id_usuario');
    echo $this->grupo_model->toggleNotificacao($id_grupo, $id_usuario);
  }

  public function getGruposAreas() {
    $grupos = $this->grupo_model->getgrupos();
    $areas = [];
    foreach ($grupos as $grupo) {
      $areas[] = $this->area_model->getareabycodigo($grupo['area']);
    }
    return $areas;
  }

  public function callback_posicao_grupo() {
    if($this->input->post('posicao_grupo') == 1 || $this->input->post('posicao_grupo') == 2) {
      return TRUE;
    } else {
      $this->form_validation->set_message('posicao_grupo', 'O papel não é válido.');
      return FALSE;
    }
  }

  public function slugUnico() {
    $slug = $this->input->post('unico');
    $this->db->where("slug", $slug);
    $grupo = $this->db->get("grupo")->row_array();
    if($grupo) {
      echo true;
    } else {
      echo false;
    }
  }

  public function gerenciargrupos() {
    if(!isset($_SESSION['usuario_logado']['nome'])) {
      redirect('/', 'refresh');
    } else {
        $data['title'] = 'Gerenciar grupos';
        $id_usuario = $_SESSION['usuario_logado']['id_usuario'];
        $data['grupos'] = $this->grupo_model->getGruposEditaveis($id_usuario);
        $this->load->view('templates/header', $data);
        $this->load->view('grupos/gerenciargrupos');
    } 
  }

  public function atualiza() {
    $this->load->model('usuario_model');
    $data['aprovado'] = null;
    $id_grupo = $this->input->post('id_grupo');

    if(isset($_SESSION['usuario_logado']['id_usuario'])) {
      $data['aprovado'] = $this->usuario_model->isAdministrador($id_grupo);
    }

    if($data['aprovado']) {
      $this->grupo_model->updateGrupo();
      echo $this->input->post('link_grupo');
    }
  }

  public function excluirgrupo() {
    $this->load->model('usuario_model');    
    if(isset($_SESSION['usuario_logado']['nome'])) {
      $id_usuario = $_SESSION['usuario_logado']['nome'];
      $id_grupo = $this->input->post('id_grupo');
      $data['admin'] = $this->usuario_model->isAdministrador($id_grupo);
      if ($data['admin']) {
        $this->grupo_model->deleteGrupo($id_grupo);
        echo true;
      } else {
        echo false;
      }
    }
  }

}
