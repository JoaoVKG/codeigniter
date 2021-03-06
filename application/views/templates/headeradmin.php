<!DOCTYPE html>
<html>

<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <title><?=$title;?></title>
  <!--Import Google Icon Font-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('semantic/dist/semantic.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/toastr.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
  <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="<?php echo base_url('semantic/dist/semantic.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/toastr.min.js'); ?>"></script>
</head>
<body>
  <div class="site">
    <div class="ui sidebar inverted vertical menu">
      <div class="item"><?=$grupo['nome']?></div>
      <a class="item" href="<?= base_url('home')?>">Voltar para o início</a>
      <div class="item"></div>
      <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/criar-post')?>">Escrever uma postagem</a>
      <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/gerenciar-posts')?>">Gerenciar postagens</a>
      <?php if ($admin):?>
        <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/editar-grupo')?>">Editar informações do grupo</a>
        <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/solicitacoes-pendentes')?>">Solicitações pendentes <div class="ui label"><?=count($solicitacoes);?></div></a>
        <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/gerenciar-participantes')?>">Gerenciar participantes</a>
      <?php endif;?>
      <?php if ($admin) :?>
        <div class="ui fluid negative button delete-btn excluir-grupo" data-nome="<?=$grupo['nome']?>">Excluir grupo</div>
      <?php endif;?>
    </div>

    <div class="admin-content">
      <div class="ui inverted fixed menu mobile tablet only">
        <div class="ui container">
          <a class="item" onclick="$('.ui.sidebar').sidebar('toggle');">Opções</a>
          <div class="right menu">
            <div class="ui item dropdown" id="menu">
              <div class="text">
                <?= $_SESSION['usuario_logado']['nome'];?>
              </div>
              <i class="dropdown icon"></i>
              <div class="menu">
                <a href="<?php echo base_url('home');?>" class="item"><i class="edit icon"></i> Editar perfil</a>
                <a href="<?php echo base_url('logout');?>" class="item"><i class="sign out icon"></i> Sair</a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="tablet or lower hidden ui vertical fixed inverted sticky menu top" style="float: left !important; left: 0px; width: 250px !important; height: 100% !important; margin-top: 0px;">
        <div class="item"><?=$grupo['nome']?></div>
        <div class="item"></div>
        <a class="item" href="<?= base_url('home')?>">Voltar para o início</a>
        <div class="item">
        </div>
        <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/criar-post')?>">Escrever uma postagem</a>
        <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/gerenciar-posts')?>">Gerenciar postagens</a>
        <?php if ($admin):?>
          <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/editar-grupo')?>">Editar informações do grupo</a>
          <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/solicitacoes-pendentes')?>">Solicitações pendentes <div class="ui label"><?=count($solicitacoes);?></div></a>
          <a class="item opcao" href="<?= base_url('grupo/'.$grupo['slug'].'/gerenciar-participantes')?>">Gerenciar participantes</a>
        <?php endif;?>
        <div class="item">
        </div>
        <?php if ($admin) :?>
          <div class="ui fluid negative button delete-btn excluir-grupo" data-nome="<?=$grupo['nome']?>">Excluir grupo</div>
        <?php endif;?>
      </div>

      <div class="ui small basic modal transition hidden" id="modal-excluir">
        <div class="ui icon header" id="modal-header-excluir">
        </div>
        <div class="actions" style="text-align: center !important;">
          <div class="ui red cancel inverted button" id="btn-excluir-grupo">
            <i class="trash icon"></i> Excluir
              </div>
          <div class="ui green ok inverted button">
            <i class="arrow left icon"></i> Voltar
          </div>
        </div>
      </div>
      <?php if ($admin) :?>
        <script>
          var id;
          $('.excluir-grupo').click(function() {
            var nome = $(this).data('nome');
            $('#modal-header-excluir').html('<i class="user icon"></i> Você tem certeza que deseja excluir o grupo ' + nome + '? <br>Essa ação não poderá ser revertida.');
            $('#modal-excluir').modal({
              closable: true
            }).modal('show');
          })

          $('#btn-excluir-grupo').click(function() {
            $.ajax({
              type: 'POST',
              url: '<?php echo base_url("index.php/grupos/excluirgrupo");?>',
              data: {'id_grupo':<?=$grupo['id_grupo']?>},
              success: function(result) {
                if (result) {
                  location.href = "<?=base_url('home');?>";
                }
              }
            })
          })
        </script>
      <?php endif;?>
      <div class="middle-content padding margin">