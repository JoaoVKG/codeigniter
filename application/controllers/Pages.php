<?php
class Pages extends CI_Controller {

  public function view($page = 'index') {
    if ( ! file_exists(APPPATH.'views/pages/'.$page.'.php')) {
      // Whoops, we don't have a page for that!
      show_404();
    }

    $data['title'] = ucfirst($page); // Capitalize the first letter

    if($page == 'index') {
      $this->load->model('grupo_model');
      $this->load->model('area_model');
      $this->load->model('instituicao_model');
      $data['instituicoes'] = $this->instituicao_model->getInstituicao();
      $data['grupos'] = $this->grupo_model->getgrupos();
      $data['area_grupo'] = $this->getGruposAreas();
    }
    $this->load->view('pages/'.$page, $data);
  }

  public function getGruposAreas() {
    $grupos = $this->grupo_model->getgrupos();
    $areas = [];
    foreach ($grupos as $grupo) {
      $areas[] = $this->area_model->getareabycodigo($grupo['area']);
    }
    return $areas;
  }

}
