<?php 
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/proprietario.controle.php');
	$controleProprietario = new Proprietario_Controle();
	$lista = $controleProprietario->listaProprietario();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lista de Proprietario</title>
<!-- <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"></link> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css"	href="https://cdn.datatables.net/1.10.8/css/dataTables.bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/dataTables.bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
	var x;
	//
	$(document).ready(function() {
		$('#tbproprietario').DataTable(
			{
				"language" : {
					"url" : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
				},
				"dom": "Bfrtip"
			});			
	});
	 
	function Proprietario(proprietario){		
		document.getElementById('txtProprietario').value = proprietario;
	}
	
	function redirecionaModal(proprietario){
		location.href='/sgi/controle/implProprietario.php?tipo=DLT&idProprietario='+proprietario;
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
			    		  $codigo = base64_encode(0);
			    	?>
			    	<a href="cadProprietario.php?tipo=<?=$tipo?>&idProprietario=<?=$codigo?>"><button type="button" class="btn btn-success" data-dismiss="modal">Novo</button></a>&nbsp;
			    </td>
				<td>							
					<table id="tbproprietario" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="10px"></th>
								<th width="10px"></th>
								<th width="10px"></th>							
								<th width="40px">Codigo</th>
								<th width="130px">CPF</th>
								<th width="350px">Nome Proprietario</th>
							</tr>
						</thead>

						<tbody>
						<?php 
							foreach ((array)$lista as $proprietario) {
								 $tipo   = base64_encode('UPD');
								 $tipo1  = base64_encode('CNS');
								 $codigo = base64_encode($proprietario->idProprietario);								
						 ?>
								<tr>
									<td align="center"><a href="cadProprietario.php?tipo=<?=$tipo1?>&idProprietario=<?=$codigo?>">
										 <span class="glyphicon glyphicon-search" aria-hidden="true" title="Consultar"></span>
									</a></td>
									<td align="center">
									<a href="cadProprietario.php?tipo=<?=$tipo?>&idProprietario=<?=$codigo?>">
											 <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Alterar"></span>
									</a></td>
									<td align="center">
									<input type="hidden" value="<?=$proprietario->idProprietario ?>" id="txtIdProprietario"></input>
									<a href="#"  id="usuModal" onclick="Proprietario(<?=$proprietario->idProprietario ?>)" data-toggle="modal" data-target="#delete-modal">
										<span class="glyphicon glyphicon-remove" aria-hidden="true" title="Excluir" id="iconeExcluir"></span>
									</a></td>								
									<td align="center"><?php echo $proprietario->idProprietario ?></td>
									<td><?php echo $proprietario->cpf ?></td>
									<td><?php echo $proprietario->nome ?></td>								
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
        <input type="hidden" id="txtProprietario"></input>        
        <button onclick="redirecionaModal(document.getElementById('txtProprietario').value)" type="button" class="btn btn-success" data-dismiss="modal">Sim</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
      </div>
    </div>
  </div>
</div>	
</body>
</html>