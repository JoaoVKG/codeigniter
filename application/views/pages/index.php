<?php
if(isset($_SESSION['usuario_logado'])) {
  redirect('/home', 'refresh');
}
?>
<!DOCTYPE html>
<html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <title>Início</title>
  <!--Import Google Icon Font-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('semantic/dist/semantic.min.css'); ?>">
  <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/hammer.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/jquery.hammer.js'); ?>"></script>
  <script src="<?php echo base_url('semantic/dist/semantic.min.js'); ?>"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/dataTables.semanticui.min.css'); ?>">
  <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/js/dataTables.semanticui.min.js'); ?>"></script>

  <style type="text/css">

  .hidden.menu {
    display: none;
  }

  .masthead.segment {
    min-height: 700px;
    padding: 1em 0em;
  }
  .masthead .logo.item img {
    margin-right: 1em;
  }
  .masthead .ui.menu .ui.button {
    margin-left: 0.5em;
  }
  .masthead h1.ui.header {
    margin-top: 3em;
    margin-bottom: 0em;
    font-size: 4em;
    font-weight: normal;
  }
  .masthead h2 {
    font-size: 1.7em;
    font-weight: normal;
  }

  .ui.vertical.stripe {
    padding: 8em 0em;
  }
  .ui.vertical.stripe h3 {
    font-size: 2em;
  }
  .ui.vertical.stripe .button + h3,
  .ui.vertical.stripe p + h3 {
    margin-top: 3em;
  }
  .ui.vertical.stripe .floated.image {
    clear: both;
  }
  .ui.vertical.stripe p {
    font-size: 1.33em;
  }
  .ui.vertical.stripe .horizontal.divider {
    margin: 3em 0em;
  }

  .quote.stripe.segment {
    padding: 0em;
  }
  .quote.stripe.segment .grid .column {
    padding-top: 5em;
    padding-bottom: 5em;
  }

  .footer.segment {
    padding: 5em 0em;
  }

  .secondary.pointing.menu .toc.item {
    display: none;
  }

  @media only screen and (max-width: 700px) {
    .ui.fixed.menu {
      display: none !important;
    }
    .secondary.pointing.menu .item,
    .secondary.pointing.menu .menu {
      display: none;
    }
    .secondary.pointing.menu .toc.item {
      display: block;
    }
    .masthead.segment {
      min-height: 350px;
    }
    .masthead h1.ui.header {
      font-size: 2em;
      margin-top: 1.5em;
    }
    .masthead h2 {
      margin-top: 0.5em;
      font-size: 1.5em;
    }
  }


  </style>

  <script>
  $(document).ready(function() {

    // fix menu when passed
    $('.masthead').visibility({
      once: false,
      onBottomPassed: function() {
        $('.fixed.menu').transition('fade in');
      },
      onBottomPassedReverse: function() {
        $('.fixed.menu').transition('fade out');
      }
    });

    // create sidebar and attach to menu open
    $('.ui.sidebar').sidebar('attach events', '.toc.item');

  });

  </script>
</head>
<body id="body">



  <!-- Following Menu -->
  <div class="ui large inverted top fixed hidden menu computer only">
    <div class="ui container">
      <a class="item" href="#inicio">Início</a>
      <a class="item" href="#grupos">Grupos</a>
      <div class="right menu">
        <div class="item">
          <a href="<?php echo base_url('login');?>" class="ui inverted button">Entrar</a>
        </div>
        <div class="item">
          <a href="<?php echo base_url('cadastro');?>" class="ui inverted button">Cadastrar-se</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <div class="ui vertical inverted sidebar menu" id="side-menu">
    <a class="active item">Home</a>
    <a class="item">Workbla</a>
    <a class="item">Company</a>
    <a class="item">Careers</a>
    <a class="item">Login</a>
    <a class="item">Signup</a>
  </div>


  <!-- Page Contents -->
  <div class="pusher">
    <div class="ui inverted vertical masthead center aligned segment">

      <div class="ui container">
        <div class="ui large inverted secondary pointing menu" id="inicio">
          <a class="toc item">
            <i class="sidebar icon"></i>
          </a>
          <a class="active item"><i class="home icon"></i>Início</a>
          <a class="item" href="#grupos"><i class="users icon"></i>Grupos</a>
          <div class="right item">
            <a class="ui inverted button" href="login">Entrar</a>
          </div>
        </div>
      </div>
      <div class="ui text container">
        <h1 class="ui inverted header">
          SGCGP
        </h1>
        <h2>Sistema Gerenciador de Conteúdo para Grupos de Pesquisa</h2>
        <a href="cadastro" class="ui inverted huge button">Cadastrar-se</a>
      </div>

    </div>

    <div id="grupos" class="ui vertical stripe segment">
      <div class="ui container">
        <h3 class="ui centered header">Visite as páginas dos grupos já cadastrados!</h3>
        <table id="tabela_grupos" class="ui celled table" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Instituição</th>
              <th>Grande área</th>
              <th>Área <i class="icon small chevron right"></i>Subárea <i class="icon small chevron right"></i>  Especialidade</th>
            </tr>
          </thead>
          <tbody>
            <?php $index = 0; ?>
            <?php foreach ($grupos as $grupo_item): ?>
              <tr>
                <td><a href="<?= base_url("grupo/{$grupo_item['slug']}"); ?>"><?php echo $grupo_item['nome'];?></a></td>

                <td>
                  <?php 
                  $nome_instituicao;
                  foreach ($instituicoes as $instituicao) {
                    if ($instituicao['id_instituicao'] == $grupo_item['id_instituicao']) {
                      $nome_instituicao = $instituicao['nome'];
                    }
                  }
                  echo $nome_instituicao;
                  ?>
                </td>

                <td><?php echo($area_grupo[$index]['NOME_GRANDE_AREA']);?></td>
                <?php
                $area_subarea_especialidade = $area_grupo[$index]['NOME_AREA'];
                if($area_grupo[$index]['NOME_SUB_AREA'] != NULL) {
                  $area_subarea_especialidade .= ' <i class="icon small chevron right"></i>' . $area_grupo[$index]['NOME_SUB_AREA'];
                }
                if($area_grupo[$index]['NOME_ESPECIALIDADE'] != NULL) {
                  $area_subarea_especialidade .= ' <i class="icon small chevron right"></i>' . $area_grupo[$index]['NOME_ESPECIALIDADE'];
                }
                ?>

                <td><?php echo $area_subarea_especialidade;?></td>
              </tr>
              <?php $index++; ?>
            <?php endforeach;?>

          </tbody>
        </table>

      </div>
    </div>


    <footer class="site-footer ui inverted vertical segment footer">
      <div class="ui container">
        <div class="ui relaxed grid stackable three column row">
          <div class="column">
            <h4 class="ui inverted header">Desenvolvido com:</h4>
            <div class="ui inverted link list">
              <a href="https://www.codeigniter.com/" class="item">CodeIgniter</a>
              <a href="https://semantic-ui.com" class="item">Semantic UI</a>
            </div>
          </div>
          <div class="column">

          </div>
          <div class="column">
            <h4 class="ui inverted header">Contato:</h4>
            <div class="ui inverted link list">
              <a href="mailto:joao99vkg@gmail.com" class="item">João Vicente - Desenvolvedor</a>
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>

</body>
<script>

$(function(){
  var corpo = document.getElementById("pusher");

  //Swipe
  Hammer(corpo).on("swiperight", function() {
    $('#side-menu').sidebar('setting', 'transition', 'overlay', 'uncover').sidebar('toggle');
  });

});
$(document).on('click', 'a', function(event){
  //event.preventDefault();

  $('html, body').animate({
    scrollTop: $( $.attr(this, 'href') ).offset().top
  }, 500);
});
$(document).ready(function() {
  $('#tabela_grupos').DataTable(
    {
      "language": {
        "decimal":        "",
        "emptyTable":     "Nenhum grupo encontrado",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ grupos",
        "infoEmpty":      "Mostrando 0 a 0 de 0 grupo(s)",
        "infoFiltered":   "(filtrado de _MAX_ grupo(s))",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Quantidade de grupos por página: _MENU_",
        "loadingRecords": "Carregando...",
        "processing":     "Processando...",
        "search":         "Pesquisar:",
        "zeroRecords":    "Nenhum grupo encontrado",
        "paginate": {
          "first":      "Primeiro",
          "last":       "Última",
          "next":       "Próximo",
          "previous":   "Anterior"
        },
        "aria": {
          "sortAscending":  ": activate to sort column ascending",
          "sortDescending": ": activate to sort column descending"
        }
      }
    }
  );

});
</script>
</html>
