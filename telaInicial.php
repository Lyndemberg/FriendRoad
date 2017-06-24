<!DOCTYPE html>
<html lang="pt">
  <head>
    <?php
        session_start();
        if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){
          unset($_SESSION['login']);
          unset($_SESSION['senha']);
          header('location:index.php');
        }
        $logado = $_SESSION['email'];
        echo "está logado";

    ?>
    <meta charset="utf-8">
    <title>FriendRoad - Início</title>
    <script type="text/javascript" src='sweetalert/dist/sweetalert.min.js'></script>
    <link rel='stylesheet' type='text/css' href='sweetalert/dist/sweetalert.css'>
  </head>
  <body>
      <form action="finalizaSessao.php">
        <button type="submit" formaction="finalizaSessao.php">SAIR</button>
      </form>
  </body>
</html>






