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
</head>

<body>

    <div class="container">
        <center><img width="250" class="img-responsive" src="img/logo.png"></center>

        <form method="post" action="validaLogin.php" class="form-signin">
            <br>
            <br>

            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" name="email" id="email" class="form-control" placeholder="E-mail" required autofocus>
            <br>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="senha" id="senha" class="form-control" placeholder="Senha" required>
            <br>
            <button class="btn btn-lg btn-success btn-block" type="submit">Entrar</button>
            <button class="btn btn-lg btn-basic btn-block" type="button" onclick="location.href='telaCadastro.php'">Cadastro</button>
        </form>
        <br>


    </div>



</body>
</html>
