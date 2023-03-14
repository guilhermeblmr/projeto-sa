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
    <title>Gestão Pedidos - Administração</title>
</head>
<body>
   
    <?php
        include("menuAdm.php");
    ?>
<?php 
    if(isset($_GET['retorno']) && $_GET['retorno']==1){
        echo "<script> 
                alert('Status atualizado com sucesso');
            </script>";
    }else if(isset($_GET['retorno']) && $_GET['retorno']==2){
        echo "<script> 
                alert('Erro ao atualizar status');
            </script>";
    }
?>
<section id="conteudoPrincipal">
    <h1 id="tituloPrincipal">Gerenciar pedidos</h1>
    
<form action="#" method="GET" id="formularioCadastro">
    
<fieldset>
        <legend> Informe os filtros</legend>

        <div class="informacoes" id="camposAcompanhaPedido">

        <label for="cpf" class="labelsForm">CPF</label>
            <input type="number" name="cpf" id="cpf" class="camposForm">        
        </div>
        <button type="submit" class="botoes" id="icones">
                <img src="../img/blackSearch.png" alt="Botão pesquisar" id="pesquisaIcone">

        </button>
            
    </fieldset>       
    
</form>

<div class="tabela" >
<table id="tabelaConsulta" class="tabela">
            <th>Data</th>
            <th>Nome cliente</th>
            <th>Status</th>            
            <th>Produtos</th>
            <th>Alterar </th>
                      
            <?php               
                require_once("conexaoBanco.php");
                $comando="";

                if(isset($_GET['cpf']) && $_GET['cpf']!=""){
                    $cpf=$_GET['cpf'];
                    $comando="SELECT clientes.nome,clientes.sobrenome, pedidos.* FROM clientes INNER JOIN usuarios ON 
                   usuarios.idUsuario=clientes.usuarios_idUsuario INNER JOIN pedidos ON 
                   pedidos.usuarios_idUsuario=usuarios.idUsuario WHERE clientes.cpf LIKE '".$cpf."%'";
                   
                }else{
                    $comando="SELECT clientes.nome,clientes.sobrenome, pedidos.* FROM clientes INNER JOIN usuarios ON 
                   usuarios.idUsuario=clientes.usuarios_idUsuario INNER JOIN pedidos ON 
                   pedidos.usuarios_idUsuario=usuarios.idUsuario";
                }

                $resultado=mysqli_query($conexao,$comando);

                $pedidos=array();
                while($cadaPedido = mysqli_fetch_assoc($resultado)){
                    array_push($pedidos,$cadaPedido);
                }

                foreach($pedidos as $cadaPedido){ ?>

                <tr>
                    <td> <?=$cadaPedido['data']?> </td>
                    <td> <?php echo $cadaPedido['nome']." ".$cadaPedido['sobrenome']; ?> </td>
                    <td> <?php
                    
                    if($cadaPedido['status']==1){
                        echo "Em aberto";
                    }else if($cadaPedido['status']==2){
                        echo "Em andamento";
                    }else{
                        echo "Finalizado";
                    }
                    
                    ?> </td>
                    <td>
                        <form action="visualizaProdutosAdm.php" method="POST">                                        
                                <input type="hidden" value="<?=$cadaPedido['idPedido']?>" name="idPedido">
                                <button class="botoes" type="submit" id="icones"> <img src="../img/visualizar.png" id="imagemVisualizar">    
                        </form>
                    </td>
                    <td>
                        <form action="alterarStatusPedidoForm.php" method="POST"> 
                             
                                <input type="hidden" value="<?=$cadaPedido['nome']?>" name="nomeCliente">
                                <input type="hidden" value="<?=$cadaPedido['data']?>" name="dataPedido">                                      
                                <input type="hidden" value="<?=$cadaPedido['idPedido']?>" name="idPedido">
                                <button class="botoes" type="submit" id="icones"> <img src="../img/alterarStatus.png" id="imagemVisualizar">    
                        </form>
                    </td>
                </tr>

        <?php            
                }


               
            ?>

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