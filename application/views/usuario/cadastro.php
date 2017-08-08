<?php
if(isset($_SESSION['usuario_logado']['nome'])) {
  redirect('/', 'refresh');
}
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
      echo form_open('cadastro', $attributes); ?>
      <h4 class="ui dividing header">Faça seu cadastro</h4>
      <div class="two fields">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="nome" placeholder="Nome" value="<?= set_value('nome'); ?>" required/>
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="sobrenome" placeholder="Sobrenome" value="<?= set_value('sobrenome'); ?>" required/>
          </div>
        </div>
      </div>

      <div class="field">
        <div class="ui left icon input">
          <i class="mail icon"></i>
          <input type="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>" required/>
        </div>
      </div>
      <div class="field">
        <div class="ui left icon input">
          <i class="lock icon"></i>
          <input type="password" name="senha" placeholder="Senha" required/>
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
