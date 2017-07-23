<?php


?>

<!DOCTYPE html>
<html>

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
    <script type="text/javascript" src='sweetalert/dist/sweetalert.min.js'></script>
    <link rel='stylesheet' type='text/css' href='sweetalert/dist/sweetalert.css'>
    <title>FriendRoad - Oferecer Carona</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    
    <style>
        #mapa {height: 550px ; float:left;}
    
    </style>

</head>

<body>
    <div id="container" class="container" style="margin:3%">
        <div class="row">
            <div class="col-md-3">
                <form method="post" class="form-signin">
                    <h4>Origem</h4>
                    <input type="text" name="textoOrigem" id="textoOrigem" class="form-control"  disabled><br>
                    <input type="button" name="origem" id="origem" class="btn btn-block" value="Abrir mapa">
                    <br>
                    <h4>Destino</h4>
                    <input type="text" name="textoDestino" id="textoDestino" class="form-control"  disabled><br>
                    <input type="button" name="destino" id="destino" class="btn btn-block" value="Abrir mapa">
                    <br>
                    <h4>Passagens</h4>
                    <input type="button" name="passagem" id="passagem" class="btn btn-block" value="Adicionar passagem">
                    <br>
                    <h4>Data da viagem</h4>
                    <input type="date" class="form-control" name="nascimento" id="nascimento" placeholder="Insira a data de nascimento" required />
                    <br>
                    <h4>Hora da saída</h4>
                    <input class="form-control" type="time" required/>
                    <br>
                    <h4>Ajuda de custo</h4>
                    <input class="form-control" type="number" />
                    <br>
                    <button class="btn btn-lg btn-success btn-block" type="submit">Confirmar</button>
                </form>
            </div>
            <div id="mapa" class="col-md-8">


            </div>
        </div>
        
    </div>

    <script type="text/javascript" src="abrir.js"></script>
    
</body>

</html>
