﻿<?php
    require_once("conexaoBanco.php");
    $idPedido=$_POST['idPedido'];
    $status=$_POST['status'];

    $comando="UPDATE pedidos SET status=".$status." WHERE idPedido=".$idPedido;

    $resultado=mysqli_query($conexao,$comando);

    if($resultado==true){
        header("Location: gerenciarPedidos.php?retorno=1");
    }else{
        header("Location: gerenciarPedidos.php?retorno=2");
    }



?>