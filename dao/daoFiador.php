<?php 
	session_start();
	require_once(__ROOT__.'/modelo/fiador.model.php');
	require_once(__ROOT__.'/dao/conexao.php');
		
class daoFiador{
	
	public function daoFiador(){
		
	}	
	
	public function salvarFiador($fiador){
		$dao = new conexao();
		$conn = $dao->conectar();
		
		$sql = "INSERT INTO fiador(nome,cpf,rg,telefoneContato,email,idUsuario) VALUES(:nome, :cpf, :rg,:telefoneContato, :email, :idUsuario)";
		
		$stmt = $conn->prepare($sql);
		
		$stmt->bindParam( ':nome', $fiador->nome );
		$stmt->bindParam( ':cpf', $fiador->cpf );
		$stmt->bindParam( ':rg', $fiador->rg );
		$stmt->bindParam( ':telefoneContato', $fiador->telefoneContato );
		$stmt->bindParam( ':email', $fiador->email );
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
	
	public function salvarEndFiador($endereco){
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
	
	public function alterarEndFiador($endereco){
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
	
	public function alterarFiador($fiador,$idEndereco){
		$dao = new conexao();
		$conn = $dao->conectar();
	 
		$sql = "UPDATE fiador set nome = :nome,cpf= :cpf,rg= :rg, telefoneContato= :telefoneContato,email= :email , idUsuario= :idUsuario,idEndereco= :idEndereco where idFiador = :idFiador";
	
		$stmt = $conn->prepare($sql);
		
		$stmt->bindParam( ':nome', $fiador->nome );
		$stmt->bindParam( ':cpf', $fiador->cpf );
		$stmt->bindParam( ':rg', $fiador->rg );
		$stmt->bindParam( ':telefoneContato', $fiador->telefoneContato );
		$stmt->bindParam( ':email', $fiador->email);	
		$stmt->bindParam( ':idUsuario', $_SESSION["USUARIO"] );
		$stmt->bindParam( ':idEndereco', $idEndereco );
		$stmt->bindParam( ':idFiador', $fiador->idFiador );
	
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
	
	public function listaFiador(){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from fiador where idUsuario = " . $_SESSION["USUARIO"];
	
		$consulta = $conn->query($sql);
		$lista = new ArrayObject();
			
		while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
			$fiador = new Fiador_Model();
			$fiador->idFiador = $linha['idFiador'];
			$fiador->nome = $linha['nome'];
			$fiador->cpf = $linha['cpf'];
			$fiador->rg = $linha["rg"];
			$fiador->telefoneContato = $linha["telefoneContato"];
			$fiador->email = $linha["email"];
			$lista->append($fiador);
		}
		
		return $lista;
	
		$dao->desconectar();
	}
	
	public function excluirFiador($idFiador){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "delete from fiador where idFiador =" .$idFiador;
	
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
	
	public function getFiador($idFiador){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from fiador where idFiador =" .$idFiador;
	
		$consulta = $conn->query($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		
		$fiador = new Fiador_Model();
		$fiador->idFiador = $linha['idFiador'];
		$fiador->nome = $linha['nome'];
		$fiador->cpf = $linha['cpf'];
		$fiador->rg = $linha["rg"];
		$fiador->telefoneContato = $linha["telefoneContato"];
		$fiador->email = $linha["email"];
		$fiador->endereco = $linha["idEndereco"];

		return $fiador;
	
		$dao->desconectar();
	}
	
	public function getEndFiador($fiador){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from endereco where idEndereco =" .$fiador->endereco;
	
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
	
	public function getFiadorCPF($cpf){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select idFiador from fiador where cpf =" .$cpf;
		
		$consulta = $conn->query($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	
		$fiador = new Fiador_Model();
		$fiador->idFiador = $linha['idFiador'];
	
		return $fiador->idFiador;
	
		$dao->desconectar();
	}
}	
?>