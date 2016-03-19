 <?php
 define('__ROOT__',dirname(dirname(__FILE__)));
 require_once(__ROOT__. '/modelo/proprietario.model.php');
 //require_once(__ROOT__. '/modelo/endereco.model.php');
 require_once(__ROOT__.'/controle/proprietario.controle.php');

		
 if ($_SESSION["USUARIO"] != '')
 {
	if(isset($_POST["salvar"]) == 'Salvar'){
		salvarProprietario();
	}

	if(isset($_POST["alterar"]) == 'Alterar'){
		alterarProprietario();
	}
	
	if(isset($_POST["salvarEnd"]) == 'Salvar'){
		salvarEndereco();
	}
	
	if(isset($_REQUEST["idProprietario"]) != '0' && isset($_REQUEST["tipo"]) == 'DLT')
	{
		$idProprietario = $_REQUEST["idProprietario"];
		excluirProprietario($idProprietario);
	}
	
 }
 
	function salvarProprietario(){
		$proprietario = new Proprietario_Model();
		$proprietario->nome = $_POST["nome"];
		$proprietario->email= $_POST["emailProprietario"];
		$proprietario->cpf = $_POST["cpf"];
		$proprietario->telefoneContato = $_POST["telefoneContato"];
		
		$proprietarioControle = new Proprietario_Controle();
		$proprietarioControle->salvarProprietario($proprietario);
	}
	
	function salvarEndereco(){
		$endereco = new Endereco_Model();
		$idCliente = $_POST["txtIdCliente"];
		$endereco->rua = $_POST["rua"];
		$endereco->bairro= $_POST["bairro"];
		$endereco->cidade = $_POST["cidade"];
		$endereco->uf = $_POST["uf"];
		$endereco->cep = $_POST["cep"];
		$endereco->idEndereco = $_POST["txtIdEndereco"];
	
		$clienteControle = new Cliente_Controle();
		$clienteControle->salvarEndCliente($idCliente,$endereco);
	}
	
	function alterarProprietario(){
		$proprietario = new Proprietario_Model();
		$proprietario->idProprietario = $_POST["idProprietario"];
		//$idEndereco = $_POST["txtIdEndereco"];
		$proprietario->nome = $_POST["nome"];
		$proprietario->email= $_POST["emailProprietario"];
		$proprietario->cpf = $_POST["cpf"];
		$proprietario->telefoneContato = $_POST["telefoneContato"];
	
		$proprietarioControle = new Proprietario_Controle();
		//$proprietarioControle->alterarCliente($cliente,$idEndereco);
		$proprietarioControle->alterarProprietario($proprietario);
	}
	
	function excluirProprietario($idProprietario){	
		$proprietarioControle = new Proprietario_Controle();
		$proprietarioControle->excluirProprietario($idProprietario);
	}
?>
