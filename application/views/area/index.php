<style>
ul {
  list-style-type: none;
}
</style>
<script src="<?php echo base_url('assets/js/details-element-polyfill.js'); ?>"></script>
<ul class="geral">
  <?php foreach ($areas as $grande_area): ?>
    <?php
    if($grande_area['NUMERO_NIVEL'] == 1) {

      echo '<li class="grande_area"><details><summary class="grande_area"><i class="book icon"></i>'.$grande_area['NOME_GRANDE_AREA'].'</summary>';
      echo '<ul class="areas">';

      foreach ($areas as $area) {
        if($area['NUMERO_NIVEL'] == 2 && $grande_area['CODIGO_AREA_CONHECIMENTO'] == $area['CODIGO_GRANDE_AREA']) {

          echo '<li class="area"><details><summary class="area" data-codigo='.$area['CODIGO_AREA_CONHECIMENTO'].'><i class="book icon"></i>'.$area['NOME_AREA'].'</summary>';
          echo '<ul class="sub_areas">';

          foreach ($areas as $sub_area) {
            if($sub_area['NUMERO_NIVEL'] == 3 && $area['CODIGO_AREA_CONHECIMENTO'] == $sub_area['CODIGO_AREA']) {

              echo '<li class="sub_area"><details><summary class="sub_area" data-codigo='.$sub_area['CODIGO_AREA_CONHECIMENTO'].'><i class="book icon"></i>'.$sub_area['NOME_SUB_AREA'].'</summary>';
              echo '<ul class="especialidades">';

              foreach ($areas as $especialidade) {
                if($especialidade['NUMERO_NIVEL'] == 4 && $sub_area['CODIGO_AREA_CONHECIMENTO'] == $especialidade['CODIGO_SUB_AREA']) {

                  echo '<li class="especialidade" data-codigo='.$especialidade['CODIGO_AREA_CONHECIMENTO'].'><i class="grey book icon"></i>'.$especialidade['NOME_ESPECIALIDADE'];

                }
              }
              echo '</ul>';
              echo '</details>';
            }
          }
          echo '</ul>';
          echo '</details>';
        }
      }
      echo '</ul>';
      echo '</details>';

    }
    ?>
  <?php endforeach;?>
</ul>
