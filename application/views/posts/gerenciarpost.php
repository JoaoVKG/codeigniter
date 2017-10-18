<div class="admin-content ui container segment" style="margin: 0px !important;">
	<div class="ui header">Gerenciar postagens</div>
    <table class="ui very basic celled table unstackable">
		<thead>
			<tr>
				<th>Título</th>
                <th>Autor</th>
				<th>Editar</th>
                <th>Remover do grupo</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($posts as $post) :?>
                <tr>
                    <td>
                        <?=$post['titulo'];?>
                    </td>

                    <td class="collapsing">
                        <?=$post['nome'] . ' ' . $post['sobrenome'];?>
                    </td>
                    
                    <td class="collapsing center aligned">
                        <button class="ui button editar" data-id="<?= $post['id_post']; ?>" data-nome="<?=$post['titulo'];?>" data-conteudo="<?=$post['conteudo'];?>"><i class="pencil icon" style="margin: 0 !important;"></i></button>
                    </td>
                    
                    <td class="collapsing center aligned">
                        <button class="ui negative button remover" data-id="<?= $post['id_post']; ?>" data-nome="<?=$post['titulo'];?>"><i class="remove icon" style="margin: 0 !important;"></i></button></button>
                    </td>
                </tr>
            <?php endforeach;?>
		</tbody>
	</table>
</div>

<div class="ui small basic modal delete transition hidden">
	<div class="ui icon header" id="modal-header-delete">
	</div>
	<div class="actions" style="text-align: center !important;">
		<div class="ui red cancel inverted button">
			<i class="remove icon"></i> Não
        </div>
		<div class="ui green ok inverted button">
			<i class="checkmark icon"></i> Sim
		</div>
	</div>
</div>

<script>
    var id;
    $('.button.remover').click(function() {
        id = $(this).data('id');
        var nome = $(this).data('nome');
        $('#modal-header-delete').html('<i class="trash icon"></i>  Remover a postagem com o título ' + nome +'?');
        $('.ui.basic.modal.delete').modal('show');
    })

	$('.button.ok').click(function() {
        $.ajax({
			type: 'POST',
			url: '<?php echo base_url("index.php/posts/deletarpost"); ?>',
			data: {'id_post': id},
			success: function(result) {
                if (result) {
                    location.reload();
				}
			}
			
		})
	})

    $('.button.cancel').click(function() {
        $('.ui.basic.modal').modal('close');
    })

    $('.button.editar').click(function() {
        id = $(this).data('id');
        window.location.href = "editar-post/" + id;
    })
</script>