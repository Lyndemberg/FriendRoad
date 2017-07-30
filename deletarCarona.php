<?php

	session_start();
	if((!isset ($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true)){
	  unset($_SESSION['login']);
	  unset($_SESSION['senha']);
	  header('location:index.php');
	}
	$logado = $_SESSION['email'];
	include("navbar.php");
	include("conexao.php");
	$conexao = open_database();
	

	$dataViagem = $_GET['data'];
	$horasaida = $_GET['hora'];

	if($conexao != null){
		$sql = "DELETE FROM carona WHERE emailusuario='$logado' AND dataviagem='$dataViagem' AND horasaida='$horasaida'";
		$result = pg_query($conexao, $sql);
		
		if(pg_affected_rows($result)>0){
			$sql2 = "SELECT nome FROM passagem WHERE emailusuario='$logado' AND dataviagem='$dataViagem' AND horasaida='$horasaida'";
			$result2 = pg_query($conexao, $sql2);
			if(pg_num_rows($result2)>0){
				$sql3 = "DELETE FROM passagem WHERE emailusuario='$logado' AND dataviagem='$dataViagem' AND horasaida='$horasaida'";
				$result3 = pg_query($conexao, $sql3);
			}
			echo    "<script>
                        sweetAlert('Sucesso', 'A carona foi removida com sucesso', 'success');
                        setTimeout(function() { location.href='minhasCaronas.php' }, 2000);
                    </script>";	
		}else{
			echo    "<script>
                        sweetAlert('Falha', 'A carona não foi removida com sucesso', 'error');
                        setTimeout(function() { location.href='minhasCaronas.php' }, 2000);
                    </script>";	
		}
	
		pg_close($conexao);
	}



	



?>