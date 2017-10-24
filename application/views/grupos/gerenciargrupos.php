<div class="ui container site-content margin-top-grupo margin-bottom">
  <h1 class="ui centered header"><?= $title;?></h1>
    <?php if ($grupos) :?>
    <div class="ui segment">
      <table class="ui celled three column structured table unstackable">
        <thead>
          <tr>
            <th>Grupo</th>
            <th colspan="2" class="center aligned">Ações</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($grupos as $grupo): ?>

            <tr>
              <td <?php if ($grupo['pode_editar_grupo']): ?>rowspan="2"<?php endif; ?>>
                <?php echo $grupo['nome'];?>
              </td>
              <td>
                <a href="<?= base_url("grupo/{$grupo['slug']}/criar-post"); ?>"><i class="write icon"></i> Escrever postagem</a> 
              </td>
              <td>
                <a href="<?= base_url("grupo/{$grupo['slug']}/gerenciar-posts"); ?>"><i class="settings icon"></i> Gerenciar postagens</a> 
              </td>
            </tr>

            <?php if ($grupo['pode_editar_grupo']): ?>
            <tr>
              <td>
                <a href="<?= base_url("grupo/{$grupo['slug']}/editar-grupo"); ?>"><i class="settings icon"></i> Gerenciar grupo</a> 
              </td>
              <td>
                <a href="<?= base_url("grupo/{$grupo['slug']}/solicitacoes-pendentes"); ?>"><i class="users icon"></i> Solicitações pendentes</a> 
              </td>
            </tr>
            <?php endif; ?>
          <?php endforeach; ?>
        </tbody>

      </table>
    </div>
    <?php else:?>
    <div class="ui segment container text">
      <p>Você não possui nenhum grupo para gerenciar!</p>
    </div>
    <?php endif;?>

  
</div>
