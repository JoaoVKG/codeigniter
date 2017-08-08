<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('usuario_model');
    $this->load->helper('url_helper');
  }

  public function index() {
    $data['title'] = 'Início';
    $this->load->view('templates/header', $data);
    $this->load->view('usuario/index');
    $this->load->view('templates/footer');
  }

  public function cadastro() {
    $this->load->library('form_validation');
    $data['title'] = 'Cadastro';

    $this->form_validation->set_rules('nome', 'nome', 'required');
    $this->form_validation->set_rules('sobrenome', 'sobrenome', 'required');
    $this->form_validation->set_rules('email', 'email', 'required|valid_email|is_unique[usuario.email]', array('is_unique' => 'Esse %s já está cadastrado.'));
    $this->form_validation->set_rules('senha', 'senha', 'required');

    if($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('usuario/cadastro');
    } else {
      $cadastrado = $this->usuario_model->setusuario();
      if($cadastrado) {
        $usuario = $this->usuario_model->getUsuarioByEmail();
        $this->session->set_userdata("usuario_logado", $usuario);
        redirect('primeiros-passos', 'refresh');
      }  else {
        $this->load->view('templates/header', $data);
        $this->load->view('usuario/cadastro');
      }
    }
  }

  public function login() {
    $this->load->library('form_validation');
    $data['title'] = 'Login';

    $this->form_validation->set_rules('email', 'email', 'required|valid_email');
    $this->form_validation->set_rules('senha', 'senha', 'required|callback_check_email_senha');

    if($this->form_validation->run() === FALSE) {
      $this->load->view('templates/header', $data);
      $this->load->view('usuario/login');
    } else {
      $usuario = $this->usuario_model->getUsuarioByEmail();
      $this->session->set_userdata("usuario_logado", $usuario);
      redirect('home', 'refresh');
    }
  }

  public function check_email_senha() {
    $usuario = $this->usuario_model->getUsuarioByEmail();
    $email = $usuario['email'];
    $senhaHash = $usuario['senha'];
    $senha = $this->input->post('senha');
    if($usuario && password_verify($senha, $senhaHash)) {
      return TRUE;
    } else {
      $this->form_validation->set_message('check_email_senha', 'Email ou senha inválidos!');
    }
    return FALSE;
  }



  public function logout() {
    $user_data = $this->session->all_userdata();
    foreach ($user_data as $key => $value) {
      if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
        $this->session->unset_userdata($key);
      }
    }
    $this->session->sess_destroy();
    redirect('/', 'refresh');
  }


}
