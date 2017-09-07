<!DOCTYPE html>
<html lang="en">
<head>
<title>SGI-WEB</title>
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
        <div id="corpo" class="container" style="padding-top: 80px">
            
        </div>
        <div id="rodape">
            <?php
                include("../rodape/rodape.php");
            ?>
        </div>
    </body>
</html>

<!-- Teste de webservice wsdl da Fiocruz -->
            <!--<?php 
            
	            class Lstmaterial{
	            	public $lstMaterial;	            
	            	public  $msgErro;
	            }            
	            
	            $client = new SoapClient('http://homolog.almox.fiocruz.br/aServiceMat.aspx?WSDL');
	            
	            $function = 'Execute';
	            
	            $arguments= array('Execute' => array(
	            		'Login'   => 'admin',
	            		'Senha'   => '123',
	            		'Matcod'  => 0,
	            		'Mattp'   => 0,
	            		'Matresdsc'   => 'copo',
	            		'Matcntsiafini'   => 0,
	            		'Matcntsiaffim'        => 0
	            ));
	            $options = array('location' => 'http://homolog.almox.fiocruz.br/aservicemat.aspx');
	            
	           	            
	            $result = $client->__soapCall($function, $arguments, $options);
	            
	            echo 'Response: ';
	            $mat = new Lstmaterial();
	            $mat = $result;
	            $material = 'lstMaterial.material';
	            
	            if (isset($result->Lstmaterial->$material->msgErro) <> '')
	            {
	            	echo $result->Lstmaterial->$material->msgErro;
	            }
	            else {

		            $itens = Array();
		            $itens = $result->Lstmaterial->$material;
		            
		            foreach ($itens as $item)
		            {
	
		            	foreach ($item as $mat)
		            	{
		            		if (isset($mat->Mattp)){
		            			echo "<br>". ($mat->Mattp) ." ";
		            		}
		            		if (isset($mat->MatCod)){
		            			echo ($mat->MatCod) ." ";
		            		}
		            		if (isset($mat->MatResDsc)){
		            			echo ($mat->MatResDsc) ." ";
		            		}
		            		if (isset($mat->MatUniMed)){
		            			echo ($mat->MatUniMed) ." ";
		            		}
		            		if (isset($mat->MatCntSiafi)){
		            			echo ($mat->MatCntSiafi) ." ";
		            		}         	            			            		           
		            	}
		            }
	            }	            
            ?>-->
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