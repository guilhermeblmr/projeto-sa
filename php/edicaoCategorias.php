<?php
    
    require_once("conexaoBanco.php");

    $idCategoria = $_POST['idCategoria'];
    $nome = $_POST['nomeCategoria'];


    $comando = "UPDATE categorias SET 
    nome='".$nome."' WHERE 
    idCategoria=".$idCategoria;


    $resultado=mysqli_query($conexao,$comando);

    if($resultado==true){
        header("Location: cadastroCategoria.php?retorno=6");
    }else{
        header("Location: cadastroCategoria.php?retorno=7");
    }


?>