
<html>
<head>
    <meta charset="ISO-8859-1" http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<body>
<?php
	echo '<h1>Ol� Mundo!</h1><br/><br/>';
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
<img alt="" src="http://sgi-programasweb.rhcloud.com/uploads/teste.jpg">
</body>
</head>
</html>

<?php
   if(isset($_FILES['fileUpload']))
   {
      //date_default_timezone_set("Brazil/East"); //Definindo timezone padr�o
 
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extens�o do arquivo
      $new_name = 'teste' . $ext; //Definindo um novo nome para o arquivo
      $env_var = getenv('OPENSHIFT_DATA_DIR') ."uploads/". $new_name;
      //$dir = 'uploads/'; //Diret�rio para uploads
 
      //move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $env_var); //Fazer upload do arquivo
      echo $env_var .'<br/>';
      echo ($_SERVER['REQUEST_URI']);
   }
   //$env_var = getenv('OPENSHIFT_DATA_DIR');
   
?>