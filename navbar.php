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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src='sweetalert/dist/sweetalert.min.js'></script>
    <link rel='stylesheet' type='text/css' href='sweetalert/dist/sweetalert.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  </head>
  <body>
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="telaInicial.php">FriendRoad</a>
            </div>
            <ul class="nav navbar-nav">
              <li class="active"><a href="telaInicial.php">Pagina Inicial</a></li>
              <li><a href="telaPerfil.php">Perfil</a></li>
              <li><a href="finalizaSessao.php">Logout</a></li>
            </ul>
        </div>
      </nav>
     
  </body>
</html>






