<?php
require_once (BASEPATH.'..\vendor\autoload.php');

use JansenFelipe\CnpjGratis\CnpjGratis;

if (isset($_POST['captcha']) && isset($_POST['cookie']) && isset($_POST['cnpj_instituicao'])){
  $dados = CnpjGratis::consulta($_POST['cnpj_instituicao'], $_POST['captcha'], $_POST['cookie']);
} else {
  $params = CnpjGratis::getParams();
}
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
  <div class="aligner-item"><img class="ui" src="data:image/png;base64,<?php echo $params['captchaBase64'] ?>" /></div>
  <div class="aligner-item"></div>
</div>
