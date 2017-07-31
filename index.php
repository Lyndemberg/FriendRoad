<?php





?>

<!DOCTYPE html>
<html lang="pt">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta name="description" content="">
	<meta name="author" content="">
	<title>FriendRoad - Login</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
		form{
			margin-top:80px;
		}


	</style>
</head>

<body>
				<div class="col-sm-4">

				</div>
				<div class="col-sm-4">
					<form method="post" action="validaLogin.php" class="form-signin">
						<center><img src="img/logo2.png"></center>
						<br>
						<br>
						<input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required autofocus>
						<br>

						<input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
						<br>
						<button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
						<button class="btn btn-lg btn-basic btn-block" type="button" onclick="location.href='telaCadastro.php'">Cadastro</button>
					</form>
				</div>



</body>

</html>
