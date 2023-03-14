<?php
session_start();
if(isset($_SESSION['idUsuario'])==true && 
$_SESSION['permissao']==2){
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/geralAdm.css">
    <link rel="stylesheet" href="../css/geralFormCadastros.css">
    
    <title>Consulta de produtos - Cliente</title>
</head>
<body>
   
    <?php
        include("menuCliente.php");
    ?>
<div class="tabela">
<div id="formularioConsulta">
        <form action="#" method="GET">
            
               <legend id="tituloPrincipal">Consulta de produtos</legend>
            
            <label for="produtoNomeBusca" class="labelsForm">Nome do produto</label>
            <input type="text" name="produtoNomeBusca" id="produtoNomeBusca" 
            placeholder="ex.: Garfield" class="camposForm">
            <button type="submit" class="botoes" id="icones">
                <img id="imagemBuscar" src="../img/buscar.png" alt="Botão buscar produtos">
            </button>

        
        </form>

    </div>

    <div id="exibicaoConsulta" >
        <table>
            <th id="xupirs">Nome</th>
            <th id="xupirs">Preço</th>
            <th id="xupirs">Categoria</th>
             
            <?php               
                require_once("conexaoBanco.php");
                $comando="";

                if(isset($_GET['produtoNomeBusca']) && $_GET['produtoNomeBusca']!=""){
                    $busca = $_GET['produtoNomeBusca'];
                    $comando="SELECT produtos.*, categorias.nome FROM 
                    produtos INNER JOIN categorias ON 
                    produtos.categorias_idCategoria = categorias.idCategoria WHERE 
                    produtos.produtoNome LIKE '".$busca."%'";
                    
                }else{
                    $comando="SELECT produtos.*, categorias.nome FROM 
                    produtos INNER JOIN categorias ON 
                    produtos.categorias_idCategoria = categorias.idCategoria";
                }

                $resultado = mysqli_query($conexao,$comando);
                $linhas = mysqli_num_rows($resultado);
                
                if($linhas==0){
                    echo "<tr><td colspan='6'>
                    Nenhum produto encontrado!
                    </td></tr>";
                }else{
                    $produtosEncontrados=array();
                    while($cadaProduto = mysqli_fetch_assoc($resultado)){
                        array_push($produtosEncontrados,$cadaProduto);
                    }
                    foreach($produtosEncontrados as $cadaProduto){ ?>

                            <tr>
                                <td> <?=$cadaProduto['produtoNome']?></td>
                                <td> <?=$cadaProduto['preco']?></td>
                                <td> <?=$cadaProduto['nome']?></td>
                                <td> 
                                
                                
                                
                                </td>
                            </tr>
                            
                    <?php        
                    }

                }
            ?>


        </table>
    </div>
    </div>
    </section>
    
</body>
</html>

<?php

}else if(isset($_SESSION['idUsuario'])==true && 
$_SESSION['permissao']==1){
    header("Location: semPermissao.php");
}else if(isset($_SESSION['idUsuario'])==false){
    header("Location: facaLogin.php");
}
?>