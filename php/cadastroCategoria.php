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
    <script src="../js/categorias.js"></script>
    <title>Cadastro Categorias - Administração</title>
</head>







<?php 
    if(isset($_GET['retorno']) && $_GET['retorno']==1){
        echo "<script> 
                alert('Categoria cadastrada com sucesso');
            </script>";
    }else if(isset($_GET['retorno']) && $_GET['retorno']==2){
        echo "<script> 
                alert('Erro ao cadastrar categoria');
            </script>";
    }else if(isset($_GET['retorno']) && $_GET['retorno']==3){
        echo "<script> 
        alert('Categoria removida com sucesso!');
                </script>"; 
    }else if(isset($_GET['retorno']) && $_GET['retorno']==4){
        echo "<script> 
        alert('Erro ao remover categoria!');
                </script>"; 
    }else if(isset($_GET['retorno']) && $_GET['retorno']==5){
        echo "<script> 
    alert('A categoria possui produtos, não pode ser removida!');
                </script>"; 
    }else if(isset($_GET['retorno']) && $_GET['retorno']==6){
        echo "<script> 
    alert('Categoria alterada com sucesso!');
                </script>"; 
    }else if(isset($_GET['retorno']) && $_GET['retorno']==7){
        echo "<script> 
    alert('Erro ao alterar categoria!');
                </script>"; 
    }

?>







<body>

    <?php
        include("menuAdm.php");
    ?>

    <section id="conteudoPrincipal">
        <h1 id="tituloPrincipal"> Cadastro de categorias</h1>

<div id="formularioCadastro">

        <form action="registroCategorias.php" method="POST">

            <fieldset>
                <legend id="sub">Dados da categoria</legend>
                <div class="informacoes">
                    <label for="nomeCategoria" class="labelsForm">
                        Nome da categoria</label><br>
                    <input type="text" name="nomeCategoria" id="nomeCategoria" 
                    class="caixaInput" >
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
    <div class="tabela">
    <div id="formularioConsulta" >
        <form action="#" method="GET">
            
               <legend id="titul">Consulta de categorias</legend>
            
            <label for="categoriaBusca" class="labelsForm">Nome da categoria</label>
            <input type="text" name="categoriaBusca" id="categoriaBusca" 
            placeholder="ex.: Filme" class="camposForm">
            <button type="submit" id="icones">
                <img id="imagemBuscar" src="../img/buscar.png" alt="Botão buscar editora">
            </button>

        
        </form>

    </div>

    <div id="exibicaoConsulta" >
        <table>
            <th>Nome da categoria</th>
            <th>Ações</th>

            <?php
           
                require_once("conexaoBanco.php");
                $comando="";
       
                if(isset($_GET['categoriaBusca']) && 
                $_GET['categoriaBusca']!=""){
                    $nomeEditora=$_GET['categoriaBusca'];
                    $comando="SELECT * FROM categorias WHERE 
                    nome LIKE '".$nomeEditora."%'";
                 
                }else{
                    $comando="SELECT * FROM categorias";
                } 

                $resultado= mysqli_query($conexao,$comando);
                $linhas= mysqli_num_rows($resultado);

                
                if($linhas==0){ ?>

                    <tr><td colspan='3'>Nenhuma categoria encontrada
                    </td></tr>
                    
                 <?php   
                }else{
                    $arrayCategorias=array();

                    while($cadaCategoria = mysqli_fetch_assoc($resultado)){
                        array_push($arrayCategorias,$cadaCategoria);
                    }

                    foreach ($arrayCategorias as $cadaCategoria){ ?>

                        <tr>
                            <td><?=$cadaCategoria['nome'];?></td>
                            <td>
                                <form action="exclusaoCategoria.php" method="POST">

                                <input type="hidden" name="idCategoria" 
                                value="<?=$cadaCategoria['idCategoria']?>">

                                <button type="submit" id="icones">
                                    <img src="../img/excluirIcone.png" alt="Ícone de exclusão">
                                </button>
                                </form> 

                                <form action="edicaoCategoriaForm.php" method="POST">

                                <input type="hidden" name="idCategoria" 
                                value="<?=$cadaCategoria['idCategoria']?>">

                                <button type="submit" id="icones">
                                    <img src="../img/editarIcone.png" alt="Ícone de edição">
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
    </div>
    </section>
    
</body>
</html>

<?php

    }
    else if(isset($_SESSION['idUsuario'])==true && 
    $_SESSION['permissao']==2){
       
        header("Location: semPermissao.php");     

    }else if(isset($_SESSION['idUsuario'])==false){
        
        header("Location: facaLogin.php"); 
    }

?>