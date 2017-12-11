<?php
if(validation_errors() != '') {
  $class = 'error';
} else {
  $class = '';
}
?>
<style>

body > .grid {
  height: 100%;
}

.column {
  max-width: 750px;
}

.ui.grid {
  margin-bottom: 0 !important;
  margin-left: 0 !important;
  margin-right: 0 !important;
}
</style>
<div class="ui middle aligned center aligned grid">
  <div class="column">

    <div class="ui segment">
      <?php
      $attributes = array('class' => "ui form $class");
      echo form_open('editar-perfil', $attributes); ?>
      <h4 class="ui dividing header">Editar perfil</h4>
      <div class="two fields">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="nome" placeholder="Nome" value="<?=$usuario['nome']?>" required/>
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="sobrenome" placeholder="Sobrenome" value="<?=$usuario['sobrenome']?>" required/>
          </div>
        </div>
      </div>

      <div class="field">
        <div class="ui left icon input">
          <i class="mail icon"></i>
          <input type="email" name="email" placeholder="Email" value="<?=$usuario['email']?>" required/>
        </div>
      </div>
      <div id="change-pass" class="ui message" style="text-align: center !important; cursor: pointer">
        <a class="ui">Clique aqui para alterar sua senha</a>
      </div>
      <div class="field" id="field_senha" hidden>
        <div class="ui left icon input">
          <i class="lock icon"></i>
          <input type="password" name="senha" placeholder="Nova senha"/>
        </div>
      </div>
      <button class="ui fluid button grey" type="submit">Editar</button>
      <div class="ui error message">
        <div class="header">Erro</div>
        <?= validation_errors(); ?>
      </div>
      <?= form_close(); ?>
    </div>


  </div>
</div>
<script>
  $('#change-pass').click(function() {
    $('#field_senha').toggle();
  })
</script>