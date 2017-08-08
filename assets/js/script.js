// menu
if($('.item.cadastro').length) {
  $('.item.entrar').css('border-right', '');
}

//apenas permite os seguintes caracteres => qwertyuiopasdfghjklzxcvbnm-1234567890
$(".link_grupo").keypress( function(e) {
  var chr = String.fromCharCode(e.which);
  if ("qwertyuiopasdfghjklzxcvbnm-1234567890".indexOf(chr) < 0)
  return false;
});

//troca a barra de espaço por -
$(".link_grupo").keydown( function(e) {
  var str = $('.link_grupo').val();
  var chr = String.fromCharCode(e.which);
  if(chr == ' '){
    event.preventDefault()
    $('.link_grupo').val(str + '-');
  }
});

$(".area_grupo").keydown( function(e) {
  // não permite deletar
  var key = e.keyCode || e.charCode;
  if (key == 8 || key == 46) {
      e.preventDefault();
      e.stopPropagation();
  }
  // não permite digitar
  var chr = String.fromCharCode(e.which);
  if ("".indexOf(chr) < 0)
  return false;
});

$(".cnpj_instituicao").keypress( function(e) {
  var chr = String.fromCharCode(e.which);
  if ("1234567890".indexOf(chr) < 0)
  return false;
});
