<?php foreach ($instituicoes as $instituicao): ?>
<div class="item instituicao" data-id="<?php echo $instituicao['id_instituicao'];?>" data-value="<?php echo $instituicao['nome'];?>"></i><?php echo $instituicao['nome'];?></div>
<?php endforeach; ?>
