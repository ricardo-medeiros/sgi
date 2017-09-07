<?php 
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/usuario.controle.php');
	$usuarioControle = new Usuario_Controle();
	$idDocumento = $_GET["idDocumento"];
	$idUsuario = $_GET["idUsuario"];
	$usuario_documento = $usuarioControle->getDocumentoUsuario($idUsuario, $idDocumento);
	$codigo = base64_encode($idUsuario);
	//echo $idDocumento;
	//echo $idUsuario;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Editar Documento</title>
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
		$('#documento-modal').modal('show');
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
		window.top.location.href = "../site/documentos.php?idUsuario=<?=$codigo?>";
	}	
// 	function restaurar(documento,usuario) {
// 		document.getElementById("idDocumentoR").value = documento;
// 		document.getElementById("idUsuarioR").value = usuario;
// 	}
</script>
</head>
<body style="margin: 0">
	<form action="/controle/implUsuario.php" method="post" role="form" id="form">
		<div id="txtEditor">
		
		</div>
		<textarea hidden="hidden" name="html" rows="100" cols="100" id="text"><?=$usuario_documento->documento?></textarea>
		<textarea hidden="hidden" name="htmlAtual" rows="100" cols="100" id="htmlAtual"></textarea>
		<input type="hidden" id="idDocumento" name="idDocumento" value="<?=$usuario_documento->idDocumento?>">
		<input type="hidden" id="idUsuario" name="idUsuario" value="<?=$codigo?>">
		<div id="salvarEditor" class="modal-footer">
			<button type="button" class="btn btn-success" data-toggle="modal" data-target="#restaurar-documento-modal" value="Restaurar">Restaurar Documento</button>
			<button type="submit" id="salvarHTML" name="salvarHTML" class="btn btn-success" value="Salvar" onclick="getText()" data-dismiss="modal">Atualizar</button> 
		</div>
	</form>
<!-- Modal Contrato-->
<div class="modal fade" id="documento-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="margin-top: 70px;">
  <div class="modal-dialog" role="document" style="width: 75%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
        	<span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Editar Documento</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
			Continuar com a  Edi&ccedil;&atilde;o deste Documento?
      </div>
      <div class="modal-footer">    
        <a href="#" onclick="setText(document.getElementById('text').value)"><button type="button" class="btn btn-success" data-dismiss="modal">Sim</button></a>
		<a href="#" onclick="Fechar()"><button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button></a>
      </div>
    </div>
  </div>
</div>	

<!-- Modal Restaurar Contrato-->
<div class="modal fade" id="restaurar-documento-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="margin-top: 70px;">
  <div class="modal-dialog" role="document" style="width: 75%;">
    <div class="modal-content">
       <form action="/controle/implUsuario.php" method="post" id="form2" role="form">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
	        	<span aria-hidden="true">&times;</span></button>
	        <h3 class="modal-title" id="modalLabel">Documento Padr&atilde;o</h3>
	      </div>
	      <input type="text" id="idDocumentoR" name="idDocumentoR" value="<?=$usuario_documento->idDocumento?>">
		  <input type="text" id="idUsuarioR" name="idUsuarioR" value="<?=$usuario_documento->usuario?>">
	      <div class="modal-body" style="text-align: center;">
				Deseja Restaurar o Documento Padr&atilde;o, para a vers&atilde;o inicial do Sistema?<br>
	      
		  <font style="text-align: center; color: red;">
				Essa opera&ccedil;&atilde;o ir&aacute; apagar todas as modifica&ccedil;&otilde;es feitas at&eacute; agora.
	      </font>    </div>  
	      <div class="modal-footer">    
	      	<button type="submit" id=restaurarHTML name="restaurarHTML" class="btn btn-success" value="Sim">Sim</button>
			<button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
	      </div>
	   </form>
    </div>
  </div>
</div>
</body>
</html>



