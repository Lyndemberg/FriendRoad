<?php

session_start();
if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){
	unset($_SESSION['login']);
  	unset($_SESSION['senha']);
  	header('location:index.php');
}
$logado = $_SESSION['email'];


include("conexao.php");
include("navbar.php");

$origem = $_POST['locationOrigem'];
$destino = $_POST['locationDestino'];
$dataViagem = $_POST['dataViagem'];

$conexao = open_database();

if($conexao != null){
	$sql = "(SELECT c.emailusuario, c.dataviagem,c.horasaida
			FROM carona c
			WHERE c.dataviagem='$dataViagem'
			AND (ST_Distance(ST_GeomFromText('POINT($origem)'),c.origemgeom)*40075/360<=20
			OR ST_Distance(ST_GeomFromText('POINT($destino)'),c.destinogeom)*40075/360<=20
			))
			UNION
			(SELECT p.emailusuario, p.dataviagem, p.horasaida
			FROM passagem p
			WHERE p.dataviagem='$dataViagem'
			AND (ST_Distance(ST_GeomFromText('POINT($origem)'),p.geom)*40075/360<=20
			OR ST_Distance(ST_GeomFromText('POINT($destino)'),p.geom)*40075/360<=20
			))";
	$result = pg_query($conexao, $sql);
	echo "
			<table class='table table-striped'>
			<thead>
				<tr>
					<th>Origem</th>
					<th>Destino</th>
					<th>Data da Viagem</th>
					<th>Hora Saída</th>
					<th>Ajuda</th>
					<th>Hora Chegada</th>
					<th>Distância</th>
					<th>Passagens</th>
					
				</tr>
			</thead>
			<tbody>
	
	
	";
	
	while ($row = pg_fetch_assoc($result)) {
		$passagens = null;
		echo "<tr>";
		$usuario = $row['emailusuario'];
      	$data = $row['dataviagem'];
      	$horasaida = $row['horasaida'];
		$sql2 = "SELECT origem,destino,dataviagem,horasaida,ajudacusto,horachegada,distancia
				FROM carona
				WHERE emailusuario='$usuario' AND dataviagem='$data' AND horasaida='$horasaida'";
		$result2 = pg_query($conexao, $sql2);
		while($row2 = pg_fetch_assoc($result2)){
			$origemImprimir = $row2['origem'];
			$destinoImprimir = $row2['destino'];
			$dataViagemImprimir = $row2['dataviagem'];
			$horaSaidaImprimir = $row2['horasaida'];
			$ajudaCustoImprimir = $row2['ajudacusto'];
			$horaChegadaImprimir = $row2['horachegada'];
			$distanciaImprimir = $row2['distancia'];
			echo "<td>$origemImprimir</td>";
			echo "<td>$destinoImprimir</td>";
			echo "<td>$dataViagemImprimir</td>";
			echo "<td>$horaSaidaImprimir</td>";
			echo "<td>$ajudaCustoImprimir</td>";
			echo "<td>$horaChegadaImprimir</td>";
			echo "<td>$distanciaImprimir</td>";
		}
		$sql3 = "SELECT nome FROM passagem WHERE emailusuario='$usuario' AND dataviagem='$data' AND horasaida='$horasaida'";
		$result3 = pg_query($conexao, $sql3);
		
		while($row3 = pg_fetch_assoc($result3)){
			$passagem = $row3['nome'];
			$passagens.=" - ".$passagem;
		}
		echo "<td>$passagens</td>";
      	echo "</tr>";
	}
	echo "</tbody>
		</table>";
	pg_close($conexao);
}



	




 ?>
