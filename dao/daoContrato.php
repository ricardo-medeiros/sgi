<?php 
	session_start();
	require_once(__ROOT__.'/modelo/contrato.model.php');
	require_once(__ROOT__.'/modelo/imovel.model.php');
	require_once(__ROOT__.'/modelo/cliente.model.php');
	require_once(__ROOT__.'/modelo/fiador.model.php');
	require_once(__ROOT__.'/modelo/fiador_contrato.model.php');
	require_once(__ROOT__.'/dao/conexao.php');
		
class daoContrato{
	
	public function daoContrato(){
		
	}	
	
	public function salvarContrato($contrato,$idImovel,$idCliente){
		
		$refContrato = $this->buscaUltReferencia();
		if($refContrato > 0){
			$refContrato = $refContrato + 1;
		}
		else {
			$refContrato = 1000;
		}
		
		$dao = new conexao();
		$conn = $dao->conectar();
		
		//$sql = "INSERT INTO contrato(idUsuario,idImovel,idCliente,tipo,situacao,observacao,dataContrato) VALUES(:idUsuario,:idImovel,:idCliente, :tipo ,:situacao,:observacao,:dataContrato)";
		$sql = "INSERT INTO contrato(idUsuario,idImovel,idCliente,refContrato,dataVigencia,dataInicial,dataFinal,dataEntrada,dataReajuste,diaVencimento,cpfTest1,nomeTest1,cpfTest2,nomeTest2,multaAtraso,diasAtraso,multaMora,diasMora,comissaoCorretor,valorProp,percReaj,valorContrato,tipo,situacao,observacao,dataContrato) VALUES(:idUsuario,:idImovel,:idCliente, :refContrato,:dataVigencia,:dataInicial,:dataFinal,:dataEntrada,:dataReajuste,:diaVencimento,:cpfTest1,:nomeTest1,:cpfTest2,:nomeTest2,:multaAtraso,:diasAtraso,:multaMora,:diasMora,:comissaoCorretor,:valorProp,:percReaj,:valorContrato,:tipo ,:situacao,:observacao,:dataContrato)";
		
		$stmt = $conn->prepare($sql);
		
		$stmt->bindParam( ':idUsuario', $_SESSION["USUARIO"]);
		$stmt->bindParam( ':idImovel', $idImovel);
		$stmt->bindParam( ':idCliente', $idCliente);
		$stmt->bindParam( ':refContrato', $refContrato);
		$stmt->bindParam( ':dataVigencia', $contrato->dataVigencia );
		$stmt->bindParam( ':dataInicial', $contrato->dataInicial );
		$stmt->bindParam( ':dataFinal', $contrato->dataFinal );
		$stmt->bindParam( ':dataEntrada', $contrato->dataEntrada );
		$stmt->bindParam( ':dataReajuste', $contrato->dataReajuste );
		$stmt->bindParam( ':diaVencimento', $contrato->diaVencimento );
		$stmt->bindParam( ':cpfTest1', $contrato->cpfTest1 );
		$stmt->bindParam( ':nomeTest1', $contrato->nomeTest1 );
		$stmt->bindParam( ':cpfTest2', $contrato->cpfTest2 );
		$stmt->bindParam( ':nomeTest2', $contrato->nomeTest2 );
		$stmt->bindParam( ':multaAtraso', $contrato->multaAtraso );
		$stmt->bindParam( ':diasAtraso', $contrato->diasAtraso );
		$stmt->bindParam( ':multaMora', $contrato->multaMora );
		$stmt->bindParam( ':diasMora', $contrato->diasMora );
		$stmt->bindParam( ':comissaoCorretor', $contrato->comissaoCorretor );
		$stmt->bindParam( ':valorProp', $contrato->valorProp );
		$stmt->bindParam( ':percReaj', $contrato->percReaj );
		$stmt->bindParam( ':valorContrato', $contrato->valorContrato );
		$stmt->bindParam( ':tipo', $contrato->tipo );
		$stmt->bindParam( ':situacao',$contrato->situacao );
		$stmt->bindParam( ':observacao',$contrato->observacao );
		$stmt->bindParam( ':dataContrato',$contrato->dataContrato );
		
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
	
	public function salvarFiadorContrato($idContrato,$idFiador){
	
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "INSERT INTO fiador_contrato(idContrato,idFiador) VALUES(:idContrato,:idFiador)";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':idContrato', $idContrato);
		$stmt->bindParam( ':idFiador', $idFiador);
	
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
		
	public function alterarContrato($contrato,$idCliente,$idImovel){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		//$sql = "UPDATE contrato set tipo = :tipo,situacao= :situacao,dataContrato =:dataContrato,observacao =:observacao , idCliente= :idCliente, idImovel= :idImovel, idUsuario= :idUsuario where idContrato = :idContrato";
		$sql = "UPDATE contrato set dataVigencia = :dataVigencia,dataInicial = :dataInicial,dataFinal = :dataFinal,dataEntrada= :dataEntrada,dataReajuste= :dataReajuste,diaVencimento= :diaVencimento,cpfTest1= :cpfTest1,nomeTest1 = :nomeTest1,cpfTest2= :cpfTest2,nomeTest2 = :nomeTest2,multaAtraso= :multaAtraso,diasAtraso= :diasAtraso,multaMora= :multaMora,diasMora= :diasMora,comissaoCorretor= :comissaoCorretor,valorProp= :valorProp,percReaj= :percReaj,valorContrato= :valorContrato, tipo = :tipo,situacao= :situacao,dataContrato =:dataContrato,observacao =:observacao , idCliente= :idCliente, idImovel= :idImovel, idUsuario= :idUsuario where idContrato = :idContrato";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':dataVigencia', $contrato->dataVigencia );
		$stmt->bindParam( ':dataInicial', $contrato->dataInicial );
		$stmt->bindParam( ':dataFinal', $contrato->dataFinal );
		$stmt->bindParam( ':dataEntrada', $contrato->dataEntrada );
		$stmt->bindParam( ':dataReajuste', $contrato->dataReajuste );
		$stmt->bindParam( ':diaVencimento', $contrato->diaVencimento );
		$stmt->bindParam( ':cpfTest1', $contrato->cpfTest1 );
		$stmt->bindParam( ':nomeTest1', $contrato->nomeTest1 );
		$stmt->bindParam( ':cpfTest2', $contrato->cpfTest2 );
		$stmt->bindParam( ':nomeTest2', $contrato->nomeTest2 );
		$stmt->bindParam( ':multaAtraso', $contrato->multaAtraso );
		$stmt->bindParam( ':diasAtraso', $contrato->diasAtraso );
		$stmt->bindParam( ':multaMora', $contrato->multaMora );
		$stmt->bindParam( ':diasMora', $contrato->diasMora );
		$stmt->bindParam( ':comissaoCorretor', $contrato->comissaoCorretor );
		$stmt->bindParam( ':valorProp', $contrato->valorProp );
		$stmt->bindParam( ':percReaj', $contrato->percReaj );
		$stmt->bindParam( ':valorContrato', $contrato->valorContrato );
		$stmt->bindParam( ':tipo', $contrato->tipo );
		$stmt->bindParam( ':situacao', $contrato->situacao );
		$stmt->bindParam( ':dataContrato', $contrato->dataContrato );
		$stmt->bindParam( ':observacao', $contrato->observacao );
		$stmt->bindParam( ':idCliente', $idCliente );
		$stmt->bindParam( ':idImovel', $idImovel );
		$stmt->bindParam( ':idUsuario', $_SESSION["USUARIO"] );
		$stmt->bindParam( ':idContrato', $contrato->idContrato );
	
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
	
	
	
	public function listaContrato(){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from contrato where idUsuario = " . $_SESSION["USUARIO"];
	
		$consulta = $conn->query($sql);
		$lista = new ArrayObject();
			
		while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)){
			$contrato                 = new Contrato_Model();
			$contrato->idContrato     = $linha['idContrato'];
			$contrato->imovel       = $linha['idImovel'];
			$contrato->tipo           = $linha['tipo'];
			$contrato->situacao       = $linha['situacao'];;
			$contrato->observacao     = $linha['observacao'];
			$contrato->dataContrato   = $linha['dataContrato'];
			$contrato->usuario      = $linha["idUsuario"];
			$contrato->cliente      = $linha["idCliente"];		
			$contrato->tagContrato  = $linha["tagContrato"];	
			$lista->append($contrato);
		}
		
		$dao->desconectar();
		
		return $lista;		
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
	
	public function listaImovel(){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from imovel where idUsuario = " . $_SESSION["USUARIO"] . " and situacao = 'L'" ;
	
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
	
	public function excluirContrato($idContrato){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "delete from contrato where idContrato =" .$idContrato;
	
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
	
	public function excluirFiadorContrato($idContrato,$idFiador){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "delete from fiador_contrato where idContrato =" .$idContrato. " and idFiador=" .$idFiador;
	
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
	
	public function getContrato($idContrato){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from contrato where idContrato =" .$idContrato;
	
		$consulta = $conn->query($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
		
		$contrato                 = new Contrato_Model();
		$contrato->idContrato     = $linha['idContrato'];
		$contrato->imovel         = $linha['idImovel'];
		$contrato->tipo           = $linha['tipo'];
		$contrato->situacao       = $linha['situacao'];;
		$contrato->observacao     = $linha['observacao'];
		$contrato->dataContrato   = $linha['dataContrato'];
		$contrato->usuario        = $linha["idUsuario"];
		$contrato->cliente        = $linha["idCliente"];
		$contrato->refContrato    = $linha["refContrato"];
		$contrato->dataVigencia   = $linha["dataVigencia"];
		$contrato->dataInicial    = $linha["dataInicial"];
		$contrato->dataFinal      = $linha["dataFinal"];
		$contrato->dataEntrada    = $linha["dataEntrada"];
		$contrato->dataReajuste   = $linha["dataReajuste"];
		$contrato->diaVencimento  = $linha["diaVencimento"];
		$contrato->cpfTest1       = $linha["cpfTest1"];
		$contrato->nomeTest1      = $linha["nomeTest1"];
		$contrato->cpfTest2       = $linha["cpfTest2"];
		$contrato->nomeTest2      = $linha["nomeTest2"];
		$contrato->multaAtraso    = $linha["multaAtraso"]; 
		$contrato->diasAtraso     = $linha["diasAtraso"];
		$contrato->multaMora      = $linha["multaMora"];
		$contrato->diasMora       = $linha["diasMora"];
		$contrato->comissaoCorretor = $linha["comissaoCorretor"];
		$contrato->valorProp      = $linha["valorProp"];
		$contrato->percReaj       = $linha["percReaj"];
		$contrato->valorContrato  = $linha["valorContrato"];
	
		$dao->desconectar();
		
		return $contrato;
	}
	
	public function buscaUltReferencia(){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select refContrato from contrato order by refContrato desc Limit 1";
	
		$consulta = $conn->query($sql);
		$consulta->execute();
		$linha = $consulta->fetch(PDO::FETCH_ASSOC);
	
		$refContrato   = $linha["refContrato"];
	
		$dao->desconectar();
	
		return $refContrato;
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
		$imovel->proprietario   = $linha['idProprietario'];
		$imovel->usuario        = $linha["idUsuario"];
		$imovel->endereco       = $linha["idEndereco"];
			
		return $imovel;
	
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
	
	public function listaFiadorContrato($idContrato){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from fiador t1, fiador_contrato t2 where t1.idFiador = t2.idFiador and t2.idContrato = " . $idContrato;
	
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
	
	public function guardarHTML($idContrato,$html){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "UPDATE contrato set tagContrato = :tagContrato where idContrato = :idContrato";
	
		$stmt = $conn->prepare($sql);
	
		$stmt->bindParam( ':tagContrato', $html);
		$stmt->bindParam( ':idContrato', $idContrato );
	
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