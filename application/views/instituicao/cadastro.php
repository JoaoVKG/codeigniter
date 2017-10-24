<?php
ini_set('max_execution_time', 0); 
ini_set('memory_limit','2048M');
require_once (BASEPATH.'..\vendor\autoload.php');

use JansenFelipe\CnpjGratis\CnpjGratis;

if (isset($_POST['captcha']) && isset($_POST['cookie']) && isset($_POST['cnpj_instituicao'])){
  $dados = CnpjGratis::consulta($_POST['cnpj_instituicao'], $_POST['captcha'], $_POST['cookie']);
} else {
  $params = CnpjGratis::getParams();
}
?>

<?php 
  if ($params):
?>
<div class="field">
  <label>CNPJ da instituição</label>
  <div class="ui left icon input">
    <i class="building icon"></i>
    <input type="text" name="cnpj_instituicao" class="cnpj_instituicao" placeholder="CNPJ da instituição" required/>
  </div>
</div>

<div class="field">
  <label>Captcha</label>
  <div class="ui left icon input">
    <i class="lock icon"></i>
    <input type="text" name="captcha" class="captcha" placeholder="Captcha" required/>
  </div>
</div>
<input type="hidden" name="cookie" class="cookie" value="<?php echo $params['cookie'] ?>" />
<div class="aligner">
  <div class="aligner-item"></div>
  <div class="aligner-item"><img class="ui" src="data:image/png;base64,<?php echo $params['captchaBase64'] ?>"/></div>
  <div class="aligner-item"></div>
</div>
<?php
  else:
?>
  <div class="ui warning message">
    <div class="header">
    Serviço indisponível!
    </div>
    Infelizmente, o site da Receita Federal não está respondendo no momento. Tente novamente mais tarde.
  </div>
<?php
  endif;
?>
<script src="<?php echo base_url('assets/js/jquery.mask.js');?>"></script>
<script>
  $(document).ready(function(){
    $('.cnpj_instituicao').mask('00.000.000/0000-00', {reverse: true});
  });
</script>

