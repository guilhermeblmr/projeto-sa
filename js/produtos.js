function validaRegistroProduto(){

    var produtoNome = document.getElementById("produtoNome");
    var preco = document.getElementById("preco");
    var categoria = document.getElementById("categoria");
    

    if(produtoNome.value==""){
        alert("Preencha o nome do produto!");
        produtoNome.focus();
        return false;
    }

    if(preco.value==""){
        alert("Preencha o preço do produto!");
        preco.focus();
        return false;
    }

    if(categoria.value=="0"){
        alert("Selecione uma categoria!");
        categoria.focus();
        return false;
    }
       
    
    
}