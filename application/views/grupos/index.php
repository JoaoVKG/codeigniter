<div class="site-content margin-top">
  <div class="ui container">
    <div class="ui center aligned segment">
      <h4 class="ui dividing header">Cadastre seu grupo</h4>
    </div>
    <div class="ui horizontal divider">Ou</div>

    <div class="ui segment">
      <h4 class="ui dividing header center aligned">Entre em um grupo</h4>
      <?php foreach ($grupos as $grupo_item): ?>

        <a href="<?= base_url("grupo/{$grupo['slug']}"); ?>"><?php echo $grupo_item['nome'];?></a>

      <?php endforeach;?>
    </div>

  </div>
</div>
