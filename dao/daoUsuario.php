<?php 
	require_once(__ROOT__.'/modelo/usuario.model.php');
	require_once(__ROOT__.'/dao/conexao.php');
		
class daoUsuario{
	
	public function daoUsuario(){
		
	}	
	
	public function salvarUsuario($usuario){
		$dao = new conexao();
		$conn = $dao->conectar();
		
		$sql = "INSERT INTO usuario(nome, login,cpf,status,senha,telefoneContato,caminhoLogo) VALUES(:nome, :login, :cpf, :status ,:senha, :telefoneContato, :caminhoLogo)";
		
		$stmt = $conn->prepare($sql);
		
		$stmt->bindParam( ':nome', $usuario->nome );
		$stmt->bindParam( ':login', $usuario->login );
		$stmt->bindParam( ':cpf', $usuario->cpf );
		$stmt->bindParam( ':status', $usuario->status );
		$stmt->bindParam( ':senha', $usuario->senha );
		$stmt->bindParam( ':telefoneContato', $usuario->telefoneContato );
		$stmt->bindParam( ':caminhoLogo', $usuario->caminhoLogo );
		
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
	
	public function salvarEndUsuario($endereco){
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
	
	public function alterarEndUsuario($endereco){
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
	
	public function alterarUsuario($usuario,$idEndereco){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		if ($usuario->caminhoLogo != null)
		{
			$sql = "UPDATE usuario set nome = :nome,cpf= :cpf, senha= :senha, telefoneContato= :telefoneContato, caminhoLogo= :caminhoLogo,idEndereco= :idEndereco where idUsuario = :idUsuario";
		}
		else 
		{
			$sql = "UPDATE usuario set nome = :nome,cpf= :cpf, senha= :senha, telefoneContato= :telefoneContato,idEndereco= :idEndereco where idUsuario = :idUsuario";
		}
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':nome', $usuario->nome );
		//$stmt->bindParam( ':login', $usuario->login );
		$stmt->bindParam( ':cpf', $usuario->cpf );
		//$stmt->bindParam( ':status', $usuario->status );
		$stmt->bindParam( ':senha', $usuario->senha);
		$stmt->bindParam( ':telefoneContato', $usuario->telefoneContato );
		if ($usuario->caminhoLogo != null)
		{
			$stmt->bindParam( ':caminhoLogo', $usuario->caminhoLogo );
		}
		
		$stmt->bindParam( ':idEndereco', $idEndereco );
		$stmt->bindParam( ':idUsuario', $usuario->idUsuario );
	
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
	
	public function listaUsuario(){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from usuario";
	
		$consulta = $conn->query($sql);
		$lista = new ArrayObject();
			
		while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
			$usuario = new Usuario_Model();
			$usuario->idUsuario = $linha['idUsuario'];
			$usuario->nome = $linha['nome'];
			$usuario->login = $linha['login'];
			$usuario->cpf = $linha['cpf'];
			$usuario->status= $linha["status"];
			$usuario->senha= $linha["senha"];
			$usuario->telefoneContato = $linha["telefoneContato"];
			$usuario->caminhoLogo = $linha["caminhoLogo"];
			$lista->append($usuario);
		}
		
		return $lista;
	
		$dao->desconectar();
	}
	
	public function excluirUsuario($idUsuario){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "delete from usuario where idUsuario =" .$idUsuario;
	
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
	
	public function getUsuario($idUsuario){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from usuario where idUsuario =" .$idUsuario;
	
		$consulta = $conn->query($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		
		$usuario = new Usuario_Model();
		$usuario->idUsuario = $linha['idUsuario'];
		$usuario->nome = $linha['nome'];
		$usuario->login = $linha['login'];
		$usuario->cpf = $linha['cpf'];
		$usuario->status= $linha["status"];
		$usuario->senha= $linha["senha"];
		$usuario->telefoneContato = $linha["telefoneContato"];
		$usuario->caminhoLogo = $linha["caminhoLogo"];
		$usuario->endereco = $linha["idEndereco"];

		return $usuario;
	
		$dao->desconectar();
	}
	
	public function getEndUsuario($usuario){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from endereco where idEndereco =" .$usuario->endereco;
	
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
	
	public function getUsuarioCPF($cpf){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select idUsuario from usuario where cpf =" .$cpf;
	
		$consulta = $conn->query($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	
		$usuario = new Usuario_Model();
		$usuario->idUsuario = $linha['idUsuario'];
	
		return $usuario->idUsuario;
	
		$dao->desconectar();
	}
	
	public function efetuarLogin($login,$senha){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from usuario where login ='" .$login ."' and senha='" .$senha ."'";
		
		$consulta = $conn->prepare($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	
		$usuario = new Usuario_Model();
		$usuario->idUsuario = $linha['idUsuario'];
		$usuario->nome = $linha['nome'];
		$usuario->cpf  = $linha['cpf'];
		
		return $usuario;
	
		$dao->desconectar();
	}
}	
?>