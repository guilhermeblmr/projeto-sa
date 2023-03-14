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
    <title>Edição categoria - Adm</title>
</head>
<body>
<?php
        include("menuAdm.php");
    ?>

    <section id="conteudoPrincipal">
        <h1 id="tituloPrincipal"> Edição de categorias</h1>
<?php

    require_once("conexaoBanco.php");

    $idCategoria = $_POST['idCategoria'];

    $comando="SELECT * FROM categorias 
                WHERE idCategoria=".$idCategoria;

    $resultado= mysqli_query($conexao,$comando);

    $categoriaRetornada = mysqli_fetch_assoc($resultado);

?>
<div id="formularioCadastro">
        <form action="edicaoCategorias.php" method="POST">
            <input type="hidden" name="idCategoria" 
            value="<?=$categoriaRetornada['idCategoria']?>">

            <fieldset>
                <legend>Dados da categoria</legend>
                <div class="informacoes">
                    <label for="nomeCategoria" class="labelsForm">
                        Nome da categoria</label><br>
                    <input type="text" name="nomeCategoria" id="nomeCategoria" 
                    class="camposForm" value="<?=$categoriaRetornada['nome']?>">
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