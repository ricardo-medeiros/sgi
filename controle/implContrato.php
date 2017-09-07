 <?php
 define('__ROOT__',dirname(dirname(__FILE__)));
 require_once(__ROOT__. '/modelo/contrato.model.php');
 require_once(__ROOT__. '/modelo/cliente.model.php');
 require_once(__ROOT__. '/modelo/imovel.model.php');
 require_once(__ROOT__.'/controle/contrato.controle.php');
 
		
 if ($_SESSION["USUARIO"] != '')
 {
	if(isset($_POST["salvar"]) == 'Salvar'){
		salvarContrato();
	}

	if(isset($_POST["alterar"]) == 'Alterar'){
		alterarContrato();
	}
	
	if(isset($_REQUEST["idContrato"]) != '0' && isset($_REQUEST["tipo"]) == 'DLT')
	{
		$idContrato = $_REQUEST["idContrato"];
 		excluirContrato($idContrato);

	}	
	if(isset($_REQUEST["idContrato"]) != '0' && isset($_REQUEST["codFiador"]) != '0')
	{
		$idContrato = $_REQUEST["idContrato"];
		$idFiador   = $_REQUEST["codFiador"];
		salvarFiadorContrato($idContrato,$idFiador);
	}
	if(isset($_REQUEST["idContrato"]) != '0' && isset($_REQUEST["excFiador"]) != '0')
	{
		$idContrato = $_REQUEST["idContrato"];
		$idFiador   = $_REQUEST["excFiador"];
		excluirFiadorContrato($idContrato,$idFiador);
	}
	if(isset($_POST["salvarHTML"]) == 'Atualizar')
	{
		$idContrato = $_POST["idContrato"];
		$html   = $_POST["htmlAtual"];
		atualizaHtmlContrato($idContrato,$html);
	}
 }
 
	function salvarContrato(){
		$contrato = new Contrato_Model();
		$contrato->tipo= $_POST["tipoContrato"];
		$contrato->situacao = $_POST["situacao"];
		$contrato->dataContrato = $_POST["dataContrato"];
		$contrato->observacao =  $_POST["observacao"];
		$contrato->dataVigencia   = $_POST["dataVigencia"];
		$contrato->dataInicial    = $_POST["dataInicial"];
		$contrato->dataFinal      = $_POST["dataFinal"];
		$contrato->dataEntrada    = $_POST["dataEntrada"];
		$contrato->dataReajuste   = $_POST["dataReajuste"];
		$contrato->diaVencimento  = $_POST["diaVencimento"];
		$contrato->cpfTest1       = $_POST["cpfTest1"];
		$contrato->nomeTest1      = $_POST["nomeTest1"];
		$contrato->cpfTest2       = $_POST["cpfTest2"];
		$contrato->nomeTest2      = $_POST["nomeTest2"];
		$contrato->multaAtraso    = $_POST["multaAtraso"];
		$contrato->diasAtraso     = $_POST["diasAtraso"];
		$contrato->multaMora      = $_POST["multaMora"];
		$contrato->diasMora       = $_POST["diasMora"];
		$contrato->comissaoCorretor = $_POST["comissaoCorretor"];
		$contrato->valorProp      = $_POST["valorProp"];
		$contrato->percReaj       = $_POST["percReaj"];
		$contrato->valorContrato  = $_POST["valorContrato"];
		
		if ($_POST["idImovel"] == '')
		{
			$idImovel = 0;
		}
		else {
		
			$idImovel = $_POST["idImovel"];
		}
		
		if ($_POST["idCliente"] == '')
		{
			$idCliente = 0;
		}
		else {
		
			$idCliente = $_POST["idCliente"];
		}
		
		$contratoControle = new Contrato_Controle();
		$contratoControle->salvarContrato($contrato,$idImovel,$idCliente);
	}
	
	function alterarContrato(){
		$contrato = new Contrato_Model();
		$contrato->idContrato = $_POST["idContrato"];
		
		if (isset($_POST["idImovel"]) != '')
		{
			$idImovel = $_POST["idImovel"];
		}
		else {
		
			$idImovel = 0;
		}
		
		if (isset($_POST["idCliente"]) != '')
		{
			$idCliente = $_POST["idCliente"];
		}
		else {
		
			$idCliente = 0;
		}
		
		$contrato->tipo = $_POST["tipoContrato"];
		$contrato->situacao= $_POST["situacao"];
		$contrato->dataContrato = $_POST["dataContrato"];
		$contrato->observacao =  $_POST["observacao"];	
		$contrato->dataVigencia   = $_POST["dataVigencia"];
		$contrato->dataInicial    = $_POST["dataInicial"];
		$contrato->dataFinal      = $_POST["dataFinal"];
		$contrato->dataEntrada    = $_POST["dataEntrada"];
		$contrato->dataReajuste   = $_POST["dataReajuste"];
		$contrato->diaVencimento  = $_POST["diaVencimento"];
		$contrato->cpfTest1       = $_POST["cpfTest1"];
		$contrato->nomeTest1      = $_POST["nomeTest1"];
		$contrato->cpfTest2       = $_POST["cpfTest2"];
		$contrato->nomeTest2      = $_POST["nomeTest2"];
		$contrato->multaAtraso    = $_POST["multaAtraso"];
		$contrato->diasAtraso     = $_POST["diasAtraso"];
		$contrato->multaMora      = $_POST["multaMora"];
		$contrato->diasMora       = $_POST["diasMora"];
		$contrato->comissaoCorretor = $_POST["comissaoCorretor"];
		$contrato->valorProp      = $_POST["valorProp"];
		$contrato->percReaj       = $_POST["percReaj"];
		$contrato->valorContrato  = $_POST["valorContrato"];		
		$contratoControle = new Contrato_Controle();
		$contratoControle->alterarContrato($contrato,$idCliente,$idImovel);
	}
	
	function excluirContrato($idContrato){	
		$contratoControle = new Contrato_Controle();
		$contratoControle->excluirContrato($idContrato);
	}
	
	function salvarFiadorContrato($idContrato,$idFiador){
		$contratoControle = new Contrato_Controle();
		$contratoControle->salvarFiadorContrato($idContrato,$idFiador);
	}
	
	function excluirFiadorContrato($idContrato,$idFiador){
		$contratoControle = new Contrato_Controle();
		$contratoControle->excluirFiadorContrato($idContrato,$idFiador);
	}
	function atualizaHtmlContrato($idContrato,$html){
		$contratoControle = new Contrato_Controle();
		$contratoControle->salvarHTML($idContrato,$html);
	}
?>
