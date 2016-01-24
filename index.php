<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta charset="ISO-8859-1" http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<body>
<?php
	echo '<h1>Olá Mundo!</h1><br/><br/>';
?>
<!-- <form action="controle/cliente.controller.php" method="POST"> -->
<!-- 	Nome:<input type="text" name="nome" id="nome"/><br/> -->
<!-- 	Email:<input type="text" name="email" id="email"/><br/> -->
<!-- 	<input type="submit" name="salvar" value="Salvar" /> -->
<!-- </form> -->
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
      date_default_timezone_set("Brazil/East"); //Definindo timezone padrão
 
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extensão do arquivo
      $new_name = date("Y.m.d-H.i.s") . $ext; //Definindo um novo nome para o arquivo
      $dir = 'uploads/'; //Diretório para uploads
 
      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
   }
?>