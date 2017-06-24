<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta charset="utf-8">
    <title>FriendRoad - Início</title>
    <script type="text/javascript" src='sweetalert/dist/sweetalert.min.js'></script>
    <link rel='stylesheet' type='text/css' href='sweetalert/dist/sweetalert.css'>
  </head>
  <body>
    
  </body>
</html>

<?php
    
    session_start();
    include("conexao.php");
    $conexao = open_database();                                 
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $sql = "SELECT * FROM usuario where email='$email' and senha='$senha'";
    $result = mysqli_query($conexao, $sql);
    if ($result->num_rows > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        header("location: telaInicial.php");
    } else {
        echo    "<script>
                        sweetAlert('Falha na autenticação', 'Erro ao fazer o login', 'error');
                        setTimeout(function() { window.history.back(); }, 3000);
                </script>";
        unset ($_SESSION['email']);
        unset ($_SESSION['senha']);   
    }
    mysqli_close($conexao);

?>


