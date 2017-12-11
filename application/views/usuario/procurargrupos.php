<div class="site-content margin-top margin-bottom">
  <div class="ui container">

    <div class="ui segment">

      <h4 class="ui dividing header center aligned">Encontre grupos de pesquisa</h4>
      <table id="tabela_grupos" class="ui celled table" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Instituição</th>
          <th>Grande área</th>
          <th>Área <i class="icon small chevron right"></i>Subárea <i class="icon small chevron right"></i>  Especialidade</th>
        </tr>
      </thead>
      <tbody>
        <?php $index = 0; ?>
        <?php foreach ($grupos as $grupo_item): ?>
          <tr>
            <td><a href="<?= base_url("grupo/{$grupo_item['slug']}"); ?>"><?php echo $grupo_item['nome'];?></a></td>

            <td>
              <?php 
              $nome_instituicao;
              foreach ($instituicoes as $instituicao) {
                if ($instituicao['id_instituicao'] == $grupo_item['id_instituicao']) {
                  $nome_instituicao = $instituicao['nome'];
                }
              }
              echo $nome_instituicao;
              ?>
            </td>

            <td><?php echo($area_grupo[$index]['NOME_GRANDE_AREA']);?></td>
            <?php
            $area_subarea_especialidade = $area_grupo[$index]['NOME_AREA'];
            if($area_grupo[$index]['NOME_SUB_AREA'] != NULL) {
              $area_subarea_especialidade .= ' <i class="icon small chevron right"></i>' . $area_grupo[$index]['NOME_SUB_AREA'];
            }
            if($area_grupo[$index]['NOME_ESPECIALIDADE'] != NULL) {
              $area_subarea_especialidade .= ' <i class="icon small chevron right"></i>' . $area_grupo[$index]['NOME_ESPECIALIDADE'];
            }
            ?>

            <td><?php echo $area_subarea_especialidade;?></td>
          </tr>
          <?php $index++; ?>
        <?php endforeach;?>

      </tbody>
    </table>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
  $('#tabela_grupos').DataTable(
    {
      "language": {
        "decimal":        "",
        "emptyTable":     "Nenhum grupo encontrado",
        "info":           "Mostrando _START_ a _END_ de _TOTAL_ grupos",
        "infoEmpty":      "Mostrando 0 a 0 de 0 grupo(s)",
        "infoFiltered":   "(filtrado de _MAX_ grupo(s))",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Quantidade de grupos por página: _MENU_",
        "loadingRecords": "Carregando...",
        "processing":     "Processando...",
        "search":         "Pesquisar:",
        "zeroRecords":    "Nenhum grupo encontrado",
        "paginate": {
          "first":      "Primeiro",
          "last":       "Última",
          "next":       "Próximo",
          "previous":   "Anterior"
        },
        "aria": {
          "sortAscending":  ": activate to sort column ascending",
          "sortDescending": ": activate to sort column descending"
        }
      }
    }
  );

});

</script>