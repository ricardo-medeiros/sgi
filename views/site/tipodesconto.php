<!DOCTYPE html>
<html lang="en">
<head>
<title>Tipo de Desconto</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta charset="iso-8859-1"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--   <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"></link> -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
    <body>
        <div id="menu">
            <?php
                include("../cabecalho/menu.php");
            ?>
        </div>
        <div id="corpo">
            <object data="listaTipoDesconto.php" type="text/html" style="display: block; border: none; height: 100vh; width: 100vw;"></object>
        </div>
        <div id="rodape">
            <?php
                include("../rodape/rodape.php");
            ?>
        </div>
    </body>
</html>


