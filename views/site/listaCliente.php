<?php 
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/cliente.controle.php');
	$controleCliente = new Cliente_Controle();
	$lista = $controleCliente->listaCliente();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Lista de Clientes</title>
<link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"></link>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css"	href="https://cdn.datatables.net/1.10.8/css/dataTables.bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/dataTables.bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
	var x;
		
	$(document).ready(function() {
		$('#tbcliente').DataTable(
			{
				"language" : {
					"url" : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
				},
				"dom": "Bfrtip"
			});			
	});
	 
	function Cliente(cliente){		
		document.getElementById('txtCliente').value = cliente;
	}
	
	function redirecionaModal(cliente){
		location.href='/sgi/controle/implCliente.php?tipo=DLT&idCliente='+cliente;
	}
</script>
</head>
<body>
<div>   
	<div class="container" style="margin-top: 80px; width: 70%;">		 
		<table style="font-size: 12px;">
			  <tr>
			    <td style="vertical-align: top;">
			    	<a href="cadCliente.php?tipo=INS&idCliente=0"><button type="button" class="btn btn-success" data-dismiss="modal">Novo</button></a>&nbsp;
			    </td>
				<td>							
					<table id="tbcliente" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th width="10px"></th>
								<th width="10px"></th>
								<th width="10px"></th>							
								<th width="40px">Codigo</th>
								<th width="130px">CPF</th>
								<th width="350px">Nome Cliente</th>
							</tr>
						</thead>

						<tbody>
						<?php 
							foreach ((array)$lista as $cliente) {
						 ?>
								<tr>
									<td align="center"><a href="cadCliente.php?tipo=CNS&idCliente=<?=$cliente->idCliente ?>">
										 <span class="glyphicon glyphicon-search" aria-hidden="true" title="Consultar"></span>
									</a></td>
									<td align="center">
									<a href="cadCliente.php?tipo=UPD&idCliente=<?=$cliente->idCliente ?>"">
										 <span class="glyphicon glyphicon-pencil" aria-hidden="true" title="Alterar"></span>
									</a></td>
									<td align="center">
									<input type="hidden" value="<?=$cliente->idCliente ?>" id="txtIdCliente"></input>
									<a href="#"  id="usuModal" onclick="Cliente(<?=$cliente->idCliente ?>)" data-toggle="modal" data-target="#delete-modal">
										<span class="glyphicon glyphicon-remove" aria-hidden="true" title="Excluir" id="iconeExcluir"></span>
									</a></td>								
									<td align="center"><?php echo $cliente->idCliente ?></td>
									<td><?php echo $cliente->cpf ?></td>
									<td><?php echo $cliente->nome ?></td>								
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
        <input type="hidden" id="txtCliente"></input>        
        <button onclick="redirecionaModal(document.getElementById('txtCliente').value)" type="button" class="btn btn-success" data-dismiss="modal">Sim</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">N&atilde;o</button>
      </div>
    </div>
  </div>
</div>	
</body>
</html>