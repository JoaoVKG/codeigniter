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
                    <select class="ui dropdown input-papel" data-id="<?= $participante['id_usuario']; ?>" data->
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
					<button class="ui negative button remover" <?php echo ($participante['pode_editar_grupo']) ? 'disabled' : '';?> data-id="<?= $participante['id_usuario']; ?>" data-nome="<?= $participante['nome'] . ' ' . $participante['sobrenome']; ?>"><i class="remove icon" style="margin: 0 !important;"></i></button>
				</td>
			</tr>
			<?php endforeach; ?>

		</tbody>
	</table>
</div>

<div class="ui small basic modal transition hidden">
	<div class="ui icon header" id="modal-header">
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
        $('#modal-header').html('<i class="user icon"></i>  Remover ' + nome + ' do grupo?');
        $('.ui.basic.modal').modal('show');
        
    })

	$('.button.ok').click(function() {
		$.ajax({
			type: 'POST',
			url: '<?php echo base_url("index.php/usuario/removeparticipante"); ?>',
			data: {'id_grupo':<?= $grupo['id_grupo']?>, 'id_usuario': id},
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

    $('.input-papel').change(function() {
        var id_usuario = $(this).data('id');
        $.ajax({
			type: 'POST',
			url: '<?php echo base_url("index.php/usuario/atualizaparticipante"); ?>',
			data: {'id_papel': $(this).val(), 'id_grupo':<?= $grupo['id_grupo']?>, 'id_usuario': id_usuario},
			success: function(result) {
				if (result) {
					toastr.options = {
					"closeButton": false,
					"debug": false,
					"newestOnTop": false,
					"progressBar": false,
					"positionClass": "toast-bottom-right",
					"preventDuplicates": false,
					"onclick": null,
					"showDuration": "300",
					"hideDuration": "1000",
					"timeOut": "2500",
					"extendedTimeOut": "1000",
					"showEasing": "swing",
					"hideEasing": "linear",
					"showMethod": "fadeIn",
					"hideMethod": "fadeOut"
					};

					toastr["success"]("Papel alterado.", "Sucesso!");

					
				}		
			}
		})
    })
</script>
