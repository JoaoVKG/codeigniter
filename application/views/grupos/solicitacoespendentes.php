<div class="admin-content ui container segment" style="margin: 0px !important;">
	<div class="ui header">Solicitações pendentes</div>
	<table class="ui very basic celled table unstackable">
		<thead>
			<tr>
				<th>Nome do pesquisador</th>
				<th>Email</th>
				<th>Solicitação</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($solicitacoes as $solicitacao) : ?>
			<tr>
				<td>
					<?= $solicitacao['nome'] . ' ' . $solicitacao['sobrenome']; ?>
				</td>
				<td>
					<?= $solicitacao['email']; ?>
				</td>
				<td class="collapsing center aligned">
					<button class="ui button aprovar" data-id="<?= $solicitacao['id_usuario']; ?>" data-nome="<?= $solicitacao['nome'] . ' ' . $solicitacao['sobrenome']; ?>">Aprovar</button>
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
