<?php 
	session_start();
	require_once(__ROOT__.'/modelo/imovel.model.php');
	require_once(__ROOT__.'/modelo/endereco.model.php');
	require_once(__ROOT__.'/modelo/proprietario.model.php');
	require_once(__ROOT__.'/dao/conexao.php');
		
class daoImovel{
	
	public function daoImovel(){
		
	}	
	
	public function salvarImovel($imovel){
		$dao = new conexao();
		$conn = $dao->conectar();
		
		$sql = "INSERT INTO imovel(idUsuario,tipo,situacao,valor,status,observacao) VALUES(:idUsuario, :tipo ,:situacao, :valor, :status,:observacao)";
		
		$stmt = $conn->prepare($sql);
		
		$stmt->bindParam( ':idUsuario', $_SESSION["USUARIO"]);
		$stmt->bindParam( ':tipo', $imovel->tipo );
		$stmt->bindParam( ':situacao',$imovel->situacao );
		$stmt->bindParam( ':valor',$imovel->valor );
		$stmt->bindParam( ':status',$imovel->status );
		$stmt->bindParam( ':observacao',$imovel->observacao );
		
		$result = $stmt->execute();
		$id = $conn->lastInsertId();
		
		if (!$result )
		{
			var_dump( $stmt->errorInfo() );
			//return false;
			return 0;
		}
		else
		{
			//return true;
			return $id;
		}
		
		$dao->desconectar();
	}
	
	public function salvarEndImovel($endereco){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "INSERT INTO endereco(rua, bairro,cidade,uf,cep,idUsuario) VALUES(:rua, :bairro, :cidade, :uf ,:cep,:idUsuario)";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':rua', $endereco->rua );
		$stmt->bindParam( ':bairro', $endereco->bairro );
		$stmt->bindParam( ':cidade', $endereco->cidade );
		$stmt->bindParam( ':uf', $endereco->uf );
		$stmt->bindParam( ':cep', $endereco->cep );
		$stmt->bindParam( ':idUsuario' , $_SESSION["USUARIO"]);
	
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
	
	public function salvarPropImovel($proprietario){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "INSERT INTO proprietario(nome, cpf,telefoneContato,email,idUsuario) VALUES(:nome, :cpf, :telefoneContato, :email ,:idUsuario)";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':nome', $proprietario->nome );
		$stmt->bindParam( ':cpf', $proprietario->cpf );
		$stmt->bindParam( ':telefoneContato', $proprietario->telefoneContato );
		$stmt->bindParam( ':email', $proprietario->email );
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
	
	public function alterarEndImovel($endereco){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "UPDATE endereco set rua= :rua, bairro= :bairro, cidade= :cidade, uf= :uf, cep= :cep,idUsuario= :idUsuario where idEndereco= :idEndereco";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':rua', $endereco->rua );
		$stmt->bindParam( ':bairro', $endereco->bairro );
		$stmt->bindParam( ':cidade', $endereco->cidade );
		$stmt->bindParam( ':uf', $endereco->uf );
		$stmt->bindParam( ':cep', $endereco->cep );
		$stmt->bindParam( ':idUsuario' , $_SESSION["USUARIO"]);
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
	
	public function alterarPropImovel($proprietario){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "UPDATE proprietario set nome = :nome,cpf= :cpf, telefoneContato= :telefoneContato,email= :email , idUsuario= :idUsuario where idProprietario = :idProprietario";
		
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':nome', $proprietario->nome );
		$stmt->bindParam( ':cpf', $proprietario->cpf );
		$stmt->bindParam( ':telefoneContato', $proprietario->telefoneContato );
		$stmt->bindParam( ':email', $proprietario->email);	
		$stmt->bindParam( ':idUsuario', $_SESSION["USUARIO"] );
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
	
	public function alterarImovel($imovel,$idEndereco,$idProprietario){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "UPDATE imovel set tipo = :tipo,valor= :valor,status =:status,observacao =:observacao , idProprietario= :idProprietario, idEndereco= :idEndereco, idUsuario= :idUsuario where idImovel = :idImovel";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':tipo', $imovel->tipo );
		//$stmt->bindParam( ':situacao', $imovel->situacao );
		$stmt->bindParam( ':valor', $imovel->valor );
		$stmt->bindParam( ':status', $imovel->status );
		$stmt->bindParam( ':observacao', $imovel->observacao );
	
		//if ($idProprietario > 0)
		//{
			$stmt->bindParam( ':idProprietario', $idProprietario );
		//}
		//else 
		//{
		//	$stmt->bindParam( ':idProprietario', $imovel->$proprietario );
		//}
		
	    //if ($idEndereco > 0)
		//{
			$stmt->bindParam( ':idEndereco', $idEndereco );
		//}
		//else
		//{
		//	$stmt->bindParam( ':idEndereco', $imovel->$endereco );
		//}		
		
		$stmt->bindParam( ':idUsuario', $_SESSION["USUARIO"] );
		$stmt->bindParam( ':idImovel', $imovel->idImovel );
	
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
	
	public function listaImovel(){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from imovel where idUsuario = " . $_SESSION["USUARIO"];
	
		$consulta = $conn->query($sql);
		$lista = new ArrayObject();
			
		while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
			$imovel                 = new Imovel_Model();
			$imovel->idImovel       = $linha['idImovel'];
			$imovel->tipo           = $linha['tipo'];
			$imovel->situacao       = $linha['situacao'];
			$imovel->valor          = $linha['valor'];
			$imovel->status         = $linha['status'];
			$imovel->observacao     = $linha['observacao'];
			$imovel->idProprietario = $linha['idProprietario'];
			$imovel->idUsuario      = $linha["idUsuario"];
			$imovel->idEndereco     = $linha["idEndereco"];			
			$lista->append($imovel);
		}
		
		return $lista;
	
		$dao->desconectar();
	}
	
	public function excluirImovel($idImovel){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "delete from imovel where idImovel =" .$idImovel;
	
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
	
	public function getImovel($idImovel){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from imovel where idImovel =" .$idImovel;
	
		$consulta = $conn->query($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		
		$imovel                 = new Imovel_Model();
		$imovel->idImovel       = $linha['idImovel'];
		$imovel->tipo           = $linha['tipo'];
		$imovel->situacao       = $linha['situacao'];
		$imovel->valor          = $linha['valor'];
		$imovel->status         = $linha['status'];
		$imovel->observacao     = $linha['observacao'];
		$imovel->proprietario = $linha['idProprietario'];
		$imovel->usuario      = $linha["idUsuario"];
		$imovel->endereco     = $linha["idEndereco"];			
					
		return $imovel;
	
		$dao->desconectar();
	}
	
	public function getEndImovel($imovel){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from endereco where idEndereco =" .$imovel->endereco;
	
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
	
	public function getPropImovel($imovel){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from proprietario where idProprietario =" .$imovel->proprietario;
	
		$consulta = $conn->query($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	
		$proprietario = new Proprietario_Model();
		$proprietario->idProprietario = $linha['idProprietario'];
		$proprietario->nome = $linha['nome'];
		$proprietario->cpf = $linha['cpf'];
		$proprietario->telefoneContato = $linha['telefoneContato'];
		$proprietario->email= $linha["email"];
	
		return $proprietario;
	
		$dao->desconectar();
	}
}	
?>