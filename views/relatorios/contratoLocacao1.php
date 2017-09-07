<?php 
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/acoes_contrato.controle.php');
	require_once(__ROOT__.'/controle/usuario.controle.php');
	require_once(__ROOT__.'/modelo/word.model.php');
	
	$controleUsuario = new Usuario_Controle();
	$usuario = $controleUsuario->getUsuario($_SESSION["USUARIO"]);
	$logo = str_replace("..","", $usuario->caminhoLogo);
	$logo = "http://".$_SERVER["HTTP_HOST"]."/views". $logo;
	
	$controleVO = new acoes_Contrato_Controle();
	$idContrato = $_GET["codContrato"];
	$contrato = $controleVO->getContrato($idContrato);
	$footer =  utf8_encode($usuario->nome) .' - Administra&ccedil;&atilde;o & Consultoria Imobili&aacute;ria - '.$usuario->numeroCRA. '-' .$usuario->numeroCRECI
	. ' Tel.: ' .$usuario->telefoneContato .' - E-mail: '.$usuario->login;
	
	if ($contrato->tipo == 'L')
	{
		$usuario_documento = $controleUsuario->getDocumentoUsuarioPorNome($usuario->idUsuario, 'Contrato de Locacao');
		$htmlPadrao = $usuario_documento->documento;
	}
	
	if ($contrato->tagContrato == '' or $contrato->tagContrato == null)
	{
			$dataReajuste = $contrato->dataReajuste;
			$partes_data = explode('-', $dataReajuste);
			$dataFormatada= $partes_data[2] ."/". $partes_data[1] ."/". $partes_data[0];
				
			$cliente      = $controleVO->getCliente($contrato->cliente);
			$imovel       = $controleVO->getImovel($contrato->imovel);
			$proprietario = $controleVO->getProprietario($imovel->proprietario);
			$endCli       = $controleVO->getEndereco($cliente->endereco);
			$endImo       = $controleVO->getEndereco($imovel->endereco);
			$endPro       = $controleVO->getEndereco($proprietario->endereco);
			$estado       = $controleVO->getEstado($endCli->uf);
			$fiadores     = $controleVO->listaFiadores($contrato->idContrato);
			
			//$logo = str_replace("..","", $usuario->caminhoLogo);
			
			//locahost
			//$logo = "http://".$_SERVER["HTTP_HOST"]."/views". $logo;
			
			//produ��o
			//$logo = "http://".$_SERVER["HTTP_HOST"]."/views". $logo;
			
			$nome = '';
			foreach ((array)$fiadores as $fia) {
				$nome  = $nome . $fia->nome . " , ";
			}
		
			if ($contrato->tipo == 'L')
			{
				//$htmlPadrao = str_replace('.$logo.',$logo, $htmlPadrao);
				$htmlPadrao = str_replace('".$dataFormatada."',$dataFormatada, $htmlPadrao);
				$htmlPadrao = str_replace('".$estado."',$estado, $htmlPadrao);
				$htmlPadrao = str_replace('".$nome."',$nome, $htmlPadrao);
				$htmlPadrao = str_replace('".$usuario->nome."',$usuario->nome, $htmlPadrao);
				$htmlPadrao = str_replace('".$usuario->banco."',$usuario->banco, $htmlPadrao);
				$htmlPadrao = str_replace('".$usuario->agencia."',$usuario->agencia, $htmlPadrao);
				$htmlPadrao = str_replace('".$usuario->tipoConta."',$usuario->tipoConta, $htmlPadrao);
				$htmlPadrao = str_replace('".$usuario->conta."',$usuario->conta, $htmlPadrao);
				$htmlPadrao = str_replace('".$usuario->numeroCRA."',$usuario->numeroCRA, $htmlPadrao);
				$htmlPadrao = str_replace('".$usuario->numeroCRECI."',$usuario->numeroCRECI, $htmlPadrao);
				$htmlPadrao = str_replace('".$proprietario->nome."',$proprietario->nome, $htmlPadrao);
				$htmlPadrao = str_replace('".$proprietario->rg."',$proprietario->rg, $htmlPadrao);
				$htmlPadrao = str_replace('".$proprietario->cpf."',$proprietario->cpf, $htmlPadrao);
				$htmlPadrao = str_replace('".$endPro->rua."',$endPro->rua, $htmlPadrao);
				$htmlPadrao = str_replace('".$endPro->cidade."',$endPro->cidade, $htmlPadrao);
				$htmlPadrao = str_replace('".$endPro->uf."',$endPro->uf, $htmlPadrao);
				$htmlPadrao = str_replace('".$endPro->cep."',$endPro->cep, $htmlPadrao);
				$htmlPadrao = str_replace('".$endPro->bairro."',$endPro->bairro, $htmlPadrao);
				$htmlPadrao = str_replace('".$cliente->nome."',$cliente->nome, $htmlPadrao);
				$htmlPadrao = str_replace('".$cliente->rg."',$cliente->rg, $htmlPadrao);
				$htmlPadrao = str_replace('".$cliente->cpf."',$cliente->cpf, $htmlPadrao);
				$htmlPadrao = str_replace('".$endCli->rua."',$endCli->rua, $htmlPadrao);
				$htmlPadrao = str_replace('".$endCli->cidade."',$endCli->cidade, $htmlPadrao);
				$htmlPadrao = str_replace('".$endCli->uf."',$endCli->uf, $htmlPadrao);
				$htmlPadrao = str_replace('".$endCli->cep."',$endCli->cep, $htmlPadrao);
				$htmlPadrao = str_replace('".$endCli->bairro."',$endCli->bairro, $htmlPadrao);
				$htmlPadrao = str_replace('".$endImo->rua."',$endImo->rua, $htmlPadrao);
				$htmlPadrao = str_replace('".$endImo->cidade."',$endImo->cidade, $htmlPadrao);
				$htmlPadrao = str_replace('".$endImo->uf."',$endImo->uf, $htmlPadrao);
				$htmlPadrao = str_replace('".$endImo->cep."',$endImo->cep, $htmlPadrao);
				$htmlPadrao = str_replace('".$endImo->bairro."',$endImo->bairro, $htmlPadrao);
				$htmlPadrao = str_replace('".$contrato->valorContrato."',$contrato->valorContrato, $htmlPadrao);
				$htmlPadrao = str_replace('".$contrato->diaVencimento."',$contrato->diaVencimento, $htmlPadrao);
				$htmlPadrao = str_replace('".$contrato->multaMora."',$contrato->multaMora, $htmlPadrao);
				$htmlPadrao = str_replace('".$contrato->multaAtraso."',$contrato->multaAtraso, $htmlPadrao);
				$htmlPadrao = str_replace('".$contrato->nomeTest1."',$contrato->nomeTest1, $htmlPadrao);
				$htmlPadrao = str_replace('".$contrato->cpfTest1."',$contrato->cpfTest1, $htmlPadrao);
				$htmlPadrao = str_replace('".$contrato->nomeTest2."',$contrato->nomeTest2, $htmlPadrao);
				$htmlPadrao = str_replace('".$contrato->cpfTest2."',$contrato->cpfTest2, $htmlPadrao);				
			}
		 	 
	}
	else {
		$htmlPadrao = $contrato->tagContrato;
	}
	//gravar HTML no banco
	
	$html = $htmlPadrao;
	$controleVO->salvarHTML($idContrato, $html);
	
	include ('../MPDF57/mpdf.php'); 
	$mpdf = new mPDF ();
	$cabecalho = '<div><img src="'.$logo.'" border="0" width="120" height="60" /></div>';
	$mpdf->SetHTMLHeader($cabecalho); //cabe�alho em html. Aqui uso imagem
	$rodape = '<div align="center" style="font-size:9;margin-left:70x;" width="520px">'.$footer.'</div>';

	$mpdf->SetHTMLFooter($rodape);	
	//marca dagua. 1� parametro = caminho da imagem ou texto, 2� = transparencia, 3� = Centrado sobre toda a p�gina, ou Centrado sobre a area impressa respeitando a margem.
	$mpdf->SetWatermarkImage($logo,'0.15',F);
	$mpdf->showWatermarkImage = true;	
	$mpdf->AddPage('','','','','',20,20,25,10,5,5);	
	$mpdf->ignore_invalid_utf8 = true;
	$mpdf->charset_in='iso-8859-1';
	$mpdf->WriteHTML ($html); 
	$mpdf->Output (); 	
	exit (); 
	//no servidor de produção comentar a linha utf-8 e iso-8859-1
?>

<!-- <html> 
<body> 
<textarea rows="100" cols="100"><?=$html;?></textarea>
</body> 
</html> -->
 
