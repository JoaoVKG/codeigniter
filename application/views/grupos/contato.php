<?php
if(validation_errors() != '') {
  $class = 'error';
} else {
  $class = '';
}
?>
<div class="ui container site-content margin-top-grupo margin-bottom">
  <h1 class="ui centered header"><?= $grupo['nome'];?></h1>
  <div class="ui fluid four item secondary pointing menu">
    <a href="<?= base_url("grupo/{$grupo['slug']}"); ?>" class="item">
      Postagens
    </a>
    <a href="<?= base_url("grupo/{$grupo['slug']}/sobre"); ?>" class="item">
      Sobre o grupo
    </a>
    <a href="<?= base_url("grupo/{$grupo['slug']}/participantes"); ?>" class="item">
      Participantes
    </a>
    <a href="<?= base_url("grupo/{$grupo['slug']}/contato"); ?>" class="item active">
      Contato
    </a>
  </div>
  <div class="ui segment">
    <div class="ui dividing header">Entre em contato</div>
    <?php
        $attributes = array('class' => "ui form $class");
        echo form_open("grupo/{$grupo['slug']}/enviar-email-contato", $attributes); ?>

        <?php if(isset($_SESSION['sucesso'])) : ?>
            <div class="ui positive message">
            <div class="header">
            Email enviado com sucesso!
            </div>
            <p>O grupo irá receber seu email em breve.</p>
            </div>
        <?php endif;?>

        <?php
            if(!isset($_SESSION['usuario_logado']['nome'])):
        ?>

        <div class="field">
            <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="nome" placeholder="Nome" value="<?=set_value('nome');?>" required/>
            </div>
        </div>

        <div class="field">
            <div class="ui left icon input">
            <i class="mail icon"></i>
            <input type="email" name="email" placeholder="Email" value="<?=set_value('email');?>" required/>
            </div>
        </div>

        <?php
            endif;
        ?>


        <div class="field">
            <div class="ui left icon input">
            <i class="send icon"></i>
            <input type="text" name="assunto" placeholder="Assunto" value="<?=set_value('assunto');?>" required/>
            </div>
        </div>

        <div class="field">
            <textarea name="mensagem" id="msg" required><?=set_value('mensagem');?></textarea>
        </div>

      <button class="ui fluid button grey" type="submit">Enviar email</button>

      <?= form_close(); ?>
  </div>
</div>
