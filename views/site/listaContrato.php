<?php 
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/contrato.controle.php');
	$controleContrato = new Contrato_Controle();
	$lista = $controleContrato->listaContrato();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="ISO-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lista de Contratos</title>
<!-- <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"></link> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css"	href="https://cdn.datatables.net/1.10.8/css/dataTables.bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/dataTables.bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf-8">
	var x;
	//
	$(document).ready(function() {
		$('#tbcontrato').DataTable(
			{
				"language" : {
					"url" : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
				},
				"dom": "Bfrtip"
			});		
		//imprimir
// 		$("#imprimir").click(function(){
// 			var contrato = document.getElementById('codContrato').value;			
// 			if(contrato != '')
// 			{
// 				var novadiv = '<object data="../relatorios/contratoLoc1.php?codContrato='+contrato+'" type="text/html" style="display: block; border: none; height: 70vh; width: 70vw; text-align: center;"></object>';
// 				$('#relat').html(novadiv);
// 				$('#contrato-modal').modal('show');
// 			}
			
// 		});	
	});
	 
	function Contrato(contrato){		
		document.getElementById('txtContrato').value = contrato;
	}

	function Relatorio(contrato,imovel, cliente){	
		if (imovel > 0 && cliente > 0)
		{
			if(contrato != '')
			{
				var novadiv = '<object data="../relatorios/contratoLocacao1.php?codContrato='+contrato+'" type="text/html" style="display: block; border: none; height: 70vh; width: 70vw; text-align: center;"></object>';
				$('#relat').html(novadiv);
				$('#contrato-modal').modal('show');
			}
		}
		else
		{
			alert('Contrato ainda nao existe Cliente ou Imovel, por isso nao pode ser impresso, favor verificar!');
		}
	}

	function Editor(contrato,html){	
		if (html == true)
		{
			if(contrato != '')
			{
				
				var novadiv = '<object data="../editor/editarContrato.php?editContrato='+contrato+'" type="text/html" style="display: block; border: none; height: 80vh; width: 70vw; text-align: center;"></object>';
				$('#relat').html(novadiv);
				$('#contrato-modal').modal('show');
			}
		}
		else
		{
			alert('Contrato ainda nao foi gerado, nao pode ser editado');
		}
	}
	
	function redirecionaModal(contrato){
		location.href='/controle/implContrato.php?tipo=DLT&idContrato='+contrato;
	}
	
</script>
</head>
<body>
<div align="center">   
	<div class="container" style="margin-top: 80px; width: 100%;">		 
		<table style="font-size: 12px; ">
			  <tr>
			    <td style="vertical-align: top;">
			    	<?php $tipo   = base64_encode('INS');
			    		  $codigo = base64_encode(0);
			    	?>
			    	<a href="cadContrato.php?tipo=<?=$tipo?>&idContrato=<?=$codigo?>"><button type="button" class="btn btn-success" data-dismiss="modal">Novo</button></a>&nbsp;
			    </td>
				<td>							
					<table id="tbcontrato" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="10px"></th>
								<th width="10px"></th>
								<th width="10px"></th>
								<th width="10px"></th>
								<th width="10px"></th>								
								<th width="40px">Codigo</th>
								<th width="60px">Tipo</th>
								<th width="60px">Situacao</th>
								<th width="350px">Observacao</th>
							</tr>
						</thead>

						<tbody>
						<?php 
							foreach ((array)$lista as $contrato) {
								 $tipo   = base64_encode('UPD');
								 $tipo1  = base64_encode('CNS');
								 $codigo = base64_encode($contrato->idContrato);								
						 ?>
								<tr>
									<td align="center"><a href="cadContrato.php?tipo=<?=$tipo1?>&idContrato=<?=$codigo?>">
										 <span class="glyphicon glyphicon-search" aria-hidden="true" title="Consultar"></span>
									</a></td>
									<td align="center">
									<a href="cadContrato.php?tipo=<?=$tipo?>&idContrato=<?=$codigo?>">
											 <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Alterar"></span>
									</a></td>
									<td align="center">
									<input type="hidden" value="<?=$contrato->idContrato ?>" id="txtIdContrato"></input>
									<a href="#"  id="usuModal" onclick="Contrato(<?=$contrato->idContrato ?>)" data-toggle="modal" data-target="#delete-modal">
										<span class="glyphicon glyphicon-remove" aria-hidden="true" title="Excluir" id="iconeExcluir"></span>
									</a></td>	
									<td align="center">
										<input type="hidden" id="codContrato" value="<?=$contrato->idContrato ?>"></input>
										<a href="#" id="imprimir" onclick="Relatorio(<?=$contrato->idContrato ?>,<?=$contrato->imovel?>,<?=$contrato->cliente?>)">
										  <span class="glyphicon glyphicon-print" aria-hidden="true" title="Imprimir Contrato"></span>										  
									    </a>
									</td>
									<td align="center">
									<input type="hidden" id="editContrato" value="<?=$contrato->idContrato ?>"></input>
									<?php if($contrato->tagContrato != '') {?>
										<a href="#" id="imprimir1" onclick="Editor(<?=$contrato->idContrato ?>,true)">
										  <span class="glyphicon glyphicon-font" aria-hidden="true" title="Editar Contrato"></span>										  
									    </a>
									<?php } else {?>
										<a href="#" id="imprimir1" onclick="Editor(<?=$contrato->idContrato ?>,false)">
										  <span class="glyphicon glyphicon-font" aria-hidden="true" title="Editar Contrato"></span>										  
									    </a>
									<?php } ?>
									</td>
									<td align="center"><?php echo $contrato->idContrato ?></td>
									<?php if ($contrato->tipo == 'V') {$contrato->tipo = 'Venda';?>
										<td><?php echo $contrato->tipo ?></td>
									<?php }?>
									<?php if ($contrato->tipo == 'L'){$contrato->tipo = 'Locacao';?>
										<td><?php echo $contrato->tipo ?></td>
									<?php }?>
									<?php if ($contrato->situacao == 'V') {$contrato->situacao = 'Valido';?>
										<td><?php echo $contrato->situacao ?></td>
									<?php }?>
									<?php if ($contrato->situacao == 'I'){$contrato->situacao = 'Invalido';?>
										<td><?php echo $contrato->situacao ?></td>
									<?php }?>
									<td><?php echo $contrato->observacao ?></td>								
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


<!-- Modal -->
<div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="margin-top: 80px;">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
        	<span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Excluir Dados</h4>
      </div>
      <div class="modal-body">
        Deseja realmente excluir estes dados?
      </div>
      <div class="modal-footer">
        <input type="hidden" id="txtContrato"></input>        
        <button onclick="redirecionaModal(document.getElementById('txtContrato').value)" type="button" class="btn btn-success" data-dismiss="modal">Sim</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
      </div>
    </div>
  </div>
</div>	

<!-- Modal Contrato-->
<div class="modal fade" id="contrato-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="margin-top: 60px;">
  <div class="modal-dialog" role="document" style="width: 75%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
        	<span aria-hidden="true">&times;</span></button>
        <h5 class="modal-title" id="modalLabel">Contrato</h5>
      </div>
      <div class="modal-body" style="text-align: center;" id="relat">

      </div>
      <!--<div class="modal-footer">
         <input type="hidden" id="txtCliente"></input>         
		<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>-->
    </div>
  </div>
</div>
</body>
</html>