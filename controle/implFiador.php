 <?php
 define('__ROOT__',dirname(dirname(__FILE__)));
 require_once(__ROOT__. '/modelo/fiador.model.php');
 require_once(__ROOT__.'/controle/fiador.controle.php');

		
 if ($_SESSION["USUARIO"] != '')
 {
	if(isset($_POST["salvar"]) == 'Salvar'){
		salvarFiador();
	}

	if(isset($_POST["alterar"]) == 'Alterar'){
		alterarFiador();
	}
	
	if(isset($_POST["salvarEnd"]) == 'Salvar'){
		salvarEndereco();
	}
	
	if(isset($_REQUEST["idFiador"]) != '0' && isset($_REQUEST["tipo"]) == 'DLT')
	{
		$idFiador = $_REQUEST["idFiador"];
		excluirFiador($idFiador);
	}
	
 }
 
	function salvarFiador(){
		$fiador = new Fiador_Model();
		$fiador->nome = $_POST["nome"];
		$fiador->email= $_POST["emailFiador"];
		$fiador->cpf = $_POST["cpf"];
		$fiador->rg = $_POST["rg"];
		$fiador->telefoneContato = $_POST["telefoneContato"];
		
		$fiadorControle = new Fiador_Controle();
		$fiadorControle->salvarFiador($fiador);
	}
	
	function salvarEndereco(){
		$endereco = new Endereco_Model();
		$idFiador = $_POST["txtIdFiador"];
		$endereco->rua = $_POST["rua"];
		$endereco->bairro= $_POST["bairro"];
		$endereco->cidade = $_POST["cidade"];
		$endereco->uf = $_POST["uf"];
		$endereco->cep = $_POST["cep"];
		$endereco->idEndereco = $_POST["txtIdEndereco"];
	
		$fiadorControle = new Fiador_Controle();
		$fiadorControle->salvarEndFiador($idFiador,$endereco);
	}
	
	function alterarFiador(){
		$fiador = new Fiador_Model();
		$fiador->idFiador = $_POST["idFiador"];
		$idEndereco = $_POST["txtIdEndereco"];
		$fiador->nome = $_POST["nome"];
		$fiador->email= $_POST["emailFiador"];
		$fiador->cpf = $_POST["cpf"];
		$fiador->rg = $_POST["rg"];
		$fiador->telefoneContato = $_POST["telefoneContato"];
	
		$fiadorControle = new Fiador_Controle();
		$fiadorControle->alterarFiador($fiador,$idEndereco);
	}
	
	function excluirFiador($idFiador){	
		$fiadorControle = new Fiador_Controle();
		$fiadorControle->excluirFiador($idFiador);
	}
?>
