<link type="text/css" rel="stylesheet" href="<?php echo base_url('assets/css/quill.snow.css'); ?>"  media="screen,projection"/>
<script type="text/javascript" src="<?php echo base_url('assets/js/quill.js'); ?>"></script>
<style>
#justHtml:Before {
  color: slategrey;
  font-weight: bold;
  content: "Just Html with root.innerHTML";
}

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

<div class="site-content ui container segment" style="margin: 0px !important;">

  <div class="ui header">Escreva uma postagem</div>
  <?php
  if(validation_errors() != '') {
    $class = 'error';
  } else {
    $class = '';
  }
  $attributes = array('class' => "ui form $class");
  echo form_open('posts/', $attributes); ?>
  <div class="field">
    <input type="text" name="titulo" placeholder="Título" required/>
  </div>
  <div class="field">
    <div id="editor"></div>
  </div>
  <div id="justHtml" class="ql-editor"></div>
  <textarea id="conteudo"></textarea>
  <?= form_close(); ?>

</div>
<script>
var toolbarOptions = [
  [{ 'header': [1, 2, false] }],
  [{ 'font': [] }],
  [{ 'align': [] }],
  ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
  ['image', 'link'],

  [{ 'list': 'ordered'}, { 'list': 'bullet' }],
  [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
  [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
  [{ 'direction': 'rtl' }],                         // text direction
  [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
  ['clean']                                         // remove formatting button
];

var editor = new Quill('#editor', {
  modules: {
    toolbar: toolbarOptions

  },
  placeholder: 'Escreva aqui o conteúdo da postagem',
  theme: 'snow'  // or 'bubble'
});

var justHtmlContent = document.getElementById('justHtml');
var conteudo = document.getElementById('conteudo');

editor.on('text-change', function() {
  var text = editor.getText();
  var justHtml = editor.root.innerHTML;
  justHtmlContent.innerHTML = justHtml;
  conteudo.innerHTML = justHtml;
  console.log(justHtml);
});
</script>
