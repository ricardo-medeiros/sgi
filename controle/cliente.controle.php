<?php
	//define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/modelo/cliente.model.php');
	//require_once "../modelo/cliente.model.php";
	require_once(__ROOT__.'/dao/daoCliente.php');
    //require_once '../dao/daoCliente.php';

	class Cliente_Controle{	

		function salvarCliente($cliente)
		{
			 $daoCliente = new daoCliente();
			 $ok = $daoCliente->salvarCliente($cliente); 
		
			 if (!$ok)
			 {
				echo 'Erro ao Salvar Cliente';
			 }
			 else 
			 {
				echo 'Cliente Salvo com Sucesso';
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 }
			 //header("Location:http://localhost:90/sgi/index.php"); //exemplo de redirecti
		}
	}
?>
