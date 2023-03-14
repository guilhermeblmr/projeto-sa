<?php
    session_start();
    if(isset($_SESSION['idUsuario'])==true 
    && $_SESSION['permissao']==1){
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/geralAdm.css">
    <link rel="stylesheet" href="../css/geralFormCadastros.css">
    <script src="../js/produtos.js"></script>
    <title>Edição Produtos - Administração</title>
</head>
<body>

<?php
        include("menuAdm.php");
    ?>
<?php
    require_once("conexaoBanco.php");
    $idProduto = $_POST['idProduto'];

    $comando="SELECT * FROM produtos WHERE idProduto=".$idProduto;

    $resultado=mysqli_query($conexao,$comando);

    $produtoRetornado=mysqli_fetch_assoc($resultado);
    
    
?>

<section id="conteudoPrincipal">
        <h1 id="tituloPrincipal"> Edição de produtos</h1>
<div id="formularioCadastro">
        <form action="edicaoProdutos.php" method="POST">

        <input type="hidden" value="<?=$produtoRetornado['idProduto']?>"
        name="idProduto">
            <fieldset>
                <legend>Dados do produto</legend>
                <div class="informacoes">
                    <label for="produtoNome" class="labelsForm">
                        Nome</label><br>
                    <input type="text" name="produtoNome" id="produtoNome" 
                    class="camposForm" value="<?=$produtoRetornado['produtoNome']?>">
                </div>

                <div class="informacoes">
                    <label for="preco" class="labelsForm">Preço</label>
                    <br>
                    <input type="number" name="preco" id="preco" step="any"
                    class="camposForm" value="<?=$produtoRetornado['preco']?>">
                </div>

                <div class="informacoes">
                    <label for="categoria" class="labelsForm">Categorias</label><br>
                    <select id="categoria" class="camposForm" name="idCategoria">
                        <option value="0">Selecione</option>

                        <?php
                            require_once("conexaoBanco.php");

                            $comando="SELECT * FROM categorias";

                            $resultado=mysqli_query($conexao,$comando);

                            $categorias = array();

                            while($cadaCategoria = mysqli_fetch_assoc($resultado)){
                                array_push($categorias,$cadaCategoria);
                            }

                            foreach ($categorias as $cadaCategoria){ 
                                
                                if($cadaCategoria['idCategoria']==
                                $produtoRetornado['categorias_idCategoria']){

                                ?>     

                                <option selected value="<?=$cadaCategoria['idCategoria']?>">
                                <?=$cadaCategoria['nome']?>
                                </option>


                            <?php
                                }else{
                                    ?>

                                <option value="<?=$cadaCategoria['idCategoria']?>">
                                <?=$cadaCategoria['nome']?>
                                </option>


                            <?php            
                            }
                        }

                        ?>


                    </select>
                </div>

               
                

                <div class="informacoes">
                <button type="reset" class="estBotaoLimpar" id="botao" >
                        Limpar
                    </button>

                    <button type="submit" class="estBotao"  id="botao"
                    onclick="return validaFormulario()">
                           Enviar
                    </button>
                </div>
            </fieldset>         

        </form>
    </div>
</section>
</body>
</html>

<?php

}else if(isset($_SESSION['idUsuario'])==true && 
$_SESSION['permissao']==2){
   
    header("Location: semPermissao.php");     

}else if(isset($_SESSION['idUsuario'])==false){
    
    header("Location: facaLogin.php"); 
}

?>