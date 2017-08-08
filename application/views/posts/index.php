<!--<h2><?php echo $title; ?></h2>-->
<div class="fixed-footer ui main container text">
  <?php foreach ($posts as $post_item): ?>

    <div>
      <?php echo $post_item['conteudo']; ?>
    </div>

  <?php endforeach; ?>
</div>
