<?php
if(!isset($_SESSION['usuario_logado']['nome'])) {
  redirect('/', 'refresh');
}
if(validation_errors() != '') {
  $class = 'error';
} else {
  $class = '';
}
?>
<div class="site-content margin-top margin-bottom">
  <div class="ui container">

    <div class="ui segment">

      <h4 class="ui dividing header center aligned">Entre em um grupo</h4>
      <table id="tabela_grupos" class="ui celled table" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Grande área</th>
            <th>Área <i class="icon small chevron right"></i>Subárea <i class="icon small chevron right"></i>Especialidade</th>
          </tr>
        </thead>
        <tbody>
          <?php $index = 0; ?>
          <?php foreach ($grupos as $grupo_item): ?>
            <tr>
              <td><a href="grupo/<?php echo $grupo_item['slug'];?>"><?php echo $grupo_item['nome'];?></a></td>

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


    <div class="ui horizontal divider">Ou</div>

    <div class="ui center aligned segment">
      <h4 class="ui dividing header">Cadastre seu grupo</h4>
      <?php
      $attributes = array('class' => "ui form $class");
      echo form_open('gerenciar-grupos', $attributes); ?>
      <div class="field">
        <label class="float-left">Nome do grupo</label>
        <div class="ui left icon input">
          <i class="users icon"></i>
          <input type="text" name="nome" class="nome_grupo" placeholder="Nome do grupo" value="<?= set_value('nome_grupo'); ?>" required/>
        </div>
      </div>
      <div class="field">
        <label class="float-left">Link do grupo</label><i class="float-left large help circle icon" data-variation="very wide" data-html="O link será usado para que as pessoas consigam acessar a página do seu grupo. Ele não pode conter espaços, acentuações e letras maiúsculas. As palavras devem ser separadas por hífen (-).</br></br>Exemplo: nome-do-seu-grupo"></i>
        <div class="ui left icon input">
          <i class="linkify icon"></i>
          <input type="text" name="link" class="link_grupo" placeholder="Link do grupo" value="<?= set_value('link_grupo'); ?>" required/>
        </div>
      </div>
      <div class="field">
        <label class="float-left">Sobre o grupo</label>
        <textarea name="sobre" placeholder="Sobre o grupo" required></textarea>
      </div>
      <div class="two fields">

        <div class="eleven wide field">
          <label class="float-left">Email para contato</label>
          <div class="ui left icon input">
            <i class="mail icon"></i>
            <input type="email" name="email" placeholder="Email para contato" value="<?= set_value('email'); ?>" required/>
          </div>
        </div>

        <div class="five wide field">
          <label class="float-left">Senha da administração</label><i class="float-left large help circle icon" data-html="Essa senha será usada para que você e os outros membros possam acessar a área administrativa do grupo."></i>
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input class="senha" type="password" name="senha" placeholder="Senha da administração" required/>
          </div>
        </div>

      </div>

      <div class="field area">
        <label class="float-left">Área do conhecimento</label>
        <div class="ui left icon input">
          <i class="book icon"></i>
          <input hidden type="text" name="area" class="codigo_area_grupo" placeholder="Área do conhecimento" value="<?= set_value('area'); ?>" required/>
          <input type="text" class="area_grupo" placeholder="Área do conhecimento" value="<?= set_value('area'); ?>" required/>
        </div>
      </div>

      <div class="ui modal area">
        <div class="header">Selecione a área</div>
        <div class="content scrollable">
          <?php $this->load->view('area/index');?>
        </div>
        <div class="actions">
          <div class="float-left ui big label area-selecionada">
            <i class="book icon"></i>
          </div>
          <div class="ui positive right labeled icon button">
            Selecionar
            <i class="checkmark icon"></i>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="float-left">Instituição de ensino</label>
        <div class="ui input search selection dropdown">
          <input type="hidden" name="instituicao" class="input instituicao" required>
          <i class="dropdown icon"></i>
          <div class="default text instituicao">Selecione sua instituição</div>
          <div class="menu instituicoes">
            <?php $this->load->view('instituicao/index');?>
          </div>
        </div>
        <div class="ui message instituicao">
          <a class="ui" class="float-left">Não encontrou sua instituição? Clique aqui para cadastrá-la!</a>
        </div>
      </div>

      <div class="ui form modal instituicao">
        <div class="header">Cadastre uma instituição</div>
        <div class="content instituicoes">
          <!-- echo pagina de cadastro -->
          <?php $this->load->view('instituicao/cadastro');?> 
        </div>
        <div class="actions">
          <div class="ui button cadastro instituicao">
            Cadastrar
          </div>
          <div class="ui positive right labeled icon button">
            Concluir
            <i class="checkmark icon"></i>
          </div>
        </div>
      </div>

      <div class="field">
        <label class="float-left">Cor da página do grupo</label>
        <input type="hidden" name="cor" class="input cor" value="">
        <div class="ui input eleven ui stackable buttons">
          <div class="ui grey basic button cor" data-value="">Padrão<a class="ui right corner label"><i class="checkmark icon"></i></a></div>
          <div class="ui button red cor" data-value="red">Vermelho</div>
          <div class="ui button orange cor" data-value="orange">Laranja</div>
          <div class="ui button yellow cor" data-value="yellow">Amarelo</div>
          <div class="ui button olive cor" data-value="olive">Oliva</div>
          <div class="ui button green cor" data-value="green">Verde</div>
          <div class="ui button teal cor" data-value="teal">Turquesa</div>
          <div class="ui button blue cor" data-value="blue">Azul</div>
          <div class="ui button purple cor" data-value="purple">Roxo</div>
          <div class="ui button pink cor" data-value="pink">Rosa</div>
          <div class="ui button brown cor" data-value="brown">Marrom</div>
        </div>
      </div>

      <div class="field float-left ">
        <label for="posicao_grupo">Qual sua posição no grupo?</label>
        <div class="field float-left">
          <div class="ui radio checkbox">
            <input type="radio" name="posicao_grupo" value="1" checked>
            <label>Líder</label>
          </div>
        </div>
        <div class="field float-left">
          <div class="ui radio checkbox">
            <input type="radio" name="posicao_grupo" value="2">
            <label>Pesquisador</label>
          </div>
        </div>
      </div>

      <button class="ui fluid button grey" type="submit">Cadastrar</button>
      <div class="ui error message">
        <div class="header">Erro</div>
        <?= validation_errors(); ?>
      </div>
      <?= form_close(); ?>
    </div>

  </div>
</div>
<script>
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

$('.ui.checkbox').checkbox();

// escolha de cor
$('.ui.button.cor').on('click', function() {
  $('.ui.button.cor').children().remove();
  $(this).append('<a class="ui right corner label"><i class="checkmark icon"></i></a>');
  $('.input.cor').val($(this).data('value'));
});

// select da instituição
$('.ui.selection.dropdown').dropdown({
  fullTextSearch: true,
  message: {
    noResults: 'Nenhum resultado encontrado.'
  }
});

// desabilitar inputs de cadastro da instituição p funcionamento do cadastro de grupo
$(".cnpj_instituicao").prop('disabled', true);
$(".captcha").prop('disabled', true);

$( ".ui.message.instituicao" ).on("click", function() {
  $('.ui.modal.instituicao').modal({
    onHidden : function() {
      $(".cnpj_instituicao").prop('disabled', true);
      $(".captcha").prop('disabled', true);
      $('.content.instituicoes').load('<?php echo base_url("index.php/instituicao/cadastro"); ?>');
    },
    onVisible : function() {
      $(".cnpj_instituicao").prop('disabled', false);
      $(".captcha").prop('disabled', false);
      $('.ui.modal.instituicao').keypress(function(e) {
        if(e.which == 13) {
          $('.cadastro.instituicao').trigger('click');
        }
      });
    }
  }).modal('show');
});


// botões de ajuda
$('.help.circle').popup({
  delay: {
    show: 0,
    hide: 200
  }
});

//área do conhecimento
var area = [];
$(document).on('click', '.geral li details summary, .geral li', function(e) {
  e.stopPropagation();
  area['tipo'] = $(this).clone().children().remove().end().attr('class');
  area['nome'] = $(this).clone().children().remove().end().text();
  area['codigo'] = $(this).clone().children().remove().end().data('codigo');
  if(area['tipo'] != 'grande_area') {
    var icon = $('.area-selecionada').children();
    $('.area-selecionada').text(area['nome']).prepend(icon);
  } else {
    area['nome'] = '';
  }
});

$( ".field.area" ).on("click focusin", function() {
  $('.ui.modal.area').modal({
    onHidden : function() {
      $('.codigo_area_grupo').val(area['codigo']);
      $('.area_grupo').val(area['nome']);
    }
  }).modal('show');
  $('.area_grupo').trigger('blur');
});


//cadastra uma instituicao
$(".cadastro.instituicao").on("click", function() {
  $(".cadastro.instituicao").prepend('<i class="spinner loading icon"></i>');
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url("index.php/instituicao/pesquisaCnpj"); ?>',
    data: {'cnpj_instituicao':$(".cnpj_instituicao").val(), 'captcha':$(".captcha").val(), 'cookie':$(".cookie").val()},
    statusCode: { 500: function() {
      $('.content.instituicoes').load('<?php echo base_url("index.php/instituicao/cadastro"); ?>', function(){

        $('.ui.form.modal').addClass('error');
        $('.ui.form.modal').removeClass('success');
        erro = '<div class="ui error message cnpj-errado"><div class="header">Erro!</div><p>O CNPJ/captcha está errado.</p></div>';
        $(".cadastro.instituicao").children().remove();
        //verifica se o elemento .existe não existe ainda
        if(!$('.error.message.cnpj-errado').length) {
          $(erro).insertAfter($('.captcha').parent());
        }
        if ($(".cnpj_instituicao").val() == '') {
          $('.ui.form.modal').removeClass('success');
        }
      });

    }},
    success: function(nome_fantasia) {
      if(nome_fantasia) {
        $.ajax({
          type: 'POST',
          url: '<?php echo base_url("index.php/instituicao/instituicaoExiste"); ?>',
          data: {'nome_instituicao': nome_fantasia},
          success: function(result) {
            if(result) {
              $('.ui.form.modal').addClass('error');
              $('.ui.form.modal').removeClass('success');
              erro = '<div class="ui error message existe-instituicao"><div class="header">Erro!</div><p>Essa instituição já foi cadastrada! Verifique novamente a lista de instituições.</p></div>';
              //verifica se o elemento .existe não existe ainda
              if(!$('.error.message.existe-instituicao').length) {
                $(erro).insertAfter($('.cnpj_instituicao').parent());
              }
              if ($(".cnpj_instituicao").val() == '') {
                $('.ui.form.modal').removeClass('success');
              }

            } else {
              $.ajax({
                type: 'POST',
                url: '<?php echo base_url("index.php/instituicao/cadastrarInstituicao"); ?>',
                data: {'nome_instituicao': nome_fantasia},
                success: function(result) {
                  $('.default.text.instituicao').removeClass('default');
                  $('.text.instituicao').text(nome_fantasia);
                  $('.input.instituicao').val(nome_fantasia);
                  $('.nome_instituicao').val('');
                  $('.ui.form.modal').removeClass('error');
                  $('.spinner.loading.icon').remove();
                  $('.ui.form.modal').modal('hide');

                }
              })
            }
          }
        });

      } else {
        $('.ui.form.modal').addClass('error');
        $('.ui.form.modal').removeClass('success');
        erro = '<div class="ui error message existe-instituicao"><div class="header">Erro!</div><p>Essa instituição já foi cadastrada! Verifique novamente a lista de instituições.</p></div>';
        //verifica se o elemento .existe não existe ainda
        if(!$('.error.message.existe-instituicao').length) {
          $(erro).insertAfter($('.nome_instituicao').parent());
        }
        if ($(".nome_instituicao").val() == '') {
          $('.ui.form.modal').removeClass('success');
        }

      }
    }
  });
});

//atualiza a lista de instituições
$(".ui.input.search.selection.dropdown").on("click", function() {
  $('.menu.instituicoes').load('<?php echo base_url("index.php/instituicao/index"); ?>');
});

//verifica se link é único
$(".link_grupo").on("change paste", function() {
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url("index.php/grupos/slugUnico"); ?>',
    data: {'unico':$(".link_grupo").val()},
    success: function(result) {
      if(result) {
        $('form').addClass('loading');
        setTimeout(function(){
          $('form').removeClass('loading');
          $('form').addClass('error');
          $('form').removeClass('success');
          erro = '<div class="ui error message existe"><div class="header">Erro!</div><p>Infelizmente esse link já está sendo usado por outro grupo.</p></div>';
          //verifica se o elemento .existe não existe ainda
          if(!$('.error.message.existe').length) {
            $(erro).insertAfter($('.link_grupo').parent());
          }
          if ($(".link_grupo").val() == '') {
            $('form').removeClass('success');
          }
        }, 350);
      } else {
        $('form').addClass('loading');
        setTimeout(function(){
          $('form').removeClass('loading');
          $('form').addClass('success');
          $('form').removeClass('error');
          sucesso = "<div class='ui success message'><div class='header'>Sucesso!</div><p>Esse link está disponível para uso.</p></div>";
          if(!$('.success.message').length) {
            $(sucesso).insertAfter($('.link_grupo').parent());
          }
          if ($(".link_grupo").val() == '') {
            $('form').removeClass('success');
          }
        }, 350);
      }
    }
  });
});
</script>
<script src="<?php echo base_url('assets/js/slug-generator.js'); ?>"></script>
