<?php 
	session_start();
	require_once(__ROOT__.'/modelo/tipo_desconto.model.php');
	require_once(__ROOT__.'/dao/conexao.php');
		
class daoTipoDesconto{
	
	public function daoTipoDesconto(){
		
	}	
	
	public function salvarTipoDesconto($tipoDesconto){
		$dao = new conexao();
		$conn = $dao->conectar();
		
		$sql = "INSERT INTO tipoDesconto(descDesconto,idUsuario) VALUES(:descDesconto,:idUsuario)";
		
		$stmt = $conn->prepare($sql);
		
		$stmt->bindParam( ':descDesconto', $tipoDesconto->descDesconto );
		$stmt->bindParam( ':idUsuario', $_SESSION["USUARIO"]);
		
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
		
	  public function alterarTipoDesconto($tipoDesconto){
		$dao = new conexao();
		$conn = $dao->conectar();
	 
		$sql = "UPDATE tipoDesconto set descDesconto = :descDesconto,idUsuario= :idUsuario where idTipoDesconto = :idTipoDesconto";
	
		$stmt = $conn->prepare($sql);
		
		$stmt->bindParam( ':descDesconto', $tipoDesconto->descDesconto );
		$stmt->bindParam( ':idUsuario', $_SESSION["USUARIO"] );
		$stmt->bindParam( ':idTipoDesconto', $tipoDesconto->idTipoDesconto);
	
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
	
	public function listaTipoDesconto(){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from tipoDesconto where idUsuario = " . $_SESSION["USUARIO"];
	
		$consulta = $conn->query($sql);
		$lista = new ArrayObject();
			
		while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
			$tipoDesconto = new Tipo_Desconto_Model();
			$tipoDesconto->idTipoDesconto = $linha['idTipoDesconto'];
			$tipoDesconto->descDesconto = $linha['descDesconto'];
			$lista->append($tipoDesconto);
		}
		
		return $lista;
	
		$dao->desconectar();
	}
	
	public function excluirTipoDesconto($idTipoDesconto){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "delete from tipoDesconto where idTipoDesconto =" .$idTipoDesconto;
	
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
	
	public function getTipoDesconto($idTipoDesconto){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from tipoDesconto where idTipoDesconto =" .$idTipoDesconto;
	
		$consulta = $conn->query($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		
		$tipoDesconto = new Tipo_Desconto_Model();
		$tipoDesconto->idTipoDesconto = $linha['idTipoDesconto'];
		$tipoDesconto->descDesconto = $linha['descDesconto'];

		return $tipoDesconto;
	
		$dao->desconectar();
	}
}	
?>