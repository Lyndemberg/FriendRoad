<!DOCTYPE html>
<html>
  <head>
      
    <script type="text/javascript" src='sweetalert/dist/sweetalert.min.js'></script>
    <link rel='stylesheet' type='text/css' href='sweetalert/dist/sweetalert.css'>
  </head>
  <body>

  </body>
</html>


<?php
include("conexao.php");
$conexao = open_database();
    if($conexao != null){
        $nome = $_POST['nome'];
        $nascimento = $_POST['nascimento'];
        $sexo = $_POST['sexo'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        $sql = "INSERT INTO usuario (nome,nascimento,sexo,telefone,email,senha)
                VALUES ('$nome','$nascimento','$sexo','$telefone','$email','$senha')";
        
        if(mysqli_query($conexao, $sql)){
            echo    "<script>
                        sweetAlert('Sucesso no cadastro', 'Usuário foi cadastrado com sucesso', 'success');
                        setTimeout(function() { location.href='index.php' }, 3000);
                    </script>";
        }else{
            echo    "<script>
                        sweetAlert('Falha no cadastro', 'Usuário já existe', 'error');
                        setTimeout(function() { window.history.back(); }, 3000);
                    </script>";
        }

      mysqli_close($conexao);
    }else{
        echo    "<script>
                        sweetAlert('Falha no cadastro', 'Erro na conexão com o banco', 'error');
                        setTimeout(function() { window.history.back(); }, 3000);
                </script>";
    }


?>
