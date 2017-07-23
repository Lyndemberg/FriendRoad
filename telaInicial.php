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
    <style>

    </style>
    <meta charset="utf-8">
    <title>FriendRoad - Início</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src='sweetalert/dist/sweetalert.min.js'></script>
    <link rel='stylesheet' type='text/css' href='sweetalert/dist/sweetalert.css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
  </head>
  <body>
      <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">FriendRoad</a>
            </div>
            <ul class="nav navbar-nav">
              <li class="active"><a href="telaInicial.php">Pagina Inicial</a></li>
              <li><a href="telaPerfil.php">Perfil</a></li>
              <li><a href="finalizaSessao.php">Logout</a></li>
            </ul>
        </div>
      </nav>
        <center>
        <a  href="telaCarona.php" class="btn btn-primary btn-lg">
            <i style="font-size:40pt" class="fa fa-car" aria-hidden="true"></i>
            <h3>Oferecer Carona</h3>
        </a><br><br>
        <a href="listarOfertas.php" class="btn btn-primary btn-lg">
            <i style="font-size:40pt" class="fa fa-bars" aria-hidden="true"></i>
            <h3>Ver ofertas</h3>
        </a>
      
      </center>

     
  </body>
</html>






