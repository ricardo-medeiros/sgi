<?php 
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/acoes_contrato.controle.php');
	$controleVO = new acoes_Contrato_Controle();
	$idContrato = $_GET["editContrato"];
	$contrato = $controleVO->getContrato($idContrato);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Editar Contrato</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"></link> -->
<link rel="stylesheet"	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css">
<link href="../editor/editor.css" type="text/css" rel="stylesheet"/>
<script	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="../editor/editor.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#contrato-modal').modal('show');
		$("#txtEditor").Editor(); 		
	});
	function getText() {
		var html = $('#txtEditor').Editor('getText');
		document.getElementById("htmlAtual").value = html;
	}
	function setText(texto) {
		$('#txtEditor').Editor('setText',texto);		
	}
	function Fechar(){
		window.top.location.href = "../site/contrato.php";
	}	
</script>
</head>
<body style="margin: 0">
	<form action="/controle/implContrato.php" method="post" role="form" id="form">
		<div id="txtEditor">
		
		</div>
		<textarea hidden="hidden" name="html" rows="100" cols="100" id="text"><?=$contrato->tagContrato?></textarea>
		<textarea hidden="hidden" name="htmlAtual" rows="100" cols="100" id="htmlAtual"></textarea>
		<input type="hidden" id="idContrato" name="idContrato" value="<?=$contrato->idContrato?>">
		<div id="salvarEditor" class="modal-footer">
			<button type="button" data-toggle="modal" data-target="#restaurar-contrato-modal" class="btn btn-success" value="Restaurar">Restaurar Documento</button>
			<button type="submit" id="salvarHTML" name="salvarHTML" class="btn btn-success" value="Salvar" onclick="getText()" data-dismiss="modal">Atualizar</button> 
		</div>
	</form>
<!-- Modal Contrato-->
<div class="modal fade" id="contrato-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="margin-top: 70px;">
  <div class="modal-dialog" role="document" style="width: 75%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
        	<span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Editar Contrato</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
			Confirmar Edi&ccedil;&atilde;o deste Contrato?
      </div>
      <div class="modal-footer">    
        <a href="#" onclick="setText(document.getElementById('text').value)"><button type="button" class="btn btn-success" data-dismiss="modal">Sim</button></a>
		<a href="#" onclick="Fechar()"><button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button></a>
      </div>
    </div>
  </div>
</div>	

<!-- Modal Restaurar Contrato-->
<div class="modal fade" id="restaurar-contrato-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="margin-top: 70px;">
  <div class="modal-dialog" role="document" style="width: 75%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
        	<span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title" id="modalLabel">Documento Padr&atilde;o de Contrato</h3>
      </div>
      <div class="modal-body" style="text-align: center;">
			Deseja Restaurar o Documento Padr&atilde;o deste Contrato?
      </div>
      <div class="modal-footer">    
        <a href="#" onclick="setText(document.getElementById('text').value)"><button type="button" class="btn btn-success" data-dismiss="modal">Sim</button></a>
		<button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
      </div>
    </div>
  </div>
</div>
</body>
</html>



