<script type="text/javascript" src="<?php echo base_url('assets/js/highlight.pack.js'); ?>"></script>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/quill.snow.css'); ?>"  media="screen,projection"/>
<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/monokai-sublime.css'); ?>"/>
<script type="text/javascript" src="<?php echo base_url('assets/js/quill.js'); ?>"></script>
<style>

/* Add you own css or copy it from the theme stylesheet
*/
#justHtml {
  font-family: Helvetica, Arial, sans-serif;
  font-size: 13px;
  margin: 0px;
  padding: 20px;
  height: 120px;
  background-color: white;
  border-radius: 5px;
  overflow: auto;
  border: 10px solid white;
  margin-top:10px;
}

#editor {
  height: 350px;
}

</style>

<div class="admin-content ui container segment" style="margin: 0px !important;">
  <div class="ui header">Editar postagem</div>
  <?php
  if(validation_errors() != '') {
    $class = 'error';
  } else {
    $class = '';
  }
  ?>
  <form class="ui form <?=$class?>">
  <?php if(isset($_SESSION['sucesso'])) : ?>
    <div class="ui positive message">
      <div class="header">
      Postagem atualizada com sucesso!
      </div>
      <p>Sua postagem está disponível para que outras pessoas possam lê-la.</p>
      <p>
      Você pode acessar ela por esse <a href="<?= base_url('grupo/'.$grupo['slug'].'/post/'.$post['id_post'])?>">link</a>.
      </p>
    </div>
  <?php endif;?>
  <div class="field">
    <input type="text" id="titulo" name="titulo" placeholder="Título" value="<?=$post['titulo']?>" required/>
  </div>
  <div class="field">
    <input type="date" id="data" name="data" placeholder="Data da postagem" value="<?=$post['data']?>" required/>
  </div>
  <div class="field">
    <div id="editor"><?=$post['conteudo']?></div>
  </div>
  <textarea id="conteudo" name="conteudo" hidden></textarea>
  <div class="ui error message"></div>
  <button type="button" id="btn-editar" class="ui grey button fluid">Editar</button>

  </form>

</div>
<script>
var toolbarOptions = [
  [{ 'header': [1, 2, false] }],
  [{ 'font': [] }],
  [{ 'align': [] }],
  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  ['image', 'link'],
  ['code-block'],
  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  [{ 'direction': 'rtl' }],                         // text direction
  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  ['clean']                                         // remove formatting button
];

var editor = new Quill('#editor', {
  modules: {
    syntax: true,
    toolbar: toolbarOptions

  },
  placeholder: 'Escreva aqui o conteúdo da postagem',
  theme: 'snow'  // or 'bubble'
});


var conteudo = document.getElementById('conteudo');
var justHtml;

editor.on('text-change', function() {
    justHtml = editor.root.innerHTML;
    conteudo.innerHTML = justHtml;
    var length = editor.getLength();
    console.log(length);
  // console.log(justHtml);
});

$(document).ready(function() {
    justHtml = editor.root.innerHTML;
    conteudo.innerHTML = justHtml;
})

$.fn.form.settings.rules.isConteudoEmpty = function() {
  if (editor.getLength() == 1) {
    return false;
  } else {
    return true;
  }
};
$('.ui.form').form({
  fields: {
    conteudo: {
      identifier: 'conteudo',
      rules: [
        {
          type: 'isConteudoEmpty',
          prompt: 'O conteúdo não pode ser vazio.'
        }
      ]
    },
    titulo: {
      identifier: 'titulo',
      rules: [
        {
          type: 'empty',
          prompt: 'O título não pode ser vazio.'
        }
      ]
    }
  }
});

$('#btn-editar').click(function() {
    var id_post = <?=$post['id_post']?>;
    var titulo_post = $("#titulo").val();
    var data_post = $("#data").val();
    var conteudo_post = justHtml;
    $.ajax({
        type: 'POST',
        url: '<?php echo base_url("index.php/posts/editarPostagem"); ?>',
        data: {
            'id_post': id_post,
            'titulo': titulo_post,
            'data': data_post,
            'conteudo': conteudo_post   
        },
        success: function(result) {
            if (result) {
                location.reload();
            }
        }	
    })
})

</script>
