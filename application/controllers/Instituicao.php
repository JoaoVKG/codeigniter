<?php

require_once (BASEPATH.'..\vendor\autoload.php');

use JansenFelipe\CnpjGratis\CnpjGratis;

class Instituicao extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('instituicao_model');
    $this->load->helper('url_helper');
  }

  public function index() {
    $data['instituicoes'] = $this->instituicao_model->getInstituicao();

    //$this->load->view('templates/header');
    $this->load->view('instituicao/index', $data);
  }

  public function cadastro() {
    $this->load->view('instituicao/cadastro');
  }

  public function instituicaoExiste() {
    $nome = $this->input->post('nome_instituicao');
    $this->db->where("nome", $nome);
    $instituicao = $this->db->get("instituicao")->row_array();
    if($instituicao) {
      echo true;
    } else {
      echo false;
    }
  }

  public function pesquisaCnpj() {
    $dados = CnpjGratis::consulta($_POST['cnpj_instituicao'], $_POST['captcha'], $_POST['cookie']);
    if($dados) {
      echo $dados['nome_fantasia'];
    } else {
      echo false;
    }
  }

  public function cadastrarInstituicao() {
    $this->instituicao_model->setInstituicao();
  }



}
