<?php 
	session_start();
	$site = $_SESSION["INDEX"];
	$code = base64_encode($_SESSION["USUARIO"]);
	if( isset($_SESSION['LAST_REQUEST']) &&
	(time() - $_SESSION['LAST_REQUEST'] > 1200) && $_SESSION["NOME"] != '') { //20 minutos
		session_unset();
		session_destroy();
		header('Location: ' .$site);
		exit();
	}
	else 
	{
		$nome = $_SESSION["NOME"];
	}

	$_SESSION['LAST_REQUEST'] = time();	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>SGI-WEB</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
	  <!-- <div class="container" style="text-align: left;"> -->
	  <div style="text-align: left;">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="#">
	      	<span aria-hidden="true">SGI-WEB</span>
	      </a>
	    </div>
	    <div class="collapse navbar-collapse">
	      <ul class="nav navbar-nav">
	        <li><a href="principal.php">Inicio</a></li>
	        <li class="menu-item dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Cadastros<b class="caret"></b></a>
	        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
	            <li class="menu-item "><a href="cliente.php">Clientes</a></li>
	            <li class="menu-item "><a href="imoveis.php">Imoveis</a></li>
	            <li class="menu-item "><a href="proprietario.php">Proprietarios</a></li>            
	        </ul>
	        <li><a href="contrato.php">Contratos</a></li>
	        <li class="menu-item dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Financeiro<b class="caret"></b></a>
	        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
		        <li class="menu-item "><a href="financeiro.php">A Receber</a></li>
	            <li class="menu-item "><a href="financeiro.php">A Pagar</a></li>
	        </ul>
	        <li class="menu-item dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">Relatorios<b class="caret"></b></a>
	        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
	            <li class="menu-item "><a href="relClientes.php">Clientes</a></li>
	            <li class="menu-item "><a href="imoveis.php">Imoveis</a></li>
	            <li class="menu-item "><a href="proprietario.php">Proprietarios</a></li>            
	        </ul>      
	        <li><a href="usuario.php?usuario=<?=$code?>">Corretor(a)</a></li>
	        <li><a href="ajuda.php">Ajuda</a></li>
	        <li><a href="<?=$_SESSION["LOGOUT"]?>">Sair</a></li>
	      </ul>
	    </div><!--/.nav-collapse -->
	    <div class="bar-login" style="text-align: left; margin-left: 15px;">
	      	 <span style="color: white; font-size: 11px;">Corretor(a): <?php echo $nome ?></span>
	    </div>
	  </div>
	</div>     
</body>
</html>
