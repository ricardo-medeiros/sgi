<?php 
	session_start();
	require_once(__ROOT__.'/modelo/contrato.model.php');
	require_once(__ROOT__.'/modelo/imovel.model.php');
	require_once(__ROOT__.'/modelo/cliente.model.php');
	require_once(__ROOT__.'/modelo/endereco.model.php');
	require_once(__ROOT__.'/modelo/proprietario.model.php');
	require_once(__ROOT__.'/modelo/fiador.model.php');
	require_once(__ROOT__.'/dao/conexao.php');
		
class acoesContratoVO{
	
	public function acoesContratoVO(){
		
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
		$contrato->tagContrato  = $linha["tagContrato"];
	
		$dao->desconectar();
		
		return $contrato;
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
	
	public function getEndereco($idEndereco){
		$dao = new conexao();
		$conn = $dao->conectar();
	
		$sql = "select * from endereco where idEndereco =" .$idEndereco;
	
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
		$proprietario->rg = $linha['rg'];
		$proprietario->telefoneContato = $linha["telefoneContato"];
		$proprietario->email = $linha["email"];
		$proprietario->endereco = $linha["idEndereco"];
	
		return $proprietario;
	
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