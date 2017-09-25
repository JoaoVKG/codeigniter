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
  <div class="ui header">Escreva uma postagem</div>
  <?php
  if(validation_errors() != '') {
    $class = 'error';
  } else {
    $class = '';
  }
  $attributes = array('class' => "ui form $class");
  echo form_open("grupo/{$grupo['slug']}/criar-post", $attributes); ?>
  <?php if(isset($_SESSION['sucesso'])) : ?>
    <div class="ui positive message">
      <div class="header">
      Postagem feita com sucesso!
      </div>
      <p>Sua postagem está disponível para que outras pessoas possam lê-la.</p>
      <p>
      Você pode acessar ela por esse <a href="">link</a>.
      </p>
    </div>
  <?php endif;?>
  <div class="field">
    <input type="text" name="titulo" placeholder="Título" required/>
  </div>
  <div class="field">
    <div id="editor"></div>
  </div>
  <textarea id="conteudo" name="conteudo" hidden></textarea>
  <div class="ui error message"></div>
  <button type="submit" class="ui button fluid">Postar</button>

  <?= form_close(); ?>

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

editor.on('text-change', function() {
  var justHtml = editor.root.innerHTML;
  conteudo.innerHTML = justHtml;
  var length = editor.getLength();
  console.log(length);
  // console.log(justHtml);
});

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

</script>
