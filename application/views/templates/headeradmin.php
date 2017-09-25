<!DOCTYPE html>
<html>

<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <title><?= $title; ?></title>
  <!--Import Google Icon Font-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('semantic/dist/semantic.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
  <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="<?php echo base_url('semantic/dist/semantic.min.js'); ?>"></script>
</head>
<body>
  <div class="site">
    <div class="ui sidebar inverted vertical menu">
      <a class="item opcao" data-value="1">
      Escrever uma postagem
      </a>
      <a class="item opcao" data-value="2">
      
      </a>
      <a class="item opcao" data-value="3">
        3
      </a>
    </div>

    <div class="admin-content">
      <div class="ui inverted fixed menu mobile only">
        <div class="ui container">
          <a class="item" onclick="$('.ui.sidebar').sidebar('toggle');">Opções</a>
          <div class="right menu">
            <div class="ui item dropdown">
              <div class="text">
                <?= $_SESSION['usuario_logado']['nome'];?>
              </div>
              <i class="dropdown icon"></i>
              <div class="menu">
                <a href="/codeigniter/logout" class="item">Sair</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="large screen only ui vertical fixed inverted sticky menu top" style="float: left !important; left: 0px; width: 250px !important; height: 100% !important; margin-top: 0px;">
        <div class="item">
          Olá, <?= $_SESSION['usuario_logado']['nome']?>
        </div>
        <div class="item">
        </div>
        <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/gerenciar-posts')?>">Gerenciar postagens</a>
        <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/criar-post')?>">Escrever uma postagem</a>
        <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/editar-grupo')?>">Editar informações do grupo</a>
        <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/solicitacoes-pendentes')?>">Solicitações pendentes <div class="ui label"><?=count($solicitacoes);?></div></a>
        <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/gerenciar-participantes')?>">Gerenciar participantes</a>
      </div>

      <div class="middle-content padding margin">