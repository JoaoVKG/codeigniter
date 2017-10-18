<div class="ui container site-content margin-top-grupo margin-bottom">
  <h1 class="ui centered header"><?= $grupo['nome'];?></h1>
  <div class="ui fluid four item secondary pointing menu">
    <a href="<?= base_url("grupo/{$grupo['slug']}"); ?>" class="item">
      Postagens
    </a>
    <a href="<?= base_url("grupo/{$grupo['slug']}/sobre"); ?>" class="item">
      Sobre o grupo
    </a>
    <a href="<?= base_url("grupo/{$grupo['slug']}/participantes"); ?>" class="item active">
      Participantes
    </a>
    <a href="<?= base_url("grupo/{$grupo['slug']}/contato"); ?>" class="item">
      Contato
    </a>
  </div>
  <div class="ui segment">
    <table class="ui unstackable celled two column table">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Papel</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($participantes as $participante): ?>

          <tr>
            <td>
              <?php echo $participante['nome'] . ' ' . $participante['sobrenome']; ?>
            </td>
            <td>
              <?php echo $participante['papel']; ?>
            </td>
          </tr>

        <?php endforeach; ?>
      </tbody>

    </table>

  </div>
</div>
