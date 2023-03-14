function validaFormulario(){

    var nome=document.getElementById("nomeCategoria");
    

   // alert(nome.value + " "+cidade.value);

   if(nome.value==""){
    alert("Preencha o nome da categoria");
    nome.focus();
    return false;
   }


} 