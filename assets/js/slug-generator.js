$(".nome_grupo").focusout(function() {
  var slug = $(".nome_grupo").val();
  slug = slug.toLowerCase();
  com_acento = 'áàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ';
  sem_acento = 'aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC';
  nova = '';
  for (i = 0; i < slug.length; i++) {
    if (com_acento.indexOf(slug.substr(i, 1)) >= 0) {
      nova += sem_acento.substr(com_acento.search(slug.substr(i, 1)), 1);
    } else {
      nova += slug.substr(i, 1);
    }
  }
  //obj.value = nova.toUpperCase();
  slug = nova;

  slug = slug.replace(/[.,\/#!$%\^&\*;:{}=\-_`~()]/g,"");
  slug = slug.replace(/\s/g,'-');

  $(".link_grupo").val(slug).trigger('change');
});
