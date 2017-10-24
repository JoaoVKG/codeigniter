<?php
if(!isset($_SESSION['usuario_logado']['nome'])) {
  redirect('/', 'refresh');
}
?>
<div class="site-content margin-top margin-bottom ui main container">
  <h3 class="ui header">Olá, <?php echo $_SESSION['usuario_logado']['nome']; ?>!</h3>

  <div class="ui center aligned segment home-link" onclick="window.location='<?php echo base_url("entre-em-um-grupo"); ?>'">
    <h3 class="ui icon header">
      <i class="icons">
        <i class="users icon"></i>
        <i class="corner sign in icon"></i>
      </i>
      <div class="content">
        Entrar em um grupo
        <div class="sub header">Entre ou cadastre um grupo de pesquisa.</div>
      </div>
    </h3>
  </div>

  <div class="ui center aligned segment home-link" onclick="window.location='<?php echo base_url("procurar-grupos"); ?>'">
    <h3 class="ui icon header">
      <i class="icons">
        <i class="users icon"></i>
        <i class="corner search icon"></i>
      </i>
      <div class="content">
        Procurar grupos
        <div class="sub header">Encontre novos grupos de pesquisa.</div>
      </div>
    </h3>
  </div>

  <div class="ui center aligned segment home-link" onclick="window.location='<?php echo base_url("gerenciar-grupos"); ?>'">
    <h3 class="ui icon header">
      <i class="icons">
        <i class="users icon"></i>
        <i class="corner settings icon"></i>
      </i>
      <div class="content">
        Gerenciar grupos
        <div class="sub header">Visualize e gerencie seus grupos de pesquisa.</div>
      </div>
    </h3>
  </div>

</div>
