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
    <title>Fazer pedido - Cliente</title>
</head>
<body>

    <?php
        include("menuCliente.php");
    ?>

    <?php
        $nomeSobrenome=$_SESSION['nome']." ".$_SESSION['sobrenome'];
    ?>

    <section id="conteudoPrincipal">
        <h1 id="tituloPrincipal">Novo pedido </h1>

        <div class="informacoes" id="informacoesGeraisPedido">

            <label for="nomeUser" class="labelsForm">Nome</label>
            <input type="text" id="nomeUser" name="nomeUser" 
            class="camposForm" value="<?=$nomeSobrenome?>" disabled="disabled">

            <?php
                    $dataAtual=date("Y-m-d");              
            ?>

            <label for="data" class="labelsForm">Data</label>
            <input type="date" id="data" name="data" class="camposForm" 
            value="<?=$dataAtual?>" disabled="disabled">

            <label for="valorTotal" class="labelsForm">Valor total</label>
            <input type="text" id="valorTotal" name="valorTotal" class="camposForm"
            value="0" disabled="disabled">

        </div>
        
    
    <form action="registraPedidos.php" method="POST"  id="formularioCadastro">
        <br>
        <fieldset id="fieldProduto">
            <legend> Selecione os produtos que deseja comprar</legend><br>

            <div class="informacoes" id="produto0">

                <label for="idProduto0" class="labelsForm">Produto</label>
                <select name="idProdutos[]" id="idProduto0" class="camposForm" 
                onchange="retornaValorUnitario(this.value,0)">
                    <option value="0"> Selecione... </option>
                        <?php
                        include("retornaSelectProdutos.php");                  
                        ?>
                </select>

                <label for="valorUnitario0" class="labelsForm">Valor unitário</label>
                <input type="text" name="valoresUnitarios[]" disabled="disabled" id="valorUnitario0" class="camposForm">

                <label for="quantidade0" class="labelsForm">Quantidade</label>
                <input type="number" name="quantidades[]" 
                onblur="atualizaValorTotal(this.value,0)" id="quantidade0" class="camposForm">  

                <button type="button" onclick="adicionaProduto()">+</button>           
            </div>   

                <div id="maisProdutos"> </div>
                <br>
                <div class="informacoes">

                            <a href="../index.html"><img src="../img/voltar.png" id="voltar"></a>

                            <button type="submit" class="estBotao">
                                    Enviar
                            </button><br>
                </div>            
            </fieldset>   
    </form>
    </section>   
    
</body>
</html>

<?php

    }else if(isset($_SESSION['idUsuario'])==true && $_SESSION['permissao']==1){
        header("Location: semPermissao.php");
    }else if(isset($_SESSION['idUsuario'])==false){
        header("Location: login.php");
    }
?>