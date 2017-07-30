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
        include("navbar.php");
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

        <center>
        <a  href="telaOferecer.php" class="btn btn-primary btn-lg">
            <i style="font-size:40pt" class="fa fa-car" aria-hidden="true"></i>
            <h3>Oferecer Carona</h3>
        </a><br><br>
        <a href="pesquisarOfertas.php" class="btn btn-primary btn-lg">
            <i style="font-size:40pt" class="fa fa-search" aria-hidden="true"></i>
            <h3>Pesquisar ofertas</h3>
        </a><br><br>
		<a href="minhasCaronas.php" class="btn btn-primary btn-lg">
            <i style="font-size:40pt" class="fa fa-bars" aria-hidden="true"></i>
            <h3>Minhas caronas</h3>
        </a>

      </center>


  </body>
</html>
