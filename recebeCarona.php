<?php

$origem = $_REQUEST['origem'];
$destino = $_REQUEST['destino'];
$dataViagem = $_REQUEST['dataViagem'];
$horaViagem = $_REQUEST['horaViagem'];
$distancia = $_REQUEST['distancia'];
$horaChegada = $_REQUEST['horaChegada'];
$passagens = $_REQUEST['passagens'];
$arrayPassagens = json_decode($passagens);

echo $origem;
echo $destino;
echo $dataViagem;
echo $horaViagem;
echo $distancia;
echo $horaChegada;
echo $arrayPassagens[0]->location;


?>