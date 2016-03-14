 <?php
 define('__ROOT__',dirname(dirname(__FILE__)));
 require_once(__ROOT__. '/modelo/cliente.model.php');
 require_once(__ROOT__. '/modelo/endereco.model.php');
 require_once(__ROOT__.'/controle/cliente.controle.php');

		
 if ($_SESSION["USUARIO"] != '')
 {
	if(isset($_POST["salvar"]) == 'Salvar'){
		salvarCliente();
	}

	if(isset($_POST["alterar"]) == 'Alterar'){
		alterarCliente();
	}
	
	if(isset($_POST["salvarEnd"]) == 'Salvar'){
		salvarEndereco();
	}
	
	if(isset($_REQUEST["idCliente"]) != '0' && isset($_REQUEST["tipo"]) == 'DLT')
	{
		$idCliente = $_REQUEST["idCliente"];
		excluirCliente($idCliente);
	}
	
 }
 
	function salvarCliente(){
		$cliente = new Cliente_Model();
		$cliente->nome = $_POST["nome"];
		$cliente->email= $_POST["emailCliente"];
		$cliente->cpf = $_POST["cpf"];
		$cliente->status = $_POST["status"];
		$cliente->rg = $_POST["rg"];
		$cliente->telefoneCelular = $_POST["telefoneCelular"];
		$cliente->dataNascimento = $_POST["dataNascimento"];
		
		$clienteControle = new Cliente_Controle();
		$clienteControle->salvarCliente($cliente);
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
	
	function alterarCliente(){
		$cliente = new Cliente_Model();
		$cliente->idCliente = $_POST["idCliente"];
		$idEndereco = $_POST["txtIdEndereco"];
		$cliente->nome = $_POST["nome"];
		$cliente->email= $_POST["emailCliente"];
		$cliente->cpf = $_POST["cpf"];
		$cliente->status = $_POST["status"];
		$cliente->rg = $_POST["rg"];
		$cliente->telefoneCelular = $_POST["telefoneCelular"];
		$cliente->dataNascimento = $_POST["dataNascimento"];		
	
		$clienteControle = new Cliente_Controle();
		$clienteControle->alterarCliente($cliente,$idEndereco);
	}
	
	function excluirCliente($idCliente){	
		$clienteControle = new Cliente_Controle();
		$clienteControle->excluirCliente($idCliente);
	}
?>
