<?php 
	
?>
<!DOCTYPE unspecified PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta charset="ISO-8859-1" http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<body>
<?php
echo '<h1>Olá Mundo!</h1><br/><br/>';


// $cliente = new Cliente();
// $cliente->setIdCliente(1);
// $cliente->setNome("Ricardo");

// echo $cliente->IdCliente();
// echo $cliente->Nome();

?>
<form action="controle/cliente.controller.php" method="POST">
	Nome:<input type="text" name="nome" id="nome"/><br/>
	Email:<input type="text" name="email" id="email"/><br/>
	<input type="submit" name="salvar" value="Salvar" />
</form>
<a href="controle/cliente.controller.php">Teste Conexao</a>
</body>
</head>
</html>
