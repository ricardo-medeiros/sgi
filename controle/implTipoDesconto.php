 <?php
 define('__ROOT__',dirname(dirname(__FILE__)));
 require_once(__ROOT__. '/modelo/tipo_desconto.model.php');
 require_once(__ROOT__.'/controle/tipo_desconto.controle.php');

		
 if ($_SESSION["USUARIO"] != '')
 {
	if(isset($_POST["salvar"]) == 'Salvar'){
		salvarTipoDesconto();
	}

	if(isset($_POST["alterar"]) == 'Alterar'){
		alterarTipoDesconto();
	}
	
	if(isset($_REQUEST["idTipoDesconto"]) != '0' && isset($_REQUEST["tipo"]) == 'DLT')
	{
		$idTipoDesconto = $_REQUEST["idTipoDesconto"];
		excluirTipoDesconto($idTipoDesconto);
	}
	
 }
 
	function salvarTipoDesconto(){
		$tipoDesconto = new Tipo_Desconto_Model();
		$tipoDesconto->descDesconto = $_POST["descDesconto"];
		$tipoDesconto->tipo = $_POST["tipoDesc"];
		
		$tipoDescontoControle = new Tipo_Desconto_Controle();
		$tipoDescontoControle->salvarTipoDesconto($tipoDesconto);
	}
	
	
	function alterarTipoDesconto(){
		$tipoDesconto = new Tipo_Desconto_Model();
		$tipoDesconto->descDesconto = $_POST["descDesconto"];
		$tipoDesconto->idTipoDesconto = $_POST["idTipoDesconto"];
		$tipoDesconto->tipo = $_POST["tipoDesc"];
	
		$tipoDescontoControle = new Tipo_Desconto_Controle();
		$tipoDescontoControle->alterarTipoDesconto($tipoDesconto);
	}
	
	function excluirTipoDesconto($idTipoDesconto){	
		$tipoDescontoControle = new Tipo_Desconto_Controle();
		$tipoDescontoControle->excluirTipoDesconto($idTipoDesconto);
	}
?>
