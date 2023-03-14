<?php

require_once("conexaoBanco.php");

$produtoNome = $_POST['produtoNome'];
$preco=$_POST['preco'];
$idCategoria = $_POST['idCategoria'];
$idProduto = $_POST['idProduto'];


$comando="UPDATE produtos SET produtoNome='".$produtoNome."',
preco=".$preco.", categorias_idCategoria=".$idCategoria." WHERE idProduto=".$idProduto;

$resultado=mysqli_query($conexao,$comando);

if($resultado==true){
    header("Location: cadastroProdutos.php?retorno=6");
}else{
    header("Location: cadastroProdutos.php?retorno=7");
}


?>