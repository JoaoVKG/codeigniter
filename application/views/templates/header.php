<!DOCTYPE html>
<html>

<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <title><?= $title; ?></title>

  <link rel="stylesheet" type="text/css" href="<?php echo base_url('semantic/dist/semantic.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.semanticui.min.css'); ?>">
  <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/dataTables.semanticui.min.js'); ?>"></script>
  <script src="<?php echo base_url('semantic/dist/semantic.min.js'); ?>"></script>
  <link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/quill.snow.css'); ?>"  media="screen,projection"/>
  <script type="text/javascript" src="<?php echo base_url('assets/js/quill.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/toastr.min.js'); ?>"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/toastr.min.css'); ?>">
</head>
<body class="site">

  <!-- Following Menu -->
  <div class="ui fixed menu">
    <div class="ui container">
      <?php if(isset($_SESSION['usuario_logado']['nome'])): ?>
        <a class="active item" href="<?php echo base_url('home');?>">Início</a>
      <?php else: ?>
      <a class="active item" href="<?php echo base_url();?>">Início</a>
      <?php endif; ?>

      <?php $url_atual = $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];?>

      <?php if(!isset($_SESSION['usuario_logado']['nome'])): ?>

        <div class="right menu">
          <?php if((strpos($url_atual,'login') === false)): ?>
            <a href="<?php echo base_url('login');?>" class="item entrar" style="border-right: 1px solid rgba(34,36,38,.1)">Entrar</a>
          <?php endif;?>
          <?php if((strpos($url_atual,'cadastro') === false)): ?>
            <a href="<?php echo base_url('cadastro');?>" class="item cadastro" style="border-right: 1px solid rgba(34,36,38,.1)">Cadastro</a>
          <?php endif;?>
        </div>

      <?php else: ?>

        <div class="right menu">
          <div class="ui dropdown item menu-header" style="border-right: 1px solid rgba(34,36,38,.1)">
            <div class="text">
              <?= $_SESSION['usuario_logado']['nome'];?>
            </div>
            <i class="dropdown icon"></i>
            <div class="menu">
              <a href="<?php echo base_url('editar-perfil');?>" class="item"><i class="edit icon"></i> Editar perfil</a>
              <a href="<?php echo base_url('logout');?>" class="item"><i class="sign out icon"></i> Sair</a>
            </div>

          </div>
        </div>

      <?php endif; ?>


    </div>
  </div>

  <!-- Sidebar Menu -->
  <div class="ui vertical inverted sidebar menu" id="side-menu">
    <?php if(isset($_SESSION['usuario_logado']['nome'])): ?>
      <a class="active item" href="<?php echo base_url('home');?>">Início</a>
    <?php else: ?>
      <a class="active item" href="<?php echo base_url();?>">Início</a>
    <?php endif; ?>
    <a class="item">Grupos</a>
    <?php if(!isset($_SESSION['usuario_logado']['nome'])): ?>
      <a class="item">Entrar</a>
      <a class="item">Cadastro</a>
    <?php endif; ?>
  </div>

  <script>
  $('.ui.dropdown').dropdown({
    action: 'nothing'
  });
  </script>
