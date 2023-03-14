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
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/faleConosco.css">
    <script src="../js/cliente.js"></script>
    <title>Cadastro Cliente</title>
</head>

<body>
<?php 
    if(isset($_GET['retorno']) && $_GET['retorno']==1){
        echo "<script> 
                alert('Erro ao fazer cadastro');
            </script>";
    }
?>






<div class="limiter" >
		<div class="blocoFale" >
			<div class="fundoBloc">
				<form action="registroCliente.php" method="POST">

                <span class="tituloLogin">
						Cadastro Cliente
					</span>

                    <div class="iconeInput">          
                        <input type="text" name="nome" id="nome" class="caixaInput" placeholder="Nome">
                        </div>
                    <div class="iconeInput">       
                        <input type="text" name="sobrenome" id="sobrenome" class="caixaInput" placeholder="Sobrenome">
                    
					</div>

                    <div class="iconeInput">
                        <input type="text" name="email" id="email" placeholder="E-mail" class="caixaInput">
                    </div>

                        
                    <div class="iconeInput">
                            <input type="number" name="cpf" id="cpf" class="caixaInput" placeholder="CPF Ex:..111 111 111 11">
                    </div>

                    <div class="iconeInput">
                            <input type="number" name="telefone" id="telefone" class="caixaInput" placeholder="Telefone">
                    </div>

                    <div class="iconeInput">
                        <input type="text" name="endereco" id="endereco" placeholder="Endereço" class="caixaInput">
                    </div>


                    <div class="iconeInput">
                            <input type="text" name="usuario" id="usuario" class="caixaInput" placeholder="Usuario">
                    </div>

                    <div class="iconeInput">
                        <input type="password" name="senha" id="senha" placeholder="Senha" class="caixaInput">
                    </div>
                    

                    <div class="botao">
                            <button type="reset" class="estBotaoLimpar" id="botao">Limpar
                               
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
}
?>