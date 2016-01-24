<?php 
	require_once "../modelo/cliente.model.php";
	require_once "../dao/conexao.php";
		
class daoCliente{
	
	public function daoCliente(){
		
	}	
	
	public function salvarCliente($cliente){
		$dao = new conexao();
		$conn = $dao->conectar();
		
		$sql = "INSERT INTO cliente(nome, email) VALUES(:nome, :email)";
		
		$stmt = $conn->prepare($sql);
		
		$stmt->bindParam( ':nome', $cliente->nome );
		$stmt->bindParam( ':email', $cliente->email );
		
		$result = $stmt->execute();
		
		if (!$result )
		{
			var_dump( $stmt->errorInfo() );
			return false;
		}
		else
		{
			return true;
		}
		
		$dao->desconectar();
	}
}	
?>