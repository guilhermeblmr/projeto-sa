<?php

    require_once("conexaoBanco.php");

    $produtoNome = $_POST['produtoNome'];
    $preco = $_POST['preco'];
    $idCategoria = $_POST['idCategoria'];
    


    $comando="INSERT INTO produtos 
    (produtoNome,preco,categorias_idCategoria) VALUES 
    ('".$produtoNome."',".$preco.",".$idCategoria.")";


    $resultado=mysqli_query($conexao,$comando);

    if($resultado==true){
        header("Location: cadastroProdutos.php?retorno=1");
    }else{
        header("Location: cadastroProdutos.php?retorno=2");
    }
?>