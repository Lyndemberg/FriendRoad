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

				<h4>Origem</h4>
				<input type="text" name="textoOrigem" id="textoOrigem" class="form-control" disabled><br>
				<input type="button" name="origem" id="origem" class="btn btn-block" value="Abrir mapa">

				<h4>Destino</h4>
				<input type="text" name="textoDestino" id="textoDestino" class="form-control" disabled><br>
				<input type="button" name="destino" id="destino" class="btn btn-block" value="Abrir mapa">
				<h4>Passagens</h4>
				<div id="recebePassagens">

				</div>
				<input type="button" name="passagem" id="passagem" class="btn btn-block" value="Adicionar passagem">

				<h4>Data da viagem</h4>


				<input id="data" name="data"  placeholder="Selecione a Data" type='text' class="form-control" />



				<h4>Hora da saída</h4>
				<input id="hora" name="hora" placeholder="Selecione a Hora" type='text' class="form-control" />

				<h4>Ajuda de custo</h4>
				<input class="form-control" id="ajudaCusto" type="number" />
				<br>
				<button id="buttonAtualizar" class="btn btn-lg btn-success btn-block" type="submit">Atualizar</button>

			</div>

			<div class="row">
				<div class="col-sm-3">
					<h5>Distância (Km)</h5>
					<input type="text" name="textoDistancia" id="textoDistancia" class="form-control" disabled>
				</div>
				<div class="col-sm-3">
					<h5>Hora de chegada</h5>
					<input type="text" name="textoHora" id="textoHora" class="form-control" disabled>
				</div>

				<div id="mapa" class="col-sm-8">


				</div>
			</div>



		</div>

	</div>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDNRg0GX1uE_jorzRcTAbP2c1r9wx5B9Rs"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript" src="atualizar.js"></script>

	<?php
	
		$dataViagem = $_GET['data'];
		$horasaida = $_GET['hora'];	
		include("conexao.php");
		$conexao = open_database();
		$sql = "SELECT origem,destino, ST_X(origemgeom) AS origemLat, ST_Y(origemgeom) AS origemLng,ST_X(destinogeom) AS destinoLat,ST_Y(destinogeom) AS destinoLng,ajudacusto,horachegada,distancia
				FROM carona
				WHERE emailusuario='$logado' AND dataviagem='$dataViagem' AND horasaida='$horasaida'";
		$result = pg_query($conexao,$sql);
		while($row = pg_fetch_assoc($result)){
			$origem = $row['origem'];
			$destino = $row['destino'];
			$origemLocation = $row['origemlat']." ".$row['origemlng'];
			$destinoLocation = $row['destinolat']." ".$row['destinolng'];
			$ajudacusto = $row['ajudacusto'];
			$horachegada = $row['horachegada'];
			$distancia = $row['distancia'];	
		}
	
		$sql2 = "SELECT nome, ST_X(geom) AS passagemLat, ST_Y(geom) AS passagemLng
				FROM passagem
				WHERE emailusuario='$logado' AND dataviagem='$dataViagem' AND horasaida='$horasaida'";
		$result2 = pg_query($conexao, $sql2);
		
		if(pg_num_rows($result2)>0){
			$passagens = array();	
			$passagensGeo = array();
			while($row2 = pg_fetch_assoc($result2)){
				$passagemLocation = $row2['passagemlat']." ".$row2['passagemlng'];
				array_push($passagens, $row2['nome']);	
				array_push($passagensGeo, $passagemLocation);	
				
			}
			
		}
		
		
		pg_close($conexao);
		

	?>


		<script type="text/javascript">
			dataViagem = "<?php echo $dataViagem ?>";
			horaViagem = "<?php echo $horasaida ?>";
			dataAntiga = "<?php echo $dataViagem ?>";
			horaAntiga = "<?php echo $horasaida ?>";
			flatpickr("#data", {
				defaultDate: dataViagem
			});
			
			flatpickr("#hora", {
				enableTime: true,
				noCalendar: true,

				enableSeconds: false, // disabled by default

				time_24hr: true, // AM/PM time picker is used by default

				// default format
				dateFormat: "H:i",

				// initial values for time. don't use these to preload a date
				defaultHour: 12,
				defaultMinute: 0,

				// Preload time with defaultDate instead:
				defaultDate: horaViagem

			});

			textoOrigem.value = "<?php echo $origem ?>";
			textoDestino.value = "<?php echo $destino ?>";
			ajudaCusto.value = "<?php echo $ajudacusto ?>";
			textoDistancia.value = "<?php echo $distancia ?>";
			textoHora.value = "<?php echo $horachegada ?>";
			origemGeo = "<?php echo $origemLocation ?>";
			destinoGeo = "<?php echo $destinoLocation ?>";
			
			var pas = <?php echo json_encode($passagens) ?>;
			var pasGeo = <?php echo json_encode($passagensGeo) ?>;
			if (pas != null) {
				for (var i = 0; i < pas.length; i++) {
					passagens.push({
						location: pas[i]
					});
					passagensGeo.push(pasGeo[i]);
					adicionaPassagemHTML(passagens[i].location);
				}
			}
			map = new google.maps.Map(document.getElementById('mapa'), {
				zoom: 8
			});
		
			criaDirection(textoOrigem.value, textoDestino.value, map);

		</script>
</body>

</html>
