<?php 
	session_start();
	require_once(__ROOT__.'/modelo/cliente.model.php');
	require_once(__ROOT__.'/modelo/endereco.model.php');
	require_once(__ROOT__.'/dao/conexao.php');
		
class daoCliente{
	
	public function daoCliente(){
		
	}	
	
	public function salvarCliente($cliente){
		$dao = new conexao();
		$conn = $dao->conectar();
		
		$sql = "INSERT INTO cliente(nome, email,cpf,status,rg,telefoneCelular,dataNascimento,idUsuario) VALUES(:nome, :email, :cpf, :status ,:rg, :telefoneCelular, :dataNascimento,:idUsuario)";
		
		$stmt = $conn->prepare($sql);
		
		$stmt->bindParam( ':nome', $cliente->nome );
		$stmt->bindParam( ':email', $cliente->email );
		$stmt->bindParam( ':cpf', $cliente->cpf );
		$stmt->bindParam( ':status', $cliente->status );
		$stmt->bindParam( ':rg', $cliente->rg );
		$stmt->bindParam( ':telefoneCelular', $cliente->telefoneCelular );
		$stmt->bindParam( ':dataNascimento', $cliente->dataNascimento );
		$stmt->bindParam( ':idUsuario' , $_SESSION["USUARIO"]);
		
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
	
	public function salvarEndCliente($endereco){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "INSERT INTO endereco(rua, bairro,cidade,uf,cep) VALUES(:rua, :bairro, :cidade, :uf ,:cep)";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':rua', $endereco->rua );
		$stmt->bindParam( ':bairro', $endereco->bairro );
		$stmt->bindParam( ':cidade', $endereco->cidade );
		$stmt->bindParam( ':uf', $endereco->uf );
		$stmt->bindParam( ':cep', $endereco->cep );
	
		$result = $stmt->execute();
		$id = $conn->lastInsertId();
		
		if (!$result )
		{
			var_dump( $stmt->errorInfo() );
			return 0;
		}
		else
		{
			return $id;
		}
	
		$dao->desconectar();
	}
	
	public function alterarEndCliente($endereco){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "UPDATE endereco set rua= :rua, bairro= :bairro, cidade= :cidade, uf= :uf, cep= :cep where idEndereco= :idEndereco";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':rua', $endereco->rua );
		$stmt->bindParam( ':bairro', $endereco->bairro );
		$stmt->bindParam( ':cidade', $endereco->cidade );
		$stmt->bindParam( ':uf', $endereco->uf );
		$stmt->bindParam( ':cep', $endereco->cep );
		$stmt->bindParam( ':idEndereco', $endereco->idEndereco );
	
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
	
	public function alterarCliente($cliente,$idEndereco){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "UPDATE cliente set nome = :nome, email= :email,cpf= :cpf,status= :status, rg= :rg, telefoneCelular= :telefoneCelular, dataNascimento= :dataNascimento,idEndereco= :idEndereco, idUsuario= :idUsuario where idCliente = :idCliente";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':nome', $cliente->nome );
		$stmt->bindParam( ':email', $cliente->email );
		$stmt->bindParam( ':cpf', $cliente->cpf );
		$stmt->bindParam( ':status', $cliente->status );
		$stmt->bindParam( ':rg', $cliente->rg );
		$stmt->bindParam( ':telefoneCelular', $cliente->telefoneCelular );
		$stmt->bindParam( ':dataNascimento', $cliente->dataNascimento );
		$stmt->bindParam( ':idEndereco', $idEndereco );
		$stmt->bindParam( ':idUsuario', $_SESSION["USUARIO"] );
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
	
		$sql = "select * from cliente where idUsuario = " . $_SESSION["USUARIO"];
	
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
		$cliente->endereco = $linha['idEndereco'];
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
	
	public function getEndCliente($cliente){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from endereco where idEndereco =" .$cliente->endereco;
	
 		$consulta = $conn->query($sql);
 		$consulta->execute();
 		$linha = $consulta->fetch(PDO::FETCH_ASSOC);

 		$endereco = new Endereco_Model();
 		$endereco->idEndereco = $linha['idEndereco'];
 		$endereco->rua = $linha['rua'];
 		$endereco->bairro = $linha['bairro'];
 		$endereco->cidade = $linha['cidade'];
 		$endereco->uf= $linha["uf"];
 		$endereco->cep= $linha["cep"];
	
		return $endereco;
	
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