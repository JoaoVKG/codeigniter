<div class="admin-content ui container segment" style="margin: 0px !important;">
	<div class="ui header">Gerenciar participantes</div>
	<table class="ui very basic celled table unstackable">
		<thead>
			<tr>
				<th>Nome do pesquisador</th>
				<th>Email</th>
				<th>Papel</th>
                <th>Remover do grupo</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($participantes as $participante) : ?>
			<tr>
				<td>
					<?= $participante['nome'] . ' ' . $participante['sobrenome']; ?>
				</td>
				<td>
					<?= $participante['email']; ?>
				</td>
				<td class="collapsing">
                    <select class="ui dropdown">
                        <option value="">Papel'</option>
                        <?php if($participante['id_papel'] == 1):?>
                            <option selected value="1">Líder</option>
                            <option value="2">Pesquisador</option>
                        <?php else: ?>
                            <option value="1">Líder</option>
                            <option selected value="2">Pesquisador</option>
                        <?php endif;?>
                    </select>
                </td>
                <td class="collapsing center aligned">
					<button class="ui negative button remover" data-id="<?= $participante['id_usuario']; ?>" data-nome="<?= $participante['nome'] . ' ' . $participante['sobrenome']; ?>">Aprovar</button>
				</td>
			</tr>
			<?php endforeach; ?>

		</tbody>
	</table>
</div>

<div class="ui small basic aprovar modal transition hidden">
	<div class="ui icon header" id="modal-header">
	</div>
	<div class="actions" style="text-align: center !important;">
		<button href="" class="ui red cancel inverted button">
			<i class="remove icon"></i> Não
        </button>
		<button class="ui green ok inverted button">
			<i class="checkmark icon"></i> Sim
		</button>
	</div>
</div>

<script>
	var id;
    $('.button.aprovar').click(function() {
        id = $(this).data('id');
        var nome = $(this).data('nome');
        $('#modal-header').html('<i class="user icon"></i>  Aprovar ' + nome + '?');
        $('.ui.basic.aprovar.modal').modal('show');
    })

	$('.button.ok').click(function() {
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url("index.php/usuario/aceitarsolicitacao"); ?>',
			data: {'id_grupo':<?= $grupo['id_grupo']?>, 'id_usuario': id},
			success: function(result) {
				if (result) {
					location.reload();
				}
			}
			
		})
	})

	$('.button.cancel').click(function() {
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url("index.php/usuario/recusarsolicitacao"); ?>',
			data: {'id_grupo':<?= $grupo['id_grupo']?>, 'id_usuario': id},
			success: function(result) {
				if (result) {
					location.reload();
				}
			}
			
		})
	})
</script>
