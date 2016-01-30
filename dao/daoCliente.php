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
		
		$sql = "INSERT INTO cliente(nome, email,cpf,status,rg,telefoneCelular,dataNascimento) VALUES(:nome, :email, :cpf, :status ,:rg, :telefoneCelular, :dataNascimento)";
		
		$stmt = $conn->prepare($sql);
		
		$stmt->bindParam( ':nome', $cliente->nome );
		$stmt->bindParam( ':email', $cliente->email );
		$stmt->bindParam( ':cpf', $cliente->cpf );
		$stmt->bindParam( ':status', $cliente->status );
		$stmt->bindParam( ':rg', $cliente->rg );
		$stmt->bindParam( ':telefoneCelular', $cliente->telefoneCelular );
		$stmt->bindParam( ':dataNascimento', $cliente->dataNascimento );
		
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
	
	public function alterarCliente($cliente){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "UPDATE cliente set nome = :nome, email= :email,cpf= :cpf,status= :status, rg= :rg, telefoneCelular= :telefoneCelular, dataNascimento= :dataNascimento where idCliente = :idCliente";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':nome', $cliente->nome );
		$stmt->bindParam( ':email', $cliente->email );
		$stmt->bindParam( ':cpf', $cliente->cpf );
		$stmt->bindParam( ':status', $cliente->status );
		$stmt->bindParam( ':rg', $cliente->rg );
		$stmt->bindParam( ':telefoneCelular', $cliente->telefoneCelular );
		$stmt->bindParam( ':dataNascimento', $cliente->dataNascimento );
		$stmt->bindParam( ':idCliente', $cliente->idCliente );
	
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
			$cliente->status= $linha["status"];
			$cliente->rg= $linha["rg"];
			$cliente->telefoneCelular = $linha["telefoneCelular"];
			$cliente->dataNascimento = $linha["dataNascimento"];
			$lista->append($cliente);
		}
		
		return $lista;
	
		$dao->desconectar();
	}
	
	public function excluirCliente($idCliente){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "delete from cliente where idCliente =" .$idCliente;
	
		$stmt = $conn->query($sql);
		
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
	
	public function getCliente($idCliente){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from cliente where idCliente =" .$idCliente;
	
		$consulta = $conn->query($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		
		$cliente = new Cliente_Model();
		$cliente->idCliente = $linha['idCliente'];
		$cliente->nome = $linha['nome'];
		$cliente->email = $linha['email'];
		$cliente->cpf = $linha['cpf'];
		$cliente->status= $linha["status"];
		$cliente->rg= $linha["rg"];
		$cliente->telefoneCelular = $linha["telefoneCelular"];
		$cliente->dataNascimento = $linha["dataNascimento"];		
	
		return $cliente;
	
		$dao->desconectar();
	}
	
	public function getClienteCPF($cpf){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select idCliente from cliente where cpf =" .$cpf;
	
		$consulta = $conn->query($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	
		$cliente = new Cliente_Model();
		$cliente->idCliente = $linha['idCliente'];
	
		return $cliente->idCliente;
	
		$dao->desconectar();
	}
}	
?>