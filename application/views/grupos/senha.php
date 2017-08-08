<?php
if(!isset($_SESSION['usuario_logado']) || is_null($esta_no_grupo['aprovado']) || !$esta_no_grupo['aprovado']) {
  redirect('/grupo/'.$grupo['slug'], 'refresh');
}

if(validation_errors() != '') {
  $class = 'error';
} else {
  $class = '';
}
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <title><?= $title; ?></title>
  <!--Import Google Icon Font-->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('semantic/dist/semantic.min.css'); ?>">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css'); ?>">
  <script src="<?php echo base_url('assets/js/jquery-3.1.1.min.js'); ?>" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
  <script src="<?php echo base_url('semantic/dist/semantic.min.js'); ?>"></script>
  <style>
  #body{
    background: #1b1c1d;
  }
  </style>
</head>
<body class="site" id="body">
  <div class="site-content ui main middle aligned center aligned grid">
    <div class="column" style="max-width: 450px;">
      <?php
      $attributes = array('class' => "ui form $class");
      echo form_open('grupo/'.$grupo['slug'].'/admin', $attributes); ?>
      <div class="ui segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="senha" placeholder="Senha" required/>
          </div>
        </div>
        <button class="ui fluid button grey" type="submit">Login</button>
        <div class="ui error message">
          <div class="header">Erro</div>
          <?= validation_errors(); ?>
        </div>

      </div>
      <?= form_close(); ?>

    </div>
  </div>
</body>
</html>
