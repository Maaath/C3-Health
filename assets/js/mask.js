$(document).ready(function(){
    $("#cpf").mask("000.000.000-00")
    $("#telefone").mask("(00) 0000-00009")
$("#telefone").blur(function(event){
  if ($(this).val().length == 15){
    $("#telefone").mask("(00) 90000-0000")
  }else{
    $("#telefone").mask("(00) 0000-0000")
  }
})
})