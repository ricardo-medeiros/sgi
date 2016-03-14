<?php 
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/cliente.controle.php');
	require_once(__ROOT__.'/controle/usuario.controle.php');
	
	$controleUsuario = new Usuario_Controle();
	$usuario = $controleUsuario->getUsuario($_SESSION["USUARIO"]);
	
	$controleCliente = new Cliente_Controle();
 	$lista = $controleCliente->listaCliente();

 	$table .= '
 		<br/><br/>	
		<table id="tbcliente" width="100%">
			<thead>
				<tr>						
					<th width="40px">Codigo</th>
 			<hr>
					<th>CPF</th>
 			<hr>
					<th align="left">Nome Cliente</th>
 			<hr>
				</tr>
			</thead>
		
			<tbody>						
 			';
		 	foreach ((array)$lista as $cliente){
		 		$table .= '
		 			<tr>								
						<td align="center">'.$cliente->idCliente.'</td>
						<td align="center">'.$cliente->cpf.'</td>
						<td align="left">'.$cliente->nome.'</td>								
					</tr>	
		 		';
		 	}
 	
 	$table .= ' 							
			</tbody>
		</table>';
 	 	
$html = '
<table width="100%" border = "0">
		<tr>
			<td>
				<img src="'.$usuario->caminhoLogo.'" border="0" width="100px" heigth="50px">
			</td>
			<td>
				<h3>
					<a name="top"></a>Relat&oacute;rio de Clientes
				</h3>		
			</td>
		</tr>
</table>
<hr>'
.$table.''; 

	include ('../MPDF57/mpdf.php'); 
	$mpdf = new mPDF (); 
	$mpdf->WriteHTML ( $html ); 
	$mpdf->Output (); 
	exit (); 
?>
