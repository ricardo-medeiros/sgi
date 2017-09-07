<?php 
	session_start();
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/usuario.controle.php');
	require_once(__ROOT__.'/controle/verifica.login.php');
	
	$verifica = new verifica_login();
	$ok = $verifica->verifica();
	
	if ($ok){
		echo "<script type='text/javascript' language='javascript'>
				window.top.location.href = '/index.php';
			  </script>";
	}
	
	$controleUsuario = new Usuario_Controle();
	$idUsuario = base64_decode($_REQUEST["idUsuario"]);
	$lista = $controleUsuario->listaDocsUsuario($idUsuario);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Documentos do Corretor</title>
<!-- <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"></link> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css"	href="https://cdn.datatables.net/1.10.8/css/dataTables.bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/dataTables.bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">

	$(document).ready(function() {
		$('#tbldocumento').DataTable(
			{
				"language" : {
					"url" : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
				},
				"dom": "Bfrtip"
			});			
	});

	function Editor(documento,usuario){	
		if(documento > 0)
		{
			
			var novadiv = '<object data="editarDocumento.php?idDocumento='+documento+'&idUsuario='+usuario+'" type="text/html" style="display: block; border: none; height: 80vh; width: 70vw; text-align: center;"></object>';
			$('#doc').html(novadiv);
			$('#documento-modal').modal('show');
		}
	}

	function Fechar(){
		var codigo = document.getElementById('codigo').value; 
		window.top.location.href = "usuario.php?usuario="+codigo;
	}	 
</script>
</head>
<body>
<div align="center">   
	<div class="container" style="margin-top: 80px; width: 70%;">		 
		<table style="font-size: 12px; ">
			  <tr>
			    <td style="vertical-align: top;">
			    	<?php $tipo   = base64_encode('INS');
			    		  $codigo = base64_encode($idUsuario);
			    	?>
			    	<input type="hidden" value="<?=$codigo?>" id="codigo"></input>
			    	<a href="#" onclick="Fechar()"><button type="button" class="btn btn-success" data-dismiss="modal">Voltar</button></a>&nbsp;
			    </td>
				<td>							
					<table id="tbldocumento" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="10px"></th>
								<th width="10px"></th>						
								<th width="40px">Codigo</th>
								<th width="350px">Nome Documento</th>
							</tr>
						</thead>

						<tbody>
						<?php 
							foreach ((array)$lista as $usuario_documento) {
								 $tipo   = base64_encode('UPD');
								 $tipo1  = base64_encode('CNS');
								 $codigo = base64_encode($usuario_documento->idDocumento);								
						 ?>
								<tr>									
									<td align="center"><a href="#" onclick="Editor(<?=$usuario_documento->idDocumento ?>,<?=$usuario_documento->usuario ?>)">
										<input type="hidden" id="idUsuario" value="<?=$usuario_documento->usuario ?>"></input>
										 <span class="glyphicon glyphicon-search" aria-hidden="true" title="Consultar"></span>
									</a></td>
									<td align="center">
									<a href="#" onclick="Editor(<?=$usuario_documento->idDocumento ?>,<?=$usuario_documento->usuario ?>)">
											 <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Alterar"></span>
									</a></td>																
									<td align="center"><?php echo $usuario_documento->idDocumento ?></td>
									<td><?php echo $usuario_documento->nome ?></td>								
								</tr>		
						<?php
						}
						?>		
						</tbody>
					</table>
				   </td>
			    </tr>		
		</table>						    
	</div>  
</div>


<!-- Modal Contrato-->
<div class="modal fade" id="documento-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="margin-top: 60px;">
  <div class="modal-dialog" role="document" style="width: 75%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
        	<span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="modalLabel">Documento Padr&atilde;o</h5>
        <br>
         <font style="text-align: center; color: red; font-size: 12px;">
			N&atilde;o &eacute; recomend&aacute;vel apagar as palavras no documento que est&atilde;o com a seguinte express&atilde;o: ".$exemplo.", pois estas palavras s&atilde;o de configura&ccedil;&atilde;o do documento.
      	 </font> 
      </div>
      <div class="modal-body" style="text-align: center;" id="doc">

      </div>
    </div>
  </div>
</div>
</body>
</html>