<?php
    session_start();
    if(isset($_SESSION['idUsuario'])==true && $_SESSION['permissao']==1){
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/geralAdm.css">
    <link rel="stylesheet" href="../css/geralFormCadastros.css">
    <title>Alterar Status do Pedido - Administração</title>
</head>
<body>
   
    <?php
        include("menuAdm.php");
    ?>

<section id="conteudoPrincipal">
    <h1 id="tituloPrincipal">Alterar status do pedido</h1>

    <?php
        require_once("conexaoBanco.php");
        $idPedido=$_POST['idPedido'];
        $nomeCliente=$_POST['nomeCliente'];
        $dataPedido=$_POST['dataPedido'];

        echo "<div id='dadosGeraisPedido'>";
        echo "<p> Nome do cliente: ".$nomeCliente."<br>";
        echo "<p> Data do pedido: ".$dataPedido."<br>";
        echo "</div>";
       
        
    ?>
        
<form action="alterarStatusPedido.php" method="POST" id="formularioCadastro">

    <input type="hidden" value="<?=$idPedido?>" name="idPedido">
    
    <fieldset>
        <legend>Informe o novo status do pedido</legend>

        <div class="informacoes" id="camposAcompanhaPedido">

            <label for="status" class="labelsForm">Status</label>
          <select name="status" id="status">
            <option value="1">Em aberto</option>
            <option value="2">Em andamento </option>
            <option value="3">Finalizado </option>
        </select> <br><br>
          
      <button type="submit" class="estBotao" id="botao">Enviar
    </button>
            
    </fieldset>       
    
</form>

</section>
    
</body>
</html>

<?php

    }//fechamento do IF
    else if(isset($_SESSION['idUsuario'])==true && $_SESSION['permissao']==2){
       
        header("Location: semPermissao.php");     

    }else if(isset($_SESSION['idUsuario'])==false){
        
        header("Location: facaLogin.php"); 
    }

?>