<?php

class Grupos extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('grupo_model');
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
    if(empty($data['grupo'])) {
      redirect('/', 'refresh');
    }
    $data['title'] = $data['grupo']['nome'];

    $this->load->view('templates/header', $data);
    $this->load->view('grupos/grupo', $data);
    $this->load->view('templates/footer');
  }

  public function participantes($slug) {
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
    $data['participantes'] = $this->grupo_model->getParticipantesBySlug($slug);

    $data['title'] = 'Participantes do grupo ' . $data['grupo']['nome'];

    $this->load->view('templates/header', $data);
    $this->load->view('grupos/participantes', $data);
    $this->load->view('templates/footer');
  }

  public function sobre($slug) {
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
    
     $data['title'] = 'Sobre o grupo ' . $data['grupo']['nome'];

     $this->load->view('templates/header', $data);
    $this->load->view('grupos/sobre', $data);
    $this->load->view('templates/footer');

  }

  public function admin($slug) {
    $this->load->library('form_validation');
    $data['grupo'] = $this->grupo_model->getgrupobyslug($slug);
    $data['title'] = 'Administração '.$data['grupo']['nome'];
    if(isset($_SESSION['usuario_logado']['id_usuario'])) {
      $data['esta_no_grupo'] = $this->grupo_model->getGrupoByIdUserId($data['grupo']['id_grupo'], $_SESSION['usuario_logado']['id_usuario']);
    }
    $this->form_validation->set_rules('senha', 'senha', 'required|callback_check_senha['.$slug.']');

    if($this->form_validation->run() === FALSE && (!array_key_exists($slug, $_SESSION) || $_SESSION[$slug] === FALSE)) {
      $this->load->view('grupos/senha', $data);
    } else {
      $this->load->view('grupos/admin', $data);
    }
  }

  public function menu_admin() {
    $id = $this->input->post('id');
    switch($id) {
      case 1:
      echo $this->load->view('grupos/criarpost', NULL, TRUE);
      break;
      case 2:
      echo $id;
      break;
      case 3:
      echo $id;
      break;
      default:

    }
  }

  public function primeirospassos() {
    $this->load->library('form_validation');
    $this->load->model('area_model');
    $this->load->model('instituicao_model');
    $data['title'] = 'Gerencie seus grupos';
    $data['grupos'] = $this->grupo_model->getgrupos();
    $data['area_grupo'] = $this->getGruposAreas();
    $data['areas'] = $this->area_model->getAreas();
    $data['instituicoes'] = $this->instituicao_model->getInstituicao();

    $this->form_validation->set_rules('nome', 'nome', 'required');
    $this->form_validation->set_rules('link', 'link', 'required|is_unique[grupo.slug]');
    $this->form_validation->set_rules('sobre', 'sobre o grupo', 'required');
    $this->form_validation->set_rules('email', 'email', 'required|valid_email');
    $this->form_validation->set_rules('senha', 'senha', 'required');
    $this->form_validation->set_rules('area', 'área do conhecimento', 'required');
    $this->form_validation->set_rules('instituicao', 'instituição', 'required');
    $this->form_validation->set_rules('cor', 'cor');
    $this->form_validation->set_rules('posicao_grupo', 'posição no grupo', 'required|in_list[1,2]');

    if($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('usuario/primeirospassos');
    } else {
      $grupo = $this->grupo_model->setgrupo();
      if($grupo) {
        redirect('gerenciar-grupos', 'refresh');
      } else {
        $this->load->view('templates/header', $data);
        $this->load->view('usuario/primeirospassos');
      }
    }
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

  public function check_senha($senha, $slug) {
    $grupo = $this->grupo_model->getgrupobyslug($slug);
    if($senha === $grupo['senha_admin']) {
      $_SESSION[$slug] = TRUE;
      return TRUE;
    } else {
      $_SESSION[$slug] = FALSE;
      $this->form_validation->set_message('check_senha', 'Senha inválida!');
      return FALSE;
    }
  }
}
