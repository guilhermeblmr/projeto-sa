function validaLogin(){
    var nomeLogin=document.getElementById("nomeLogin");
    var senha=document.getElementById("senha");


    if(nomeLogin.value==""){
        alert("Preencha o campo login");
        nomeLogin.focus();
        return false;
    }

    if(senha.value==""){
        alert("Preencha o campo senha");
        senha.focus();
        return false;
    }
   
}