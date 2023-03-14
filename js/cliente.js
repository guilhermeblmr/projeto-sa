function validaFormulario(){

    var nome=document.getElementById("nome");
    var sobrenome=document.getElementById("sobrenome");
    var cpf=document.getElementById("cpf");
    var email=document.getElementById("email");
    var telefone=document.getElementById("telefone");
    var endereco=document.getElementById("endereco");
    var usuario=document.getElementById("usuario");
    var senha=document.getElementById("senha");

    if(nome.value=="" || nome.value.length <3){
        alert("Preencha o campo nome corretamente");
        nome.focus();
        return false;
    }

    if(sobrenome.value=="" || sobrenome.value.length <3){
        alert("Preencha o campo sobrenome corretamente");
        sobrenome.focus();
        return false;
    }

    if(email.value=="" || email.value.indexOf("@")==-1
        || email.value.indexOf(".")==-1){
        alert("Preencha o campo e-mail corretamente");
        email.focus();
        return false;
    }

    if(cpf.value=="" || cpf.value.length <11){
        alert("Preencha o campo de CPF corretamente");
        cpf.focus();
        return false;
    }

    if(telefone.value=="" || telefone.value.length <11){
        alert("Preencha o campo de telefone corretamente");
        telefone.focus();
        return false;}

    if(endereco.value=="" || endereco.value.length <3){
        alert("Preencha o campo endereço corretamente");
        endereco.focus();
        return false;
    }

    if(usuario.value=="" || usuario.value.length <3){
        alert("Preencha o campo usuario corretamente");
        usuario.focus();
        return false;
    }

    if(senha.value=="" || senha.value.length <3){
        alert("Preencha o campo senha corretamente");
        senha.focus();
        return false;
    }

}



