<?php
  function open_database() {
	  $host = "localhost";
	  $port = "5432";
	  $dbname = "FriendRoad";
	  $user = "postgres";
	  $password = "pgadmin";
	  $pg_options = "--client_encoding=UTF8";
	  $connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password} options='{$pg_options}'";
	  $conexao = pg_connect($connection_string);
	  
	  if($conexao != FALSE){
		  return $conexao;
	  }else{
		  return null;
	  }
  }

  function close_database($conn) {
      return pg_close($conn);
  }

?>



<?php




