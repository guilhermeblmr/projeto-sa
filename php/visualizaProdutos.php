<?php
    session_start();
    if(isset($_SESSION['idUsuario'])==true && $_SESSION['permissao']==2){
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/geralAdm.css">
    <link rel="stylesheet" href="../css/geralFormCadastros.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../js/funcoesPedidoProdutos.js"></script>
    <title>Visualizar produtos do pedido - Cliente</title>
</head>
<body>

<?php       include("menuCliente.php");   ?>


<section id="conteudoPrincipal">
    <h1 id="tituloPrincipal">Produtos do pedido </h1>

    <?php
        require_once("conexaoBanco.php");
        $idPedido=$_POST['idPedido'];
        $comando="SELECT produtos.produtoNome, produtos.preco FROM produtos INNER JOIN pedidos_has_produtos ON produtos.idProduto=pedidos_has_produtos.produtos_idProduto 
        WHERE pedidos_has_produtos.pedidos_idPedido=".$idPedido;

        
        $resultado=mysqli_query($conexao,$comando);

        $produtosDoPedido=array();
        while($cadaProduto = mysqli_fetch_assoc($resultado)){
            array_push($produtosDoPedido,$cadaProduto);
        }

        foreach($produtosDoPedido as $cadaProduto){ 
            echo "<p class='produtosListados'>Título: ".$cadaProduto['produtoNome']."</p>
            <p class='produtosListados'>Preço: R$".$cadaProduto['preco']."</p><br>      
            <br>";        
        }
    ?>
   
</section>
<p id="retornar">Clique  <a href="acompanharPedido.php">aqui</a> para voltar</p> 
    
    
</body>
</html>

<?php

    }else if(isset($_SESSION['idUsuario'])==true && $_SESSION['permissao']==1){
        header("Location: semPermissao.php");
    }else if(isset($_SESSION['idUsuario'])==false){
        header("Location: facaLogin.php");
    }


?>