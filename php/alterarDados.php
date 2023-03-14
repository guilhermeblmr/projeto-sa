<?php
session_start();
if(isset($_SESSION['idUsuario'])==true && 
$_SESSION['permissao']==2){
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/faleConosco.css">
    <link rel="stylesheet" href="../css/geralAdm.css">
    <script src="../js/cliente.js"></script>
    <title>Alteração de dados Cliente</title>
</head>

<body>
<?php 
    if(isset($_GET['retorno']) && $_GET['retorno']==1){
        echo "<script> 
                alert('Alteração de dados feita com sucesso');
            </script>";
    }else if(isset($_GET['retorno']) && $_GET['retorno']==2){
        echo "<script> 
                alert('Erro ao fazer alteração');
            </script>";
    }
?>

<?php
        include("menuCliente.php");
        
    ?>

    <?php 
    
    require_once("conexaoBanco.php");
    $comando = "SELECT * FROM clientes WHERE usuarios_idUsuario = ". $_SESSION['idUsuario'];
    $resultado = mysqli_query($conexao,$comando);
    $clientes = mysqli_fetch_assoc($resultado);
    //var_dump($clientes);


    
    ?>




<div class="limiter" >
		<div class="blocoFale" >
			<div class="fundoBloc">
				<form action="editarDados.php" method="POST">

                <span class="tituloLogin">
						Alterar dados Cliente
					</span>

                    <div class="iconeInput">          
                        <input type="text" value="<?=$clientes['nome']?>" name="nome" id="nome" class="caixaInput" placeholder="Nome">
                        </div>
                    <div class="iconeInput">       
                        <input type="text" value="<?=$clientes['sobrenome']?>" name="sobrenome" id="sobrenome" class="caixaInput" placeholder="Sobrenome">
                    
					</div>

                    <div class="iconeInput">
                        <input type="text" value="<?=$clientes['email']?>" name="email" id="email" placeholder="E-mail" class="caixaInput">
                    </div>

                        
                    <div class="iconeInput">
                            <input type="number" value="<?=$clientes['cpf']?>" name="cpf" id="cpf" class="caixaInput" placeholder="CPF Ex:..111 111 111 11">
                    </div>

                    <div class="iconeInput">
                            <input type="text" value="<?=$clientes['telefone']?>" name="telefone" id="telefone" class="caixaInput" placeholder="Telefone">
                    </div>

                    <div class="iconeInput">
                        <input type="text" value="<?=$clientes['endereco']?>" name="endereco" id="endereco" placeholder="Endereço" class="caixaInput">
                    </div>


                    <div class="iconeInput">
                        <input type="password"  name="senha" id="senha" placeholder="Senha" class="caixaInput">
                    </div>
                    
                    <input type="hidden" value="<?=$clientes['idCliente']?>" name="idCliente" id="idCliente" >

                    <div class="botao">
                            <button type="reset" class="estBotaoLimpar"  id="botao">Limpar
                               
                            </button>
                    
                            <button type="submit" class="estBotao" id="botao"
                            onclick="return validaFormulario()" >Enviar
                                   
                            </button>
                        </div>


				</form>
			</div>
		</div>
	</div>

</body>
</html>



<?php

}else if(isset($_SESSION['idUsuario'])==true && 
$_SESSION['permissao']==1){
    header("Location: semPermissao.php");
}else if(isset($_SESSION['idUsuario'])==false){
    header("Location: facaLogin.php");
}
?>