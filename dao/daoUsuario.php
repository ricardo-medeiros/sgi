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
	
	public function alterarUsuario($usuario){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "UPDATE usuario set nome = :nome, login= :login,cpf= :cpf,status= :status, senha= :senha, telefoneContato= :telefoneContato, caminhoLogo= :caminhoLogo where idUsuario = :idUsuario";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':nome', $usuario->nome );
		$stmt->bindParam( ':login', $usuario->login );
		$stmt->bindParam( ':cpf', $usuario->cpf );
		$stmt->bindParam( ':status', $usuario->status );
		$stmt->bindParam( ':senha', $usuario->senha);
		$stmt->bindParam( ':telefoneContato', $usuario->telefoneContato );
		$stmt->bindParam( ':caminhoLogo', $usuario->caminhoLogo );
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
	
	public function getUsuario($idusuario){
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

		return $usuario;
	
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
	
		$sql = "select nome from usuario where login ='" .$login ."' and senha='" .$senha ."'";
		
		$consulta = $conn->prepare($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	
		$usuario = new Usuario_Model();
		$usuario->nome = $linha['nome'];
		
		return $usuario->nome;
	
		$dao->desconectar();
	}
}	
?>