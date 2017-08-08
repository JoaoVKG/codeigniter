<div class="ui container site-content margin-top-grupo margin-bottom">
<h1 class="ui centered header"><?= $grupo['nome'];?></h1>
<div class="ui stackable fluid three item secondary pointing menu">
  <a href="<?= base_url("grupo/{$grupo['slug']}"); ?>" class="item active">
    Postagens
  </a>
  <a href="<?= base_url("grupo/{$grupo['slug']}/sobre"); ?>" class="item">
    Sobre o grupo
  </a>
  <a href="<?= base_url("grupo/{$grupo['slug']}/participantes"); ?>" class="item">
    Participantes
  </a>
</div>
<div class="ui segment">

</div>
</div>
