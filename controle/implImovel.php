 <?php
 define('__ROOT__',dirname(dirname(__FILE__)));
 require_once(__ROOT__. '/modelo/imovel.model.php');
 require_once(__ROOT__. '/modelo/endereco.model.php');
 require_once(__ROOT__. '/modelo/proprietario.model.php');
 require_once(__ROOT__.'/controle/imovel.controle.php');

		
 if ($_SESSION["USUARIO"] != '')
 {
	if(isset($_POST["salvar"]) == 'Salvar'){
		salvarImovel();
	}

	if(isset($_POST["alterar"]) == 'Alterar'){
		alterarImovel();
	}
	
	if(isset($_POST["salvarEnd"]) == 'Salvar'){
		salvarEndereco();
	}
	
	if(isset($_POST["salvarProp"]) == 'Salvar'){
		salvarProprietario();
	}
	
	if(isset($_REQUEST["idImovel"]) != '0' && isset($_REQUEST["tipo"]) == 'DLT')
	{
		$idImovel = $_REQUEST["idImovel"];
 		excluirImovel($idImovel);

	}	
 }
 
	function salvarImovel(){
		$imovel = new Imovel_Model();
		$imovel->tipo= $_POST["tipoImovel"];
		$imovel->situacao = "D";//$_POST["situacao"];
		$imovel->status = $_POST["status"];
		$imovel->observacao =  $_POST["observacao"];
		$imovel->valor = $_POST["valor"];
		
		$imovelControle = new Imovel_Controle();
		$imovelControle->salvarImovel($imovel);
	}
	
	function salvarEndereco(){
		$endereco = new Endereco_Model();
		$idImovel = $_POST["txtIdImovel"];
		$endereco->rua = $_POST["rua"];
		$endereco->bairro= $_POST["bairro"];
		$endereco->cidade = $_POST["cidade"];
		$endereco->uf = $_POST["uf"];
		$endereco->cep = $_POST["cep"];
		$endereco->idEndereco = $_POST["txtIdEndereco"];
		$idProprietario = $_POST["txtIdProprietario"];
	
		$imovelControle = new Imovel_Controle();
		$imovelControle->salvarEndImovel($idImovel,$idProprietario,$endereco);
	}
	
	function salvarProprietario(){
		$proprietario = new Proprietario_Model();
		$idImovel = $_POST["txtIdImovelProp"];
		$proprietario->nome = $_POST["nome"];
		$proprietario->cpf= $_POST["cpf"];
		$proprietario->telefoneContato = $_POST["telefoneContato"];
		$proprietario->email = $_POST["emailProprietario"];
		$proprietario->idProprietario = $_POST["txtIdProprietario"];
		$idEndereco = $_POST["txtIdEndereco"];
	
		$imovelControle = new Imovel_Controle();
		$imovelControle->salvarPropImovel($idImovel, $idEndereco,$proprietario);
	}
	
	function alterarImovel(){
		$imovel = new Imovel_Model();
		$imovel->idImovel = $_POST["idImovel"];
		$idEndereco = $_POST["txtIdEndereco"];
		$idProprietario = $_POST["txtIdProprietario"];
		$imovel->tipo = $_POST["tipoImovel"];
		//$imovel->situacao= $_POST["situacao"];
		$imovel->status = $_POST["status"];
		$imovel->observacao =  $_POST["observacao"];
		$imovel->valor = $_POST["valor"];		
	
		$imovelControle = new Imovel_Controle();
		$imovelControle->alterarImovel($imovel,$idEndereco,$idProprietario);
	}
	
	function excluirImovel($idImovel){	
		$imovelControle = new Imovel_Controle();
		$imovelControle->excluirImovel($idImovel);
	}
?>
