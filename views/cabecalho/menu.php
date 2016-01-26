<?php 
	session_start();

	if( isset($_SESSION['LAST_REQUEST']) &&
	(time() - $_SESSION['LAST_REQUEST'] > 300) ) {
		session_unset();
		session_destroy();
		header("Location: http://localhost:90/sgi/index.php");
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
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
  <div id="menu">
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#">SGI-WEB</a><br/><br/>
            </div>
            <ul class="nav navbar-nav">
              <li class="active"><a href="http://localhost:90/sgi/views/site/principal.php">Home</a></li>
              <li><a href="http://localhost:90/sgi/views/site/professor.php">Professor</a></li>
              <li><a href="http://localhost:90/sgi/views/site/aluno.php">Aluno</a></li> 
              <li><a href="http://localhost:90/sgi/views/site/turma.php">Turma</a></li>
              <li><a href="http://localhost:90/sgi/controle/logout.controller.php">Sair</a></li>  
            </ul>
          </div>
          <div class="collapse navbar-collapse">
	         <ul class="nav navbar-nav">
	      	   <li style="color: white; font-size: 11px;">Corretor(a): <?php echo $nome ?></li>
	         </ul>
	      </div>
        </nav>
    </div>    
</body>
