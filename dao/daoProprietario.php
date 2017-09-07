<?php 
	session_start();
	require_once(__ROOT__.'/modelo/proprietario.model.php');
	require_once(__ROOT__.'/dao/conexao.php');
		
class daoProprietario{
	
	public function daoProprietario(){
		
	}	
	
	public function salvarProprietario($proprietario){
		$dao = new conexao();
		$conn = $dao->conectar();
		
		$sql = "INSERT INTO proprietario(nome,cpf,rg,telefoneContato,email,idUsuario) VALUES(:nome, :cpf, :rg,:telefoneContato, :email, :idUsuario)";
		
		$stmt = $conn->prepare($sql);
		
		$stmt->bindParam( ':nome', $proprietario->nome );
		$stmt->bindParam( ':cpf', $proprietario->cpf );
		$stmt->bindParam( ':rg', $proprietario->rg );
		$stmt->bindParam( ':telefoneContato', $proprietario->telefoneContato );
		$stmt->bindParam( ':email', $proprietario->email );
		$stmt->bindParam( ':idUsuario', $_SESSION["USUARIO"]);
		
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
	
	public function salvarEndProprietario($endereco){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "INSERT INTO endereco(rua, bairro,cidade,uf,cep,idUsuario) VALUES(:rua, :bairro, :cidade, :uf ,:cep,:idUsuario)";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':rua', $endereco->rua );
		$stmt->bindParam( ':bairro', $endereco->bairro );
		$stmt->bindParam( ':cidade', $endereco->cidade );
		$stmt->bindParam( ':uf', $endereco->uf );
		$stmt->bindParam( ':cep', $endereco->cep );
		$stmt->bindParam( ':idUsuario', $_SESSION["USUARIO"]);
	
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
	
	public function alterarEndProprietario($endereco){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "UPDATE endereco set rua= :rua, bairro= :bairro, cidade= :cidade, uf= :uf, cep= :cep,idUsuario= :idUsuario where idEndereco= :idEndereco";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':rua', $endereco->rua );
		$stmt->bindParam( ':bairro', $endereco->bairro );
		$stmt->bindParam( ':cidade', $endereco->cidade );
		$stmt->bindParam( ':uf', $endereco->uf );
		$stmt->bindParam( ':cep', $endereco->cep );
		$stmt->bindParam( ':idUsuario', $_SESSION["USUARIO"]);
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
	
	public function alterarProprietario($proprietario,$idEndereco){
	  //public function alterarProprietario($proprietario){
		$dao = new conexao();
		$conn = $dao->conectar();
	 
		$sql = "UPDATE proprietario set nome = :nome,cpf= :cpf,rg= :rg, telefoneContato= :telefoneContato,email= :email , idUsuario= :idUsuario,idEndereco= :idEndereco where idProprietario = :idProprietario";
	
		$stmt = $conn->prepare($sql);
		
		$stmt->bindParam( ':nome', $proprietario->nome );
		$stmt->bindParam( ':cpf', $proprietario->cpf );
		$stmt->bindParam( ':rg', $proprietario->rg );
		$stmt->bindParam( ':telefoneContato', $proprietario->telefoneContato );
		$stmt->bindParam( ':email', $proprietario->email);	
		$stmt->bindParam( ':idUsuario', $_SESSION["USUARIO"] );
		$stmt->bindParam( ':idEndereco', $idEndereco );
		$stmt->bindParam( ':idProprietario', $proprietario->idProprietario );
	
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
	
	public function listaProprietario(){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from proprietario where idUsuario = " . $_SESSION["USUARIO"];
	
		$consulta = $conn->query($sql);
		$lista = new ArrayObject();
			
		while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
			$proprietario = new Proprietario_Model();
			$proprietario->idProprietario = $linha['idProprietario'];
			$proprietario->nome = $linha['nome'];
			$proprietario->cpf = $linha['cpf'];
			$proprietario->rg = $linha["rg"];
			$proprietario->telefoneContato = $linha["telefoneContato"];
			$proprietario->email = $linha["email"];
			$lista->append($proprietario);
		}
		
		return $lista;
	
		$dao->desconectar();
	}
	
	public function excluirProprietario($idProprietario){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "delete from proprietario where idProprietario =" .$idProprietario;
	
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
	
	public function getProprietario($idProprietario){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from proprietario where idProprietario =" .$idProprietario;
	
		$consulta = $conn->query($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		
		$proprietario = new Proprietario_Model();
		$proprietario->idProprietario = $linha['idProprietario'];
		$proprietario->nome = $linha['nome'];
		$proprietario->cpf = $linha['cpf'];
		$proprietario->rg = $linha["rg"];
		$proprietario->telefoneContato = $linha["telefoneContato"];
		$proprietario->email = $linha["email"];
		$proprietario->endereco = $linha["idEndereco"];

		return $proprietario;
	
		$dao->desconectar();
	}
	
	public function getEndProprietario($proprietario){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from endereco where idEndereco =" .$proprietario->endereco;
	
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
	
	public function getProprietarioCPF($cpf){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select idProprietario from proprietario where cpf =" .$cpf;
		
		$consulta = $conn->query($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	
		$proprietario = new Proprietario_Model();
		$proprietario->idProprietario = $linha['idProprietario'];
	
		return $proprietario->idProprietario;
	
		$dao->desconectar();
	}
}	
?>