<div class="admin-edit-content ui container segment" style="margin: 0px !important;">
	<div class="ui header">Editar informações do grupo</div>
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

      <form class="ui form <?=$class?>">
      <div class="field">
        <label class="float-left">Nome do grupo</label>
        <div class="ui left icon input">
          <i class="users icon"></i>
          <input type="text" name="nome" class="nome_grupo" placeholder="Nome do grupo" value="<?=$grupo['nome']?>" required/>
        </div>
      </div>
      <div class="field">
        <label class="float-left">Link do grupo</label><i class="float-left large help circle icon" data-variation="very wide" data-html="O link será usado para que as pessoas consigam acessar a página do seu grupo. Ele não pode conter espaços, acentuações e letras maiúsculas. As palavras devem ser separadas por hífen (-).</br></br>Exemplo: nome-do-seu-grupo"></i>
        <div class="ui left icon input">
          <i class="linkify icon"></i>
          <input type="text" name="link" class="link_grupo" placeholder="Link do grupo" value="<?=$grupo['slug']?>" required/>
        </div>
        <div class="ui success message" id="mensagem-link"></div>
      </div>
      
      <div class="field">
        <label class="float-left">Sobre o grupo</label>
        <textarea name="sobre" class="sobre_grupo" placeholder="Sobre o grupo" required><?=$grupo['sobre']?></textarea>
      </div>

      <div class="field">
        <label class="float-left">Email para contato</label>
        <div class="ui left icon input">
          <i class="mail icon"></i>
          <input type="email" name="email" class="email_grupo" placeholder="Email para contato" value="<?=$grupo['email_contato']?>" required/>
        </div>
      </div>

      <div class="field area">
        <label class="float-left">Área do conhecimento</label>
        <div class="ui left icon input">
          <i class="book icon"></i>
          <input hidden type="text" name="area" class="codigo_area_grupo" placeholder="Área do conhecimento" value="<?=$grupo['area']?>" required/>
          <input type="text" class="area_grupo" placeholder="Área do conhecimento" required/>
        </div>
      </div>
      <script>
        var area = [];
        $(document).ready(function() {
          var id_area = $('.codigo_area_grupo').val();
          $('summary').each(function() {
            if($(this).data('codigo') == id_area) {
              $('.area_grupo').val($(this).text());
              area['codigo'] = id_area;
              area['nome'] = $(this).text();
            }
          })
        })
      </script>

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
        <div class="ui search selection dropdown">
          <input type="hidden" name="instituicao" class="input instituicao" value="<?=$grupo['id_instituicao']?>" required>
          <i class="dropdown icon"></i>
          <div class="text instituicao"></div>
          <div class="menu instituicoes">
            <?php $this->load->view('instituicao/index');?>
          </div>
        </div>
        <script>
          $(document).ready(function() {
            var id_instituicao = $('.input.instituicao').val();
            $('.item.instituicao').each(function() {
              if($(this).data('id') == id_instituicao) {
                $('.text.instituicao').text($(this).data('value'));
              }
            })
            $('.ui.search.selection.dropdown').change(function() {
              var nome_instituicao = $('.input.instituicao').val();
              $('.item.instituicao').each(function() {
                if($(this).data('value') == nome_instituicao) {
                  $('.input.instituicao').val($(this).data('id'));
                }
              })
            })
          })
        </script>
        <div class="ui message instituicao" style="text-align: center !important">
          <a class="ui">Não encontrou sua instituição? Clique aqui para cadastrá-la!</a>
        </div>
      </div>

      <div class="ui form warning modal instituicao">
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
        <input type="hidden" name="cor" class="input cor" value="<?=$grupo['cor_primaria']?>">
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
      <script>
        $(document).ready(function() {
          var cor_primaria = $('.input.cor').val();
          $('.button.cor').each(function() {
            $(this).children().remove();
            if($(this).data('value') == cor_primaria) {
              $(this).append('<a class="ui right corner label"><i class="checkmark icon"></i></a>');
              $('.input.cor').val($(this).data('value'));
            }
          })
        })
      </script>
      <button class="ui fluid button grey" id="update_grupo" type="button">Atualizar</button>
      <div class="ui error message">
        <div class="header">Erro</div>
        <?= validation_errors(); ?>
      </div>
      </form>


<script>
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
      $('.content.instituicoes').load('<?php echo base_url("index.php/instituicao/cadastro"); ?>');
      $(".cnpj_instituicao").prop('disabled', true);
      $(".captcha").prop('disabled', true);
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
  $(this).prepend('<i class="spinner loading icon"></i>');
  $(this).addClass('disabled');
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
        $('.cadastro.instituicao').removeClass('disabled');
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
                  $('.input.instituicao').val(result);
                  $('.nome_instituicao').val('');
                  $('.ui.form.modal').removeClass('error');
                  $('.spinner.loading.icon').remove();
                  $('.cadastro.instituicao').removeClass('disabled');
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
      if ("<?=$grupo['slug']?>" == $(".link_grupo").val()) {
        $('form').addClass('loading');
          setTimeout(function(){
            $('form').removeClass('loading');
            $('form').addClass('success');
            $('form').removeClass('error');
            sucesso = "<div class='header'>Sucesso!</div><p>Esse link é o mesmo que estava sendo utilizado e está disponível para uso.</p>";
            $('#mensagem-link').addClass('success');
            $('#mensagem-link').removeClass('error');
            $('#mensagem-link').html(sucesso);
            if ($(".link_grupo").val() == '') {
              $('form').removeClass('success');
            }
          }, 350);
      }
      else {
        if(result) {
          $('form').addClass('loading');
          setTimeout(function(){
            $('form').removeClass('loading');
            $('form').addClass('error');
            $('form').removeClass('success');
            erro = '<div class="header">Erro!</div><p>Infelizmente esse link já está sendo usado por outro grupo.</p>';
            $('#mensagem-link').addClass('error');
            $('#mensagem-link').removeClass('success');
            $('#mensagem-link').html(erro);
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
            sucesso = "<div class='header'>Sucesso!</div><p>Esse link está disponível para uso.</p>";
            $('#mensagem-link').addClass('success');
            $('#mensagem-link').removeClass('error');
            $('#mensagem-link').html(sucesso);
            if ($(".link_grupo").val() == '') {
              $('form').removeClass('success');
            }
          }, 350);
        }
      }
    }
  });
});

$('#update_grupo').click(function() {
  $.ajax({
    type: 'POST',
    url: '<?php echo base_url("index.php/grupos/atualiza"); ?>',
    data: {
      'id_grupo': <?= $grupo['id_grupo']?>,
      'nome_grupo': $('.nome_grupo').val(),
      'link_grupo': $('.link_grupo').val(),
      'sobre_grupo': $('.sobre_grupo').val(),
      'email_grupo': $('.email_grupo').val(),
      'area_grupo': $('.codigo_area_grupo').val(),
      'instituicao_grupo': $('.input.instituicao').val(),
      'cor_grupo': $('.input.cor').val()
    },
    success: function(result) {
      if (result) {
        window.location.href = '<?=base_url("grupo");?>' + '/' + result + '/editar-grupo';
      }
    }
  });
})

</script>
<script src="<?php echo base_url('assets/js/slug-generator.js'); ?>"></script>

