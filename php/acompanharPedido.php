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
    <script src="../js/funcoesPedidoLivros.js"></script>
    <title>Acompanhar pedido - Cliente</title>
</head>
<body>

<?php       include("menuCliente.php");   ?>


<section id="conteudoPrincipal">
    <h1 id="tituloPrincipal">Acompanhar pedido </h1>
    
<form action="#" method="GET" id="formularioCadastro">
    
    <fieldset>
        <legend> Informe os filtros</legend>

        <div class="informacoes" id="camposAcompanhaPedido">

            <label for="dataInicial" class="labelsForm">Data Inicial</label>
            <input type="date" name="dataInicial" id="dataInicial" class="camposForm"><br>
            
            <label for="dataFinal" class="labelsForm">Data Final</label>
            <input type="date" name="dataFinal" id="dataFinal" class="camposForm">         
        </div>
        <button type="submit" class="botoes" id="icones">
                <img src="../img/blackSearch.png" alt="Botão pesquisar" id="pesquisaIcone">

        </button>
            
    </fieldset>       
    
</form>

<div id="exibicaoConsulta">
        <table id="tabelaConsulta">
            <th>Data</th>
            <th>Status</th>
            <!--<th>Produtos</th>-->
            <th>Ações</th>
                      
            <?php               
                require_once("conexaoBanco.php");
                $comando="";
                $dataInicial="";
                $dataFinal=""; 
                $idCliente=$_SESSION['idUsuario'];

                /**Se o cliente clicou no botão de pesquisa...*/
                if(isset($_GET['dataInicial'])==true || isset($_GET['dataFinal'])==true){
                    $dataInicial=$_GET['dataInicial'];
                    $dataFinal=$_GET['dataFinal'];                        
                   
                    if($dataInicial!="" && $dataFinal==""){
                        /**Captura a data inicial informada, a final, será usada a de hoje */
                        $dataInicial=$_GET['dataInicial'];
                        $dataFinal=date("Y-m-d");                                 
                    
                    /**Se somente a data final foi informada... */ 
                    }else if($dataInicial=="" && $dataFinal!=""){
                        /**Captura a data final informada, a inicial, será usada primeira data possível */
                        $dataFinal=$_GET['dataFinal']; 
                        $dataInicial='2010-01-01';      
                  
                    }else if($dataInicial=="" && $dataFinal==""){
                        $dataInicial='2010-01-01'; 
                        $dataFinal=date("Y-m-d");

                    }            
                    $comando="SELECT * FROM pedidos WHERE usuarios_idUsuario=".$idCliente." AND data BETWEEN '".$dataInicial."' AND '".$dataFinal."'";
                    $resultado=mysqli_query($conexao,$comando);
                    $linhas = mysqli_num_rows($resultado);
                
                    if($linhas==0){
                        echo "<tr><td colspan='3'>
                        Nenhum pedido encontrado!
                        </td></tr>";
                    }else{
                        $pedidos=array();
                        while($cadaPedido = mysqli_fetch_assoc($resultado)){
                            array_push($pedidos,$cadaPedido);
                        }
                        foreach($pedidos as $cadaPedido){ ?>
                        
                        <tr>
                                <td><?php echo date('d/m/Y',  strtotime($cadaPedido['data'])); ?></td>                   
                                <td> 
                                <?php
                                    if($cadaPedido['status']==1){
                                        echo "Em aberto";
                                    }else if($cadaPedido['status']==2){
                                        echo "Em andamento";
                                    }else{
                                        echo "Finalizado";
                                    }    
                                ?>
                            
                                </td>
                                <td> 
                                    <form action="visualizaProdutos.php" method="POST">                                        
                                        <input type="hidden" value="<?=$cadaPedido['idPedido']?>" name="idPedido">
                                        <button class="botoes" type="submit" id="icones"> <img src="../img/visualizar.png" >    
                                    </form>
                                </td>  
                        </tr>


<?php
                        }//fechamento foreach
                    }//fechamento else
                }//fechamento if
?>
                
       

</section>
    
    
</body>
</html>

<?php

}else if(isset($_SESSION['idUsuario'])==true && $_SESSION['permissao']==1){
    header("Location: semPermissao.php");
}else if(isset($_SESSION['idUsuario'])==false){
    header("Location: facaLogin.php");
}


?>