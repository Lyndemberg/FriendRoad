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

    ?>
    <meta charset="utf-8">
    <title>FriendRoad - Início</title>
    <script type="text/javascript" src='sweetalert/dist/sweetalert.min.js'></script>
    <link rel='stylesheet' type='text/css' href='sweetalert/dist/sweetalert.css'>
      
  </head>
  <body>
        <?php    
           if(session_destroy()){
              echo "sessao encerrada";
           }
           else{
              echo "erro ao sair da sessao";
           }
        ?> 
    
  </body>
</html>
