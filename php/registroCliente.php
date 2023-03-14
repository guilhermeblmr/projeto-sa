<?php
    require_once("conexaoBanco.php");

    $usuario= $_POST['usuario'];
    $senhaMD5=md5($_POST['senha']);
    $nome= $_POST['nome'];
    $sobrenome= $_POST['sobrenome'];
    $cpf= $_POST['cpf'];
    $email= $_POST['email'];
    $telefone= $_POST['telefone'];
    $endereco= $_POST['endereco'];

    $comando= "INSERT INTO usuarios (login , senha, permissao) VALUES ('".$usuario."', '".$senhaMD5."', 2)";

    //echo $comando;
    $resultado = mysqli_query($conexao, $comando);

    $comando2 = "SELECT MAX(idUsuario) as idUsuario FROM usuarios";

    $resultado2 = mysqli_query($conexao, $comando2);

    $idUsuario = mysqli_fetch_assoc($resultado2);

    $comando3= "INSERT INTO clientes (cpf, nome, sobrenome, email, endereco, telefone, usuarios_idUsuario) VALUES 
    (".$cpf.", '".$nome."', '".$sobrenome."', '".$email."', '".$endereco."', '".$telefone."', ".$idUsuario['idUsuario'].")";

    $resultado3 = mysqli_query($conexao, $comando3);

    if($resultado3==true){
        header("Location: login.php?retorno=2");
    }else{
        header("Location: cadastroCliente.php?retorno=1");
    }

?>