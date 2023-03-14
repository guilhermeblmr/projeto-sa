<?php

session_start();

if(isset($_SESSION['idUsuario'])==true){
    if($_SESSION['permissao']==1){
        header("Location: principalAdm.php");
    }else if ($_SESSION['permissao']==2){
        header("Location: principalCliente.php");
    }
}else{
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <title>Login - Pop </title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/geral.css">
    <link rel="icon" type="img/png" href="../img/iconeLogin.png">
    <script src="../js/login.js"></script>
</head>

<body>
<?php 
    if(isset($_GET['retorno']) && $_GET['retorno']==1){
        echo "<script> 
                alert('Usuario não encontrado!');
            </script>";
    }else if(isset($_GET['retorno']) && $_GET['retorno']==2){
        echo "<script> 
                alert('Voce esta cadastrado! Agora faça login para navegar');
            </script>";
    }?>
        <div class="form-box">
            <form action="efetuaLogin.php" method="POST">
                <div class="logo">
                    <img src="../img/logo.png" id="logoLogin">

                </div>
                <h1>Login</h1><hr>
                <input type="text" name="nomeLogin" id="nomeLogin" placeholder="Login" class="form-input">

                <input type="password" name="senha" id="senha" placeholder="Senha" class="form-input">

                <input type="checkbox" name="marcar"> Mantenha-me conectado<br>

                <a href="#"><span id="esqSenha">Esqueci minha senha</span></a><br><br>

                <button type="submit" class="estBotao"
                    onclick="return validaLogin()">Enviar
                </button></form>

                <a href="cadastroCliente.php"><button class="botaoCad"
                   >Cadastrar
                </button></a><br>

                <a href="../index.html"><img src="../img/voltar.png" id="voltar"></a>
                

            
        
    </div>
</body>
</html>
<?php
}
?>