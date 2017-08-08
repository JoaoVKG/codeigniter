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
  max-width: 450px;
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
      echo form_open('login', $attributes); ?>
      <h4 class="ui dividing header">Acesse sua conta</h4>
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
      <button class="ui fluid button grey" type="submit">Login</button>
      <div class="ui error message">
        <div class="header">Erro</div>
        <?= validation_errors(); ?>
      </div>
      <?= form_close(); ?>
    </div>


  </div>
</div>
