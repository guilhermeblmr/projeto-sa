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
    <title>Principal - ADM</title>
</head>
<body id="fundoAdm">
   
    <?php
        include("menuAdm.php");
    ?>
    
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