<!DOCTYPE html>
<html lang="en">
<head>
<title>Cliente</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
	});
</script>
</head>
<body style="margin: 0">
	<div id="menu">
		<?php
                include("../cabecalho/menu.php");
            ?>
	</div>
	<div id="lista">
		 <iframe src="listaCliente.php" id="cliente" style="display: block; border: none; height: 100vh; width: 100vw;"></iframe> 
		 <!-- <object data="listaCliente.php" type="text/html" style="display: block; border: none; height: 100vh; width: 100vw;"></object> --> 
	</div>
	<div id="rodape">
		<?php
                include("../rodape/rodape.php");
            ?>
	</div> 
</body>
</html>

<!-- 
<html>
<head>
    <meta charset="ISO-8859-1" http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<body> 

<?php
	echo '<h1>Ola Mundo!</h1><br/><br/>';
?>

<form action="#" method="post" enctype="multipart/form-data">
    <p>
        Upload a new photo to the server:<br/><br/><br/>
        <input type="file" name="fileUpload"/><br/><br/>
        <input type="submit" value="Upload photo"/>
    </p>
</form>

</body>
</head>
</html>

<?php
   if(isset($_FILES['fileUpload']))
   {
      //date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
 
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extensão do arquivo
      $new_name = 'teste' . $ext; //Definindo um novo nome para o arquivo
      $env_var = getenv('OPENSHIFT_DATA_DIR') ."uploads/". $new_name;
      //$dir = 'uploads/'; //Diretório para uploads
 
      //move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $env_var); //Fazer upload do arquivo
      echo $env_var .'<br/>';
      echo ($_SERVER['REQUEST_URI']);
   }
   //$env_var = getenv('OPENSHIFT_DATA_DIR');
   
?>-->
