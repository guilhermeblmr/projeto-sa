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
    <title>Cadastro de produtos - Administração</title>
</head>
<body>
   
    <?php
        include("menuAdm.php");
    ?>
    
<?php
    if(isset($_GET['retorno'])==true && $_GET['retorno']==1){
        echo "<script> 
             alert('Produto cadastrado com sucesso!');
        </script>
        ";
    } else if(isset($_GET['retorno'])==true && $_GET['retorno']==2){
        echo "<script> 
             alert('Erro ao cadastrar o produto!');
        </script>
        ";
    }else if(isset($_GET['retorno'])==true && $_GET['retorno']==3){
        echo "<script> 
             alert('Produto excluído com sucesso!');
        </script>
        ";
    }else if(isset($_GET['retorno'])==true && $_GET['retorno']==4){
        echo "<script> 
             alert('Erro ao excluir o produto!');
        </script>
        ";
    }else if(isset($_GET['retorno'])==true && $_GET['retorno']==5){
        echo "<script> 
             alert('O produto não pode ser excluído pois está em algum pedido!');
        </script>
        ";
    }else if(isset($_GET['retorno'])==true && $_GET['retorno']==6){
        echo "<script> 
             alert('Produto alterado com sucesso!');
        </script>
        ";
    }else if(isset($_GET['retorno'])==true && $_GET['retorno']==7){
        echo "<script> 
             alert('Erro ao alterar o Produto!');
        </script>
        ";
    }

?>
    <section id="conteudoPrincipal">
        <h1 id="tituloPrincipal"> Cadastro de produtos</h1>
<div id="formularioCadastro">
        <form action="registroProdutos.php" method="POST">
            <fieldset>
                <legend id="sub">Dados do produto</legend>
                <div class="informacoes">
                    <label for="produtoNome" class="labelsForm">
                        Nome</label><br>
                    <input type="text" name="produtoNome" id="produtoNome" 
                    class="caixaInput">
                </div>

                <div class="informacoes">
                    <label for="preco" class="labelsForm">Preço</label>
                    <br>
                    <input type="number" name="preco" id="preco" step="any"
                    class="caixaInput">
                </div>

                <div class="informacoes">
                    <label for="categoria" class="labelsForm">Categoria</label><br>
                    <select id="categoria" class="caixaInput" name="idCategoria">
                        <option class="caixaInput" value="0">Selecione</option>

                        <?php
                            require_once("conexaoBanco.php");

                            $comando="SELECT * FROM categorias";

                            $resultado=mysqli_query($conexao,$comando);

                            $categorias = array();

                            while($cadaCategoria = mysqli_fetch_assoc($resultado)){
                                array_push($categorias,$cadaCategoria);
                            }

                            foreach ($categorias as $cadaCategoria){ ?>
                                
                                <option value="<?=$cadaCategoria['idCategoria']?>">
                                <?=$cadaCategoria['nome']?>
                                </option>


                            <?php
                            }


                        ?>


                    </select>
                </div>

                <div class="informacoes">
                    <button type="reset" class="estBotaoLimpar" id="botao">
                        Limpar
                    </button>

                    <button type="submit" class="estBotao" id="botao"
                    onclick="return validaRegistroProduto()">
                            Enviar
                    </button>
                </div>
            </fieldset>         

        </form>
    </div>
    <div class="tabela">
    <div id="formularioConsulta">
        <form action="#" method="GET">
            
               <legend id="titul">Consulta de produtos</legend>
            
            <label for="produtoNomeBusca" class="labelsForm">Nome do produto</label>
            <input type="text" name="produtoNomeBusca" id="produtoNomeBusca" 
            placeholder="ex.: Garfield" class="camposForm">
            <button type="submit" class="botoes" id="icones">
                <img id="imagemBuscar" src="../img/buscar.png" alt="Botão buscar produtos">
            </button>

       
        </form>

    </div>

    <div id="exibicaoConsulta">
        <table>
            <th>Nome</th>
            <th>Preço</th>
            <th>Categoria</th>
            <th>Ações</th>
            
            
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
                                
                                <form action="edicaoProdutosForm.php" method="POST">
                                    <input type="hidden" name="idProduto" 
                                    value="<?=$cadaProduto['idProduto']?>"> 

                                    <button type="submit" id="icones">
                                        <img src="../img/editarIcone.png" 
                                        alt="Ícone editar" >
                                </button>
                                </form> 
                                
                                <form action="exclusaoProdutos.php" method="POST">
                                    <input type="hidden" name="idProduto" 
                                    value="<?=$cadaProduto['idProduto']?>"> 

                                    <button type="submit" id="icones">
                                        <img src="../img/excluirIcone.png" 
                                        alt="Ícone excluir" >
                                </button>
                                </form> 
                                
                                </td>
                            </tr>
                            
                    <?php        
                    }

                }
            ?>


        </table>
    </div>

    </section>
    </div>
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