<div class="ui container site-content margin-top-grupo margin-bottom">
  <h1 class="ui centered header"><?= $grupo['nome'];?></h1>
  <div class="ui fluid four item secondary pointing menu">
    <a href="<?= base_url("grupo/{$grupo['slug']}"); ?>" class="item active">
      Postagens
    </a>
    <a href="<?= base_url("grupo/{$grupo['slug']}/sobre"); ?>" class="item">
      Sobre o grupo
    </a>
    <a href="<?= base_url("grupo/{$grupo['slug']}/participantes"); ?>" class="item">
      Participantes
    </a>
    <a href="<?= base_url("grupo/{$grupo['slug']}/contato"); ?>" class="item">
      Contato
    </a>
  </div>
  <div class="ui icon message">
    <i class="close icon"></i>
    <i class="inbox icon"></i>
    <div class="content">
      <div class="header">
        Marque a caixa abaixo para receber um email quando esse grupo fizer uma nova postagem!
      </div>
      <br>
      <div class="ui checkbox">
        <input type="checkbox" name="receber-email">
        <label>Receber emails</label>
      </div>
    </div>
  </div>
  <script>
    $('.message .close').on('click', function() {
      $(this).closest('.message').transition('fade');
    });
  </script>
  <div class="ui segment posts">
    <?php foreach ($posts as $post) :?>
    <article class="post ql-editor quill-fix" data-id="<?= $post['id_post']?>">
      <h2 class="ui header"><a class="header-post" href="<?= base_url("grupo/{$grupo['slug']}/post/{$post['id_post']}");?>"><?= $post['titulo']?></a>
        <div class="sub header">Escrito por <?= $post['nome'] . ' ' . $post['sobrenome']?> <p><?= strftime('%A, %d de %B de %Y', strtotime($post['data'])) ?></p></div>
      </h2>
      <?= $post['conteudo'] ?>
    </article>
    <div class="ui divider"></div>
    <?php endforeach; ?>
    <div class="ui large centered inline text loader">
      Carregando postagens...
    </div>
  </div>
</div>

<script>
$('.segment.posts').visibility({
  once: false,
  // update size when new content loads
  observeChanges: true,
  // load content on bottom edge visible
  onBottomVisible: function() {
    // loads a max of 5 times
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url("index.php/posts/carregar_posts"); ?>',
      data: {'ultimo_id': $('.post:last').data('id'), 'slug': "<?= $grupo['slug'] ?>"},
      success: function(result) {
        var $segment = $('.segment.posts'),
        $loader = $segment.find('.inline.loader');
        $loader.addClass('active');
        setTimeout(function() {
          $loader.removeClass('active').before(result);
        }, 1000);
      }
    })
  }
});
</script>