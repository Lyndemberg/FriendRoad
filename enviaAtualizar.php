<?php

	session_start();
	if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){
		unset($_SESSION['login']);
		unset($_SESSION['senha']);
		header('location:index.php');
	}
	$logado = $_SESSION['email'];

	include("conexao.php");

	$conexao = open_database();
	$retorno;

	$dataAntiga=$_REQUEST['dataAntiga'];
	$horaAntiga=$_REQUEST['horaAntiga'];
	$origem = $_REQUEST['origem'];
	$destino = $_REQUEST['destino'];
	$origemGeo = $_REQUEST['origemGeo'];
	$destinoGeo = $_REQUEST['destinoGeo'];
	$passagensGeo = $_REQUEST['passagensGeo'];
	$arrayPassagensGeo = json_decode($passagensGeo);
	$passagens = $_REQUEST['passagens'];
	$arrayPassagens = json_decode($passagens,true);
	$dataViagem = $_REQUEST['dataViagem'];
	$horaViagem = $_REQUEST['horaViagem'];
	$distancia = $_REQUEST['distancia'];
	$horaChegada = $_REQUEST['horaChegada'];
	$ajuda = $_REQUEST['ajuda'];


	if($conexao != null){
		$sql = "UPDATE carona 
				SET origem='$origem', destino='$destino', origemgeom=ST_GeomFromText('POINT($origemGeo)'), destinogeom=ST_GeomFromText('POINT($destinoGeo)'), dataviagem='$dataViagem', horasaida='$horaViagem', ajudacusto='$ajuda', horachegada='$horaChegada', distancia=$distancia  
				WHERE emailusuario='$logado' AND dataviagem='$dataAntiga' AND horasaida='$horaAntiga'";
		$result = pg_query($conexao, $sql);
		
		$sql2 = "SELECT nome
				FROM passagem
				WHERE emailusuario='$logado' AND dataviagem='$dataAntiga' AND horasaida='$horaAntiga'";
		$result2 = pg_query($conexao, $sql2);
		if(pg_num_rows($result2)>0){
			$sql3 = "DELETE FROM passagem WHERE emailusuario='$logado' AND dataviagem='$dataAntiga' AND horasaida='$horaAntiga'";
			pg_query($conexao, $sql3);
		}
		
		if (!empty($arrayPassagens)) {
			$max = sizeof($arrayPassagens);
			for($i = 0; $i < $max; $i++){
				$passagemGeo = $arrayPassagensGeo[$i];
				$passagem = $arrayPassagens[$i][location];
				$sql4 = "INSERT INTO passagem (nome,geom, emailUsuario,dataviagem,horasaida) VALUES ('$passagem',ST_GeomFromText('POINT($passagemGeo)'),'$logado','$dataViagem','$horaViagem')";
				pg_query($conexao, $sql4);
			}
		}
		
		if(pg_affected_rows($result)>0){
			$retorno = true;
		}else{
			$retorno = false;
		}
		
		
	}

	echo $retorno;
	pg_close($conexao);

	


?>