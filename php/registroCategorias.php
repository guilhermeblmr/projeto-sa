<?php

require_once("conexaoBanco.php");

$nome = $_POST['nomeCategoria'];


$comando= "INSERT INTO categorias (nome) 
            VALUES ('".$nome."')";


$resultado = mysqli_query($conexao,$comando);

if($resultado==true){
   header("Location: cadastroCategoria.php?retorno=1");
}else{
    header("Location: cadastroCategoria.php?retorno=2");
}

?>