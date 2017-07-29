<?php


session_start();
if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){
	unset($_SESSION['login']);
  	unset($_SESSION['senha']);
  	header('location:index.php');
}
$logado = $_SESSION['email'];


include("conexao.php");

$origemGeo=$_REQUEST['origemGeo'];
$destinoGeo=$_REQUEST['destinoGeo'];
$arrayOrigem = json_decode($origemGeo,true);
$arrayDestino = json_decode($destinoGeo,true);
$origemLat = $arrayOrigem['lat'];
$origemLng = $arrayOrigem['lng']; 
$destinoLat = $arrayDestino['lat'];
$destinoLng = $arrayDestino['lng']; 
$passagensGeo = $_REQUEST['passagensGeo'];
$arrayPassagensGeo = json_decode($passagensGeo,true);
$passagens = $_REQUEST['passagens'];
$arrayPassagens = json_decode($passagens,true);
$origem = $_REQUEST['origem'];
$destino = $_REQUEST['destino'];
$dataViagem = $_REQUEST['dataViagem'];
$horaViagem = $_REQUEST['horaViagem'];
$distancia = $_REQUEST['distancia'];
$horaChegada = $_REQUEST['horaChegada'];
$ajuda = $_REQUEST['ajuda'];
$email = $logado;	

$con = open_database();
$retorno;

if($con != null){
	$pontoOrigem = "POINT($origemLat $origemLng)";
	$pontoDestino = "POINT($destinoLat $destinoLng)";
	$sql = "INSERT INTO carona (origem,destino,origemgeom,destinogeom,dataviagem,horasaida,ajudacusto,horachegada,distancia,emailUsuario) VALUES ('$origem','$destino',ST_GeomFromText('$pontoOrigem'),ST_GeomFromText('$pontoDestino'),'$dataViagem','$horaViagem',$ajuda,'$horaChegada',$distancia,'$email')";
	$result = pg_query($con, $sql);
	$resultadoCarona= pg_affected_rows($result);
	
	if (!empty($arrayPassagens)) {
		$contador = 0;
		$max = sizeof($arrayPassagens);
		for($i = 0; $i < $max; $i++){
			$passagemLat = $arrayPassagensGeo[$i][lat];
			$passagemLng = $arrayPassagensGeo[$i][lng];
			$pontoPassagem = "POINT($passagemLat $passagemLng)";
			$passagem = $arrayPassagens[$i][location];
			$sql2 = "INSERT INTO passagem (nome,geom, emailUsuario,dataviagem,horasaida) VALUES ('$passagem',ST_GeomFromText('$pontoPassagem'),'$email','$dataViagem','$horaViagem')";
			$result2 = pg_query($con, $sql2);
			$resultadoPassagem = pg_affected_rows($result2);
		}
	
	}
	
	
	if($resultadoCarona>0){
		$retorno = true;
	}else{
		$retorno = false;
	}
}
pg_close($con);
echo $retorno;

?>
