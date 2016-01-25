<!DOCTYPE html>
<html lang="en">
<head>
<title>SGI-WEB</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script>
	$(document).ready(

	);

	function limpaMsg() {
		document.getElementById('msgEmail').innerText = "";
		document.getElementById('msgLogin').innerText = "";
	}
</script>
</head>
<body>
	<div id="menu">
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">SGI-WEB Sistema de
						Gerenciamento de Imoveis </a>
				</div>
			</div>
		</nav>
	</div>
	<!-- Login-->
	<div style="margin-top: 200px;" id="loginModal" tabindex="-1"
		role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
					<span aria-hidden="true">&times;</span>
				</button> -->
					<h4 class="modal-title" id="myModalLabel">SGI - Login</h4>
				</div>
				<div class="modal-body">
					<form name='f' action="/sgi/controle/login.controller.php" method='POST' data-toggle="validator"
						role="form">
						<div class="form-group">
							<label for="usuario" class="control-label">Login:</label> <input
								required type='email'
								pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
								class="form-control" id="usuario" name='j_username'
								placeholder="E-mail" />
						</div>
						<div class="form-group">
							<label for="senha" class="control-label">Senha:</label> <input
								required type='password' class="form-control" id="senha"
								name='j_password' placeholder="Senha" />
						</div>
						<div class="modal-footer">
							<label id="msgLogin" class="col-md-12" style="color: red;"></label>
							<input type="submit" name="submit" class="btn btn-success"
								value="Entrar" /> <br />
							<br />
							<div class="passwordRecoverLink col-md-12"
								style="text-align: right;">
								<a href="#" onclick="limpaMsg()" data-toggle="modal"
									data-target="#envio-modal" data-dismiss="modal">Recuperar
									Senha</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Envio de Senha -->
	<div class="modal fade" id="envio-modal" tabindex="-1" role="dialog"
		aria-labelledby="modalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<form action="#" method="POST" data-toggle="validator" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabel">Recuperar Senha</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="email" class="control-label">E-mail:</label> <input
								required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
								id="txtEmail" name="txtEmail" type="email"
								placeholder="Digite seu E-mail" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<label id="msgEmail" style="color: blue;"></label><br /> <input
							type="submit" name="submit" class="btn btn-success"
							value="Enviar" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</div>
				</form>
			</div>
		</div>
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