<div class="ui container site-content margin-top-grupo margin-bottom">
  <h1 class="ui centered header"><?= $grupo['nome'];?></h1>
  <div class="ui fluid four item secondary pointing menu">
    <a href="../<?= $grupo['slug'];?>" class="item">
      Postagens
    </a>
    <a class="item active">
      Sobre o grupo
    </a>
    <a href="../<?= $grupo['slug'];?>/participantes" class="item">
      Participantes
    </a>
    <a href="<?= base_url("grupo/{$grupo['slug']}/contato"); ?>" class="item">
      Contato
    </a>
  </div>
  <div class="ui segment">
    <div class="sobre">
      <?= $grupo['sobre'];?>
    </div>
  </div>
</div>
