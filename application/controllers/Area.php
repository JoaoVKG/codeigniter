<?php
class Area extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('area_model');
    $this->load->helper('url_helper');
  }

  public function index() {
    $data['areas'] = $this->area_model->getAreas();
    $this->load->view('area/index', $data);
  }

}
