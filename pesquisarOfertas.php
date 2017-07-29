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


	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="">
	<meta name="author" content="">
	<!-- Website Font style -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src='sweetalert/dist/sweetalert.min.js'></script>
	<link rel='stylesheet' type='text/css' href='sweetalert/dist/sweetalert.css'>
	<title>FriendRoad - Oferecer Carona</title>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/flatpickr/dist/flatpickr.min.css">
	<script src="https://unpkg.com/flatpickr"></script>
	<style>
		#mapa {
			height: 500px;
			float: left;
			margin-top: 20px;

		}

		.closebtn {
			margin-left: 15px;
			padding: 5px;
			background-color: red;
			color: white;
			cursor: pointer;
			font-weight: bolder;
			border-radius: 5px;
		}

	</style>

	</head>
	<body>

		<div id="container" class="container" style="margin:2%">
			<div class="row">
				<div class="col-sm-3">
					<form action="listarOfertas.php" method="post">
						<h4>Origem</h4>
						<input type="text" name="textoOrigem" id="textoOrigem" class="form-control" disabled><br>
						<input type="button" name="origem" id="origem" class="btn btn-block" value="Abrir mapa"><br>
						<h4>Destino</h4>
						<input type="text" name="textoDestino" id="textoDestino" class="form-control" disabled><br>
						<input type="button" name="destino" id="destino" class="btn btn-block" value="Abrir mapa"><br>
						<input id="dataViagem" name="dataViagem" placeholder="Selecione a Data" type='text' class="form-control" /><br>

						<button id="buttonBuscar" class="btn btn-lg btn-success btn-block" type="submit">Buscar</button>
						<input type="text" name="locationOrigem" id="locationOrigem" class="form-control invisible">
						<input type="text" name="locationDestino" id="locationDestino" class="form-control invisible">
					</form>
				</div>

				<div id="mapa" class="col-sm-8">


				</div>
			</div>
		</div>
		<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script type="text/javascript" src="buscar.js"></script>
	</body>

</html>
