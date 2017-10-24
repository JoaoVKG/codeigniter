<div class="ui container site-content margin-top-grupo margin-bottom">
  <h1 class="ui centered header"><?= $grupo['nome'];?></h1>
  <div class="ui  fluid four item secondary pointing menu">
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
  <div class="ui clearing segment">
    <article class="post ql-editor quill-fix" data-id="<?= $post['id_post']?>">
      <h1 class="ui header"><a href="<?= base_url("grupo/{$grupo['slug']}/post/{$post['id_post']}");?>"><?= $post['titulo']?></a>
        <div class="sub header">Escrito por <?= $post['nome'] . ' ' . $post['sobrenome']?> <p><?= strftime('%A, %d de %B de %Y', strtotime($post['data'])) ?></p></div>
      </h1>
      <?= $post['conteudo'] ?>
    </article>
    <div class="ui divider"></div>
    <div class="float-right">
      <div class="addthis_inline_share_toolbox"></div>
    </div>
  </div>
</div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-59b59ec4298a2909"></script> 