function validaFormulario(){

    var nome=document.getElementById("nome");
    var email=document.getElementById("email");
    var assunto=document.getElementById("assunto");
    var nrPedido=document.getElementById("nrPedido");
    var mensagem=document.getElementById("mensagem");

    if(nome.value=="" || nome.value.length <3){
        alert("Preencha o campo nome corretamente");
        nome.focus();
        return false;
    }

    if(email.value=="" || email.value.indexOf("@")==-1
        || email.value.indexOf(".")==-1){
        alert("Preencha o campo e-mail corretamente");
        email.focus();
        return false;
    }

    if(assunto.value=="0"){
        alert("Selecione um assunto");
        assunto.focus();
        return false;
    }
    
    if(assunto.value=="4" && nrPedido.value==""){
        alert("Informe o número do pedido");
        nrPedido.focus();
        return false;
    }

    if(mensagem.value=="" || mensagem.value.length<2){
        alert("Deixe um comentário");
        mensagem.focus();
        return false;
    }
    alert("E-mail enviado com sucesso!");
    return true;
}

function verificaAssunto(assunto){
    
    if(assunto=="4"){
        document.getElementById("divNrPedido").style.display="block";
    }else{
        document.getElementById("divNrPedido").style.display="none";
    }

}



