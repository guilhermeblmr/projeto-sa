<?php
    
    require_once("conexaoBanco.php");

    session_start();
    $idCliente = $_POST['idCliente'];
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $sobrenome = $_POST['sobrenome'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $senha = $_POST['senha'];
    $senhaMD5 = md5($senha);
    $usuarios_idUsuario = $_SESSION['idUsuario'];


    if($senha!=""){

        $comando="UPDATE usuarios SET senha='".$senhaMD5."' WHERE idUsuario=".$usuarios_idUsuario;
        $resultado=mysqli_query($conexao,$comando);
        
        
    }

    $comando2="UPDATE clientes SET nome='".$nome."', sobrenome='".$sobrenome."', email='".$email."',
    cpf=".$cpf.", endereco='".$endereco."', telefone='".$telefone."' WHERE idCliente=".$idCliente;
    //echo $comando2;
    $resultado2=mysqli_query($conexao,$comando2);
    

    if($resultado2==true){
    header("Location: alterarDados.php?retorno=1");
    }else{
    header("Location: alterarDados.php?retorno=2");
    }
    

?>