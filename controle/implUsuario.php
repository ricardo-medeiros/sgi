<?php 
	define('__ROOT__',dirname(dirname(__FILE__)));
	require_once(__ROOT__. '/modelo/usuario.model.php');
	require_once(__ROOT__. '/modelo/endereco.model.php');
	require_once(__ROOT__.'/controle/usuario.controle.php');
	define('UPLOAD_DIR',dirname(dirname(__FILE__))."\\views\\logo\\");
	
	
	if(isset($_POST["salvar"]) == 'Salvar'){
		salvarUsuario();
	}

	if(isset($_POST["alterar"]) == 'Alterar'){
		alterarUsuario();
	}
	
	if(isset($_POST["salvarEnd"]) == 'Salvar'){
		salvarEndereco();
	}
	
	if(isset($_REQUEST["idUsuario"]) != '0' && isset($_REQUEST["tipo"]) == 'DLT')
	{
		$idUsuario = $_REQUEST["idUsuario"];
		excluirUsuario($idUsuario);
	}
	
	if(isset($_POST["salvarHTML"]) == 'Atualizar')
	{
		$idDocumento = $_POST["idDocumento"];
		$idUsuario = $_POST["idUsuario"];
		$html   = $_POST["htmlAtual"];
		atualizaHtmlContrato($idDocumento,$idUsuario,$html);
	}
	
	if(isset($_POST["restaurarHTML"]) == 'Sim')
	{
		$idDocumento = $_POST["idDocumentoR"];
		$idUsuario = $_POST["idUsuarioR"];
		restaurarHtmlContrato($idDocumento,$idUsuario);
	}

	function salvarUsuario(){
		$usuario = new Usuario_Model();
		$usuario->nome = $_POST["nome"];
		$usuario->login= $_POST["login"];
		$usuario->cpf = $_POST["cpf"];
		$usuario->status = $_POST["status"];
		$usuario->banco= $_POST["banco"];
		$usuario->agencia= $_POST["agencia"];
		$usuario->conta= $_POST["conta"];	
		$usuario->tipoConta= $_POST["tipoConta"];
		$usuario->numeroCRA= $_POST["numeroCRA"];
		$usuario->numeroCRECI= $_POST["numeroCRECI"];
		$usuario->senha = $_POST["senha"];
		$usuario->telefoneContato = $_POST["telefoneCelular"];
		$usuario->caminhoLogo = $_POST["caminhoLogo"];
		
		$usuarioControle = new Usuario_Controle();
		$usuarioControle->salvarUsuario($usuario);
	}
	
	function salvarEndereco(){
		$endereco = new Endereco_Model();
		$idUsuario = $_POST["txtIdUsuario"];
		$endereco->rua = $_POST["rua"];
		$endereco->bairro= $_POST["bairro"];
		$endereco->cidade = $_POST["cidade"];
		$endereco->uf = $_POST["uf"];
		$endereco->cep = $_POST["cep"];
		$endereco->idEndereco = $_POST["txtIdEndereco"];
	
		$usuarioControle = new Usuario_Controle();
		$usuarioControle->salvarEndUsuario($idUsuario,$endereco);
	}
	
	function alterarUsuario(){
		$usuario = new Usuario_Model();
		$usuario->idUsuario = $_POST["idUsuario"];
		$idEndereco = $_POST["txtIdEndereco"];
		$usuario->nome = $_POST["nome"];
		//$usuario->login= $_POST["login"];
		$usuario->cpf = $_POST["cpf"];
		//$usuario->status = $_POST["status"];
		$usuario->banco= $_POST["banco"];
		$usuario->agencia= $_POST["agencia"];
		$usuario->conta= $_POST["conta"];
		$usuario->tipoConta= $_POST["tipoConta"];
		$usuario->numeroCRA= $_POST["numeroCRA"];
		$usuario->numeroCRECI= $_POST["numeroCRECI"];
		$usuario->senha = $_POST["senha"];
		$usuario->telefoneContato = $_POST["telefoneCelular"];
		$logo = $_POST["txtLogotipo"];
				
		if($_FILES['caminhoLogo']['name'])
		{
			
			if(!$_FILES['caminhoLogo']['error'])
			{
				$ext = explode(".", $_FILES['caminhoLogo']['name']);
				$new_file_name = $_POST["cpf"] .".jpg";
				if ($ext[1] == "jpg" || $ext[1] == "gif" || $ext[1] == "jpeg" || $ext[1] == "png")
				{				
					move_uploaded_file($_FILES['caminhoLogo']['tmp_name'], "../views/logo/". $new_file_name);
					$usuario->caminhoLogo = "../logo/".$new_file_name;
				}
			}
		}		
		else 
		{
			if($logo == ''){
				$usuario->caminhoLogo = "../logo/logoVazia.png";
			}
			else
			{
				$usuario->caminhoLogo = $logo;
			}
		}
		
		
		$usuarioControle = new Usuario_Controle();
		$usuarioControle->alterarUsuario($usuario,$idEndereco);
	}
	
	function excluirUsuario($idUsuario){	
		$usuarioControle = new Usuario_Controle();
		$usuarioControle->excluirUsuario($idUsuario);
	}
	
	function atualizaHtmlContrato($idDocumento,$idUsuario,$html){
		$usuarioControle = new Usuario_Controle();
		$usuarioControle->salvarHTML($idDocumento,$idUsuario,$html);
	}
	
	function restaurarHtmlContrato($idDocumento,$idUsuario){
		$usuarioControle = new Usuario_Controle();
		$usuarioControle->restaurarHTML($idDocumento,$idUsuario);
	}
?>
