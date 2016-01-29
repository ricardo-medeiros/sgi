<?php 
	require_once(__ROOT__.'/modelo/cliente.model.php');
	require_once(__ROOT__.'/dao/conexao.php');
	require_once(__ROOT__.'/dao/daoCliente.php');
		
class daoCliente{
	
	public function daoCliente(){
		
	}	
	
	public function salvarCliente($cliente){
		$dao = new conexao();
		$conn = $dao->conectar();
		
		$sql = "INSERT INTO cliente(nome, email,cpf) VALUES(:nome, :email, :cpf)";
		
		$stmt = $conn->prepare($sql);
		
		$stmt->bindParam( ':nome', $cliente->nome );
		$stmt->bindParam( ':email', $cliente->email );
		$stmt->bindParam( ':cpf', $cliente->cpf );
		
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
	
	public function listaCliente(){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from cliente";
	
		$consulta = $conn->query($sql);
		$lista = new ArrayObject();
			
		while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
			$cliente = new Cliente_Model();
			$cliente->idCliente = $linha['idCliente'];
			$cliente->nome = $linha['nome'];
			$cliente->email = $linha['email'];
			$cliente->cpf = $linha['cpf'];
			$lista->append($cliente);
		}
		
		return $lista;
	
		$dao->desconectar();
	}
}	
?>