<?php

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>

    <title>FriendRoad - Cadastro</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="row main">
            <div class="main-login main-center">
                <h1 align="center">Cadastro</h1>
                <form method="post" action="cadastrar.php">

                    <div class="form-group">
                        <label for="nome" class="cols-sm-2 control-label">Nome</label>
                        <div  class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="nome" id="nome" placeholder="Insira seu nome" required/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="nascimento" class="cols-sm-2 control-label">Nascimento</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>
                                <input type="date" class="form-control" name="nascimento" id="nascimento" placeholder="Insira a data de nascimento" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="sexo" class="cols-sm-2 control-label">Sexo</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>
                                <select name="sexo" id="sexo" class="form-control">
                                  <option value="Masculino">Masculino</option>
                                  <option value="Feminino">Feminino</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label for="telefone" class="cols-sm-2 control-label">Telefone</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" name="telefone" id="telefone" placeholder="Ex: (00) 00000-0000" required/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="cols-sm-2 control-label">E-mail</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Insira seu e-mail" required/>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="senha" class="cols-sm-2 control-label">Senha</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="password" class="form-control" name="senha" id="senha" placeholder="Insira sua senha" required/>
                            </div>
                        </div>
                    </div>


                    <div class="form-group ">
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Enviar</button>
				    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>


</html>
