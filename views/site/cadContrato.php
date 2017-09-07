<?php
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/contrato.controle.php');
	require_once(__ROOT__.'/controle/verifica.login.php');
	$verifica = new verifica_login();
	$ok = $verifica->verifica();
	
		
	if ($ok){
		echo "<script type='text/javascript' language='javascript'>
				window.top.location.href = '/index.php';
			  </script>";
	}
	
	$tipo = base64_decode($_GET['tipo']);	
	$controleContrato = new Contrato_Controle();
	
	if($tipo == 'INS')
	{
		$contrato = new Contrato_Model();
		$controleContrato->novoContrato($contrato);
	}
	
	$idContrato = base64_decode($_GET['idContrato']);
	$contrato = $controleContrato->getContrato($idContrato);
	$cliente = new Cliente_Model();
	$cliente = $controleContrato->getCliente($contrato->cliente);
	$imovel = new Imovel_Model();
	$imovel = $controleContrato->getImovel($contrato->imovel);
 	$tiposImoveis = $controleContrato->getTipoImoveis();
 	$imoveis = $controleContrato->listaImoveis();
 	$clientes = $controleContrato->listaClientes(); 
 	$fiadores = $controleContrato->listaFiadores();
 	$fiadoresContrato = $controleContrato->listaFiadoresContrato($contrato->idContrato);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Cadastro de Contratos</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css"	href="https://cdn.datatables.net/1.10.8/css/dataTables.bootstrap.min.css">
<script	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/dataTables.bootstrap.min.js"></script>
<script	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		
		$('#tbcliente').DataTable(
				{
					"language" : {
						"url" : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
					},
					"dom": "Bfrtip"
				});		
		$('#tbimoveis').DataTable(
				{
					"language" : {
						"url" : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
					},
					"dom": "Bfrtip"
				});
		$('#tbfiador').DataTable(
				{
					"language" : {
						"url" : "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
					},
					"dom": "Bfrtip"
				});
		$("#txtComissao").blur(function(){
			var comissao    = document.getElementById('txtComissao').value;
			var valContrato = document.getElementById('txtValorContrato').value;
			document.getElementById('txtValorProp').value = valContrato - ((valContrato * comissao) / 100) ;	
		});	

		$("#gerar").click(function(){
			if(confirm("Deseja realmente Gerar este contrato? Uma vez gerado o imovel escolhido sera ocupado e nao podera ser mais alterado!"))
			{
				$('#contrato-modal').modal('show');		
			}

		});		
		//adiciona um fiador ao contrato
		$("#adicionar").click(function(){
			var fiador = document.getElementById('txtFiadorContrato').value;
			if(fiador != '')
			{
				var contrato = <?=$contrato->idContrato?>;
				location.href='/controle/implContrato.php?codFiador='+fiador+'&idContrato='+contrato;	
			}
			
		});			
		
		//excluir um fiador do contrato 
		$("#linkFiador").click(function(){
			var fiador = document.getElementById('codigoFiador').value;
			if(fiador != '')
			{
				var contrato = <?=$contrato->idContrato?>;
				location.href='/controle/implContrato.php?excFiador='+fiador+'&idContrato='+contrato;
			}
			
		});	
	});

	function SelecioneCliente(idCliente,cliente){
		document.getElementById('txtIdCliente').value = idCliente;
		document.getElementById('txtNomeCliente').value = cliente;
		$('#cliente-modal').modal('hide');
	}

	function SelecioneImovel(idImovel,imovel){
		document.getElementById('txtIdImovel').value = idImovel;
		document.getElementById('txtObsImovel').value = imovel;
		$('#imovel-modal').modal('hide');
	}

	function SelecioneFiador(idFiador,fiador){
		document.getElementById('txtFiadorContrato').value = idFiador;
		document.getElementById('txtNomeFiador').value = fiador;
		$('#fiador-modal').modal('hide');
	}
	
	function Contrato(contrato){		
		document.getElementById('txtIdContrato').value = contrato;
	}
	function Fechar(){
		window.top.location.href = "contrato.php";
	}
</script>
</head>
<body style="margin: 0">
	<div id="menu">
		<?php
                //include("../cabecalho/menu.php");
            ?>
	</div>
	<div id="corpo" class="container" style="margin-top: 80px; width: 85%;">
		<div class="panel panel-primary">
		  <div class="panel-heading" style="text-align:center;">Cadastro de Contrato</div>
		  	<div class="panel-body">
		  		<div class="text-center">		  		
				    <form action="/controle/implContrato.php" method="post" class="form-horizontal" data-toggle="validator" role="form" id="form">
							  <div class="form-group  form-group-sm">							  
							    <label for="cod" class="col-sm-2 control-label">Codigo</label>
							    <div class="col-sm-2">
							      <input type="text" name="contrato" value="<?=$contrato->idContrato ?>" class="form-control input-sm" id="txtCodigo" placeholder="" disabled>
							    </div>
							  </div>
							  <div class="form-group  form-group-sm">							  
							    <label for="cod" class="col-sm-2 control-label">Num. Contrato</label>
							    <div class="col-sm-2">
							      <input type="text" name="refContrato" value="<?=$contrato->refContrato ?>" class="form-control input-sm" id="refContrato" placeholder="" readonly>
							    </div>
							  </div>
							  <div class="form-group form-group-sm">	
								  <label for="listaCliente" class="col-sm-2 control-label">Cliente</label>
								  <div class="col-sm-2">
								  		<input required type="text" name="idCliente" value="<?=$contrato->cliente ?>" class="form-control input-sm" id="txtIdCliente" placeholder="" >
								  </div>
								  <div style="text-align: left;">
								  	<table width="65%">
								  	  <tr>
								  	    <td>
									  		<a href="#" id="cliModal" data-toggle="modal" data-target="#cliente-modal">
									      		<button type="button" class="btn btn-primary" data-dismiss="modal" title="Buscar Clientes">
									      			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>							      		
									      		</button>
									     	</a>
								     	</td>
								     	<td class="col-sm-10">
								     	  <input type="text" name="nomeCliente" value="CPF - <?=$cliente->cpf ?> - <?=$cliente->nome ?>" class="form-control input-sm" id="txtNomeCliente" placeholder="" readonly>
								     	</td>
								     	<td>
									  		<a href="#" id="detCliModal" data-toggle="modal" data-target="#detcliente-modal">
									      		<button type="button" class="btn btn-primary" data-dismiss="modal" title="Detalhe do Cliente">
									      			Detalhes							      		
									      		</button>
									     	</a>
								     	</td>
								       </tr>
								     </table>
								  </div>	
							  </div>
							  <div class="form-group form-group-sm">	
								  <label for="listaImovel" class="col-sm-2 control-label">Imovel</label>
								  <div class="col-sm-2">
								  		<input required type="text" name="idImovel" value="<?=$contrato->imovel ?>" class="form-control input-sm" id="txtIdImovel" placeholder=""  >
								  </div>
								  <div style="text-align: left;">
								    <table width="65%">
								    	<tr>
								    		<td>
									    		<a href="#" id="imoModal" data-toggle="modal" data-target="#imovel-modal">
										      		<button type="button" class="btn btn-primary" data-dismiss="modal" title="Buscar Imoveis">
										      			<span class="glyphicon glyphicon-home" aria-hidden="true"></span>							      		
										      		</button>
										     	</a>
								    		</td>
									     	<td class="col-sm-10">
									     	  <input type="text" name="obsImovel" value="Obs.: <?=$imovel->observacao ?>" class="form-control input-sm" id="txtObsImovel" placeholder="" readonly>
									     	</td>		
									  		<td>
										  		<a href="#" id="detImoModal" data-toggle="modal" data-target="#detimovel-modal">
										      		<button type="button" class="btn btn-primary" data-dismiss="modal" title="Detalhe do Imovel">
										      			Detalhes							      		
										      		</button>
										     	</a>
									     	</td>
								    	</tr>
								    </table>
								  		
								  </div>	
							  </div>							  
							  <div class="form-group form-group-sm">
									<label for="tipoContrato" class="col-sm-2 control-label">Tipo Contrato</label>
									<div class="col-sm-2">
										<select required name="tipoContrato" class="form-control input-sm" id="txtTipo"
											placeholder="Tipo do Contrato" value="" >			 							 				 							 	
				 							 	<?php if ($tipo != 'INS') {?> 
					 						  	   <?php if ($contrato->tipo == 'V') {?> 
											    	<option value="V">Venda</option>
											    	<option value="L">Locacao</option>					    	
					 							   <?php }?>
												   <?php if ($contrato->tipo == 'L') {?> 
											    	<option value="L">Locacao</option> 
				 							    	<option value="V">Venda</option>					    	 
				 								   <?php }?>
	 											<?php }?>
												<?php if ($tipo == 'INS' || $contrato->tipo == '')  {?> 
				 									<option value="V">Venda</option> 
				 							    	<option value="L">Locacao</option>									   
												<?php }?>							 
										</select>
									</div>
							  </div> 	
							  <div class="form-group form-group-sm">				 					  				  
								  <label for="situacao" class="col-sm-2 control-label">Situacao</label>
								  <div class="col-sm-2">
									  <select class="form-control input-sm"  name="situacao">
											<?php if ($tipo != 'INS') {?> 
				 						  	   <?php if ($contrato->situacao == 'V') {?> 
										    	<option value="V">Valido</option>
										    	<option value="I">Invalido</option>					    	
				 							   <?php }?>
											   <?php if ($contrato->situacao == 'I') {?> 
										    	<option value="I">Invalido</option> 
			 							    	<option value="V">Valido</option>					    	 
			 								   <?php }?>
 											<?php }?>
											<?php if ($tipo == 'INS' || $contrato->situacao == '')  {?> 
			 									<option value="V">Valido</option> 
			 							    	<option value="I">Invalido</option>									   
											<?php }?>
									  </select>
								  </div>
						  	  </div>
						  	  <!-- acordion com as datas,testemunhas e valores -->	
							  <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
								  <div class="panel panel-info" style="width: 95%; margin-left: 50px;">
								    <div class="panel-heading" role="tab" id="headingOne">
								      <h4 class="panel-title" align="left">
								        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								          <span class="glyphicon glyphicon-download" aria-hidden="true" title="Preencher"></span> Datas do Contrato
								        </a>
								      </h4>
								    </div>
								    <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
								      <div class="panel-body">
								          <div class="form-group form-group-sm">
										    <label for="dataContrato" class="col-sm-2 control-label">Data Contrato</label>
										    <div class="col-sm-3">													   
												<input required  type="date" maxlength="10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" name="dataContrato" class="form-control input-sm" id="txtData1" placeholder="Data do Contrato" value="<?=$contrato->dataContrato?>" readonly>
										    </div>
										    <span style="text-align: left" class="help-block">Formato: dd/mm/aaaa</span>
										  </div>
								          <div class="form-group form-group-sm">
										    <label for="dataVigencia" class="col-sm-2 control-label">Data Vigencia</label>
										    <div class="col-sm-3">					      
										      <input  type="date" maxlength="10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" name="dataVigencia" class="form-control input-sm" id="txtDataVigencia" placeholder="Data Vigencia" value="<?=$contrato->dataVigencia ?>"">
										    </div>
										    <span style="text-align: left" class="help-block">Formato: dd/mm/aaaa</span>
										  </div>	
								          <div class="form-group form-group-sm">
										    <label for="dataInicial" class="col-sm-2 control-label">Data Inicial</label>
										    <div class="col-sm-3">					      
										      <input  type="date" maxlength="10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" name="dataInicial" class="form-control input-sm" id="txtDataInicial" placeholder="Data Inicial" value="<?=$contrato->dataInicial ?>"">
										    </div>
										    <span style="text-align: left" class="help-block">Formato: dd/mm/aaaa</span>
										  </div>	
								          <div class="form-group form-group-sm">
										    <label for="dataFinal" class="col-sm-2 control-label">Data Final</label>
										    <div class="col-sm-3">					      
										      <input  type="date" maxlength="10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" name="dataFinal" class="form-control input-sm" id="txtDataFinal" placeholder="Data Final" value="<?=$contrato->dataFinal ?>"">
										    </div>
										    <span style="text-align: left" class="help-block">Formato: dd/mm/aaaa</span>
										  </div>	
								          <div class="form-group form-group-sm">
										    <label for="dataEntrada" class="col-sm-2 control-label">Data de Entrada</label>
										    <div class="col-sm-3">					      
										      <input  type="date" maxlength="10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" name="dataEntrada" class="form-control input-sm" id="txtDataEntrada" placeholder="Data de Entrada" value="<?=$contrato->dataEntrada ?>"">
										    </div>
										    <span style="text-align: left" class="help-block">Formato: dd/mm/aaaa</span>
										  </div>	
								          <div class="form-group form-group-sm">
										    <label for="dataReajuste" class="col-sm-2 control-label">Data de Reajuste</label>
										    <div class="col-sm-3">					      
										      <input  type="date" maxlength="10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" name="dataReajuste" class="form-control input-sm" id="txtDataReajuste" placeholder="Data de Reajuste" value="<?=$contrato->dataReajuste ?>"">
										    </div>
										    <span style="text-align: left" class="help-block">Formato: dd/mm/aaaa</span>
										  </div>	
										  <div class="form-group form-group-sm">
										    <label for="diaVencimento" class="col-sm-2 control-label">Dia do Vencimento</label>
										    <div class="col-sm-2">					      
										      <input  type="number" maxlength="2" name="diaVencimento" class="form-control input-sm" id="txtDiaVencimento" placeholder="Dia do Vencimento" value="<?=$contrato->diaVencimento ?>"">
										    </div>
										  </div>	
								      </div>
								    </div>
								  </div>
								  <div class="panel panel-success" style="width: 95%; margin-left: 50px;">
								    <div class="panel-heading" role="tab" id="headingTwo">
								      <h4 class="panel-title" align="left">
								        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								          <span class="glyphicon glyphicon-download" aria-hidden="true" title="Preencher"></span> Testemunhas
								        </a>
								      </h4>
								    </div>
								    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
								      <div class="panel-body">
								          <div class="form-group form-group-sm">
										    <label for="cpfTestemunha1" class="col-sm-2 control-label">CPF</label>
										    <div class="col-sm-2">
										      <input maxlength="11" minlength="11" type="text" name="cpfTest1" class="form-control input-sm" id="txtCpf1" placeholder="CPF 1" value="<?=$contrato->cpfTest1 ?>">
										    </div>
										    <span id="erroMsgCpf1" style="text-align: left;color: red; display: none;">CPF já existe, favor informar outro CPF!</span>
										  </div>					  
										  <div class="form-group form-group-sm">
										    <label for="nomeTestemunha1" class="col-sm-2 control-label">Nome</label>
										    <div class="col-sm-6">
										      <input maxlength="150" minlength="10" type="text" name="nomeTest1" class="form-control input-sm" id="txtTest1" placeholder="Nome Testemunha 1" value="<?=$contrato->nomeTest1 ?>">
										    </div>
										  </div>	
										  <div class="form-group form-group-sm">
										    <label for="cpfTestemunha2" class="col-sm-2 control-label">CPF</label>
										    <div class="col-sm-2">
										      <input maxlength="11" minlength="11" type="text" name="cpfTest2" class="form-control input-sm" id="txtCpf2" placeholder="CPF 2" value="<?=$contrato->cpfTest2 ?>">
										    </div>
										    <span id="erroMsgCpf2" style="text-align: left;color: red; display: none;">CPF já existe, favor informar outro CPF!</span>
										  </div>					  
										  <div class="form-group form-group-sm">
										    <label for="nomeTestemunha2" class="col-sm-2 control-label">Nome</label>
										    <div class="col-sm-6">
										      <input maxlength="150" minlength="10" type="text" name="nomeTest2" class="form-control input-sm" id="txtTest2" placeholder="Nome Testemunha 2" value="<?=$contrato->nomeTest2 ?>">
										    </div>
										  </div>		
								      </div>
								    </div>
								  </div>
								  <div class="panel panel-warning" style="width: 95%; margin-left: 50px;">
								    <div class="panel-heading" role="tab" id="headingThree">
								      <h4 class="panel-title" align="left"">
								        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
								          <span class="glyphicon glyphicon-download" aria-hidden="true" title="Preencher"></span> Valores
								        </a>
								      </h4>
								    </div>
								    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
								      <div class="panel-body">
								        <div class="form-group form-group-sm"> 
							    			<label for="valorContrato" class="col-sm-2 control-label">Valor do Contrato</label>
							    			<div class="col-sm-2">
		      						        	<input  minlength="0" type="number" step="0.01" name="valorContrato" class="form-control input-sm" id="txtValorContrato" placeholder="Valor do Contrato" value="<?=$contrato->valorContrato ?>""> 
							    			</div>
							  			</div>
								        <div class="form-group form-group-sm"> 
							    			<label for="comissao" class="col-sm-2 control-label">Comissao Corretor</label>
							    			<div class="col-sm-2">
		      						        	<input  minlength="0" type="number" step="0.01" name="comissaoCorretor" class="form-control input-sm" id="txtComissao" placeholder="Comissao" value="<?=$contrato->comissaoCorretor ?>""> 
							    			</div>
							    			<span style="text-align: left" class="help-block">Formato: 00,00</span>
							  			</div>		
								        <div class="form-group form-group-sm"> 
							    			<label for="valorProp" class="col-sm-2 control-label">Valor do Proprietario</label>
							    			<div class="col-sm-2">
		      						        	<input readonly  minlength="0" type="number" step="0.01" name="valorProp" class="form-control input-sm" id="txtValorProp" placeholder="Valor do Proprietario" value="<?=$contrato->valorProp ?>""> 
							    			</div>
							  			</div>		
								        <div class="form-group form-group-sm"> 
							    			<label for="percReaj" class="col-sm-2 control-label">Perc.Reajuste</label>
							    			<div class="col-sm-2">
		      						        	<input  minlength="0" type="number" step="0.01" name="percReaj" class="form-control input-sm" id="txtPercReaj" placeholder="Percentual de reajuste" value="<?=$contrato->percReaj ?>""> 
							    			</div>
							    			<span style="text-align: left" class="help-block">Formato: 00,00</span>
							  			</div>		
								        <div class="form-group form-group-sm"> 
							    			<label for="multaAtraso" class="col-sm-2 control-label">Multa Atraso</label>
							    			<div class="col-sm-2">
		      						        	<input  minlength="0" type="number" step="0.01" name="multaAtraso" class="form-control input-sm" id="txtMultaAtraso" placeholder="Multa por Atrasao" value="<?=$contrato->multaAtraso ?>""> 
							    			</div>
							    			<span style="text-align: left" class="help-block">Formato: 00,00</span>
							  			</div>		
								        <div class="form-group form-group-sm"> 
							    			<label for="diasAtraso" class="col-sm-2 control-label">Dias de Atraso</label>
							    			<div class="col-sm-2">
		      						        	<input  minlength="0" type="number" step="0.1" name="diasAtraso" class="form-control input-sm" id="txtDiasAtraso" placeholder="Dias de Atraso" value="<?=$contrato->diasAtraso ?>""> 
							    			</div>
							  			</div>		
								        <div class="form-group form-group-sm"> 
							    			<label for="multaMora" class="col-sm-2 control-label">Multa Mora</label>
							    			<div class="col-sm-2">
		      						        	<input  minlength="0" type="number" step="0.01" name="multaMora" class="form-control input-sm" id="txtMultaMora" placeholder="Multa por Mora" value="<?=$contrato->multaMora ?>""> 
							    			</div>
							    			<span style="text-align: left" class="help-block">Formato: 00,00</span>
							  			</div>		
								        <div class="form-group form-group-sm"> 
							    			<label for="diasMora" class="col-sm-2 control-label">Dias de Mora</label>
							    			<div class="col-sm-2">
		      						        	<input  minlength="0" type="number" step="0.1" name="diasMora" class="form-control input-sm" id="txtDiasMora" placeholder="Dias de Mora" value="<?=$contrato->diasMora ?>""> 
							    			</div>
							  			</div>								  										  										  										  										  										  										  						
								      </div>
								    </div>
								  </div>
								  <div class="panel panel-danger" style="width: 95%; margin-left: 50px;">
								    <div class="panel-heading" role="tab" id="headingFour">
								      <h4 class="panel-title" align="left"">
								        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
								          <span class="glyphicon glyphicon-download" aria-hidden="true" title="Preencher"></span> Fiadores
								        </a>
								      </h4>
								    </div>
								    <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
								      <div class="panel-body">
								          <div class="form-group form-group-sm"> 
							    			<label for="fiador" class="col-sm-2 control-label">Fiador</label>
							    			<div class="col-sm-2">
		      						        	<input  minlength="0" type="text" name="fiadorContrato" class="form-control input-sm" id="txtFiadorContrato" placeholder="" value=""> 
							    			</div>
							    			<div style="text-align: left;">
											  	<table width="65%">
											  	  <tr>
											  	    <td>
												  		<a href="#" id="fiadorModal" data-toggle="modal" data-target="#fiador-modal">
												      		<button type="button" class="btn btn-primary" data-dismiss="modal" title="Buscar Fiador">
												      			<span class="glyphicon glyphicon-user" aria-hidden="true"></span>							      		
												      		</button>
												     	</a>
											     	</td>
											     	<td class="col-sm-10">
											     	  <input type="text" name="nomeFiador" value="" class="form-control input-sm" id="txtNomeFiador" placeholder="" readonly>
											     	</td>
											     	<td>
<!--												  		<a href="#" id="detFiadorModal" onclick="AdicionarFiador(document.getElementById('txtFiadorContrato').value)"> -->
<!-- 												  		<span class="glyphicon glyphicon-plus" aria-hidden="true" title="Adicionar Fiador"></span> -->
												      		<button type="button" id="adicionar" class="btn btn-success" data-dismiss="modal" title="Adicionar do Fiador">
												      			Adicionar							      		
												      		</button>
<!-- 												     	</a> -->
											     	</td>
											       </tr>
											     </table>
											</div><br/>
											<div style="text-align: left;">
												<table align="center" id="tbfiadores" class="table table-bordered table-hover table-striped" cellspacing="0" style="width: 80%; font-size: 12px;">
															<thead>
																<tr>
																	<th width="10px"></th>						
																	<th width="40px">Codigo</th>
																	<th width="80px">CPF</th>
																	<th width="350px">Nome</th>
																</tr>
															</thead>
								
														<tbody>
														<?php 
															foreach ((array)$fiadoresContrato as $fiad) {
																 $codigo = $fiad->idFiador;
																 							
														 ?>
																<tr>
																	<td align="center">
																	  <a href="#" id="linkFiador">
																		 <span class="glyphicon glyphicon-remove" aria-hidden="true" title="Selecionar"></span>
																	  </a>
																	</td>	
																	<td align="center" id="codFiador"><?=$fiad->idFiador ?><input type="hidden" id="codigoFiador" value="<?=$fiad->idFiador ?>"/></td>
																	<td align="center" id="cpfFiador"><?=$fiad->cpf ?></td>
																	<td align="center" id="descFiador"><?=$fiad->nome ?></td>																							
																</tr>		
														<?php
														}
														?>		
														</tbody>
												</table>
											</div>	
							  			  </div>
							  			</div>								  										  										  										  										  										  										  						
								      </div>
								  </div>	
							  </div>						  	  							
							  <div class="form-group form-group-sm">
							    <label for="observacao" class="col-sm-2 control-label">Observacao</label>
							    <div class="col-sm-8">							      
							      <textarea required maxlength="500" rows="3" cols="100" name="observacao" class="form-control input-sm" id="txtObs" placeholder="Caracteristicas do Contrato"><?=$contrato->observacao ?></textarea>
							    </div>
							  </div>	  								  							  							  
							 				  
						  	  <div>
								<?php if ($tipo == 'INS') {?>
			 						<button type="submit" id="salvar" name="salvar" class="btn btn-success" value="Salvar">Salvar</button>  
								<?php }?>
								<?php if ($tipo == 'UPD') {?>
			 						<button type="submit" id="alterar" name="alterar" class="btn btn-success" value="Alterar">Alterar</button>
			 						<!-- <a href="implContrato.php?tipo=<?=$tipo?>&idContrato=<?=$contrato->idContrato ?>" id="impContrato"> -->
			 						<?php if ($contrato->cliente > 0 && $contrato->imovel > 0) {?>  
			 							<button  type="button" id="gerar" name="gerar" class="btn btn-primary" value="Gerar">Gerar Contrato</button>
			 						<!-- </a> -->
			 						<?php }?>
								<?php }?>
								<a href="#" onclick="Fechar()"><button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button></a>
						  	  </div>
				  			<input type="hidden" name="idContrato" value="<?=$contrato->idContrato ?>"></input>
				  </form>			  
	 			</div>  
			 </div>
		  </div>
	</div>
	<div id="rodape">
		<?php
                //include("../rodape/rodape.php");
            ?>
	</div> 
	
	<!-- Modal Imovel-->
	<div class="modal fade" id="imovel-modal" tabindex="-1" role="dialog" 
		aria-labelledby="modalLabel" style="margin-top: 80px;">
		<div class="modal-dialog modal-sm" role="document" style="width:800px;">
			<div class="modal-content">
				<form action="/controle/implContrato.php" method="POST" id="form2" class="form-horizontal" data-toggle="validator" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabel">Buscar Imoveis</h4>
					</div>
					<div class="modal-body">				
						<table id="tbimoveis" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
							<thead>
							<tr>
								<th width="10px"></th>							
								<th width="30px">Codigo</th>
								<th width="60px">Tipo</th>
<!-- 								<th width="60px">Situacao</th> -->
<!-- 								<th width="60px">Valor</th> -->
								<th width="250px">Observacao</th>
							</tr>
						</thead>

						<tbody>
						<?php 
							foreach ((array)$imoveis as $imov) {
								 $codigo = $imov->idImovel;
								 $obs    = "Obs.: " .$imov->observacao;
						 ?>
								<tr>
									<td align="center">
									  <a href="#" id="linkImoveis" onclick="SelecioneImovel('<?=$codigo?>','<?=$obs?>')">
										 <span class="glyphicon glyphicon-ok" aria-hidden="true" title="Selecionar"></span>
									  </a>
									</td>	
									<td align="center" id="codImovel"><?php echo $imov->idImovel ?></td>
									<td align="center" id="tipoImv"><?php echo $imov->tipo ?></td>
									<!-- <td align="center" id="sitImv"><?php echo $imov->situacao ?></td> -->
									<!-- <td align="center" id="valImv"><?php echo $imov->valor ?></td> -->
									<td align="center" id="obsImv"><?php echo $imov->observacao ?></td>																							
								</tr>		
						<?php
						}
						?>		
						</tbody>
					  </table>  							  
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
	
	<!-- Modal Cliente-->
	<div class="modal fade" id="cliente-modal" tabindex="-1" role="dialog" 
		aria-labelledby="modalLabel" style="margin-top: 80px;">
		<div class="modal-dialog modal-sm" role="document" style="width:800px;">
			<div class="modal-content">
				<form action="/controle/implContrato.php" method="POST" id="form2" class="form-horizontal" data-toggle="validator" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabel">Buscar Clientes</h4>
					</div>
					<div class="modal-body">		  	
						<table id="tbcliente" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th width="10px"></th>						
									<th width="40px">Codigo</th>
									<th width="80px">CPF</th>
									<th width="350px">Nome</th>
								</tr>
							</thead>

						<tbody>
						<?php 
							foreach ((array)$clientes as $cli) {
								 $codigo = $cli->idCliente;
								 $nome   = "CPF " .$cli->cpf . " - " . $cli->nome;							
						 ?>
								<tr>
									<td align="center">
									  <a href="#" id="linkCliente" onclick="SelecioneCliente('<?=$codigo?>','<?=$nome?>')">
										 <span class="glyphicon glyphicon-ok" aria-hidden="true" title="Selecionar"></span>
									  </a>
									</td>	
									<td align="center" id="codCliente"><?php echo $cli->idCliente ?></td>
									<td align="center" id="cpfCliente"><?php echo $cli->cpf ?></td>
									<td align="center" id="descCliente"><?php echo $cli->nome ?></td>																							
								</tr>		
						<?php
						}
						?>		
						</tbody>
					</table>
					</div>
					<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
	
	<!-- Modal Det Cliente-->
	<div class="modal fade" id="detcliente-modal" tabindex="-1" role="dialog" 
		aria-labelledby="modalLabel" style="margin-top: 80px;">
		<div class="modal-dialog modal-sm" role="document" style="width:800px;">
			<div class="modal-content">
				<form action="#" id="form3" class="form-horizontal" data-toggle="validator" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabel">Detalhe do Cliente</h4>
					</div>
					<div class="modal-body">		  	
						  <div class="form-group">
						    <label for="cpfCliente" class="col-sm-2 control-label">CPF</label>
						    <div class="col-sm-3">
						      <input required maxlength="11" minlength="11" type="text" name="cpf" class="form-control" id="txtCpf" placeholder="CPF" value="<?=$cliente->cpf ?>" disabled="disabled">
						    </div>
						    <span id="erroMsgCpf" style="text-align: left;color: red; display: none;">CPF já existe, favor informar outro CPF!</span>
						  </div>					
						  <div class="form-group">
						    <label for="rgCliente" class="col-sm-2 control-label">RG</label>
						    <div class="col-sm-3">
						      <input required maxlength="11" minlength="8" type="text" name="rg" class="form-control" id="txtRg" placeholder="RG" value="<?=$cliente->rg ?>"" disabled="disabled">
						    </div>
						  </div>	  
						  <div class="form-group">
						    <label for="nomeCliente" class="col-sm-2 control-label">Nome</label>
						    <div class="col-sm-6">
						      <input required maxlength="150" minlength="10" type="text" name="nome" class="form-control" id="txtCliente" placeholder="Nome" value="<?=$cliente->nome ?>" disabled="disabled">
						    </div>
						  </div>			  		
						  <div class="form-group">
						    <label for="emailCliente" class="col-sm-2 control-label">E-mail</label>
						    <div class="col-sm-4">
						      <input required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" name="emailCliente" class="form-control" id="txtEmail" placeholder="E-mail" value="<?=$cliente->email ?>" disabled="disabled">
						    </div>
						    <!-- <span id="erroMsg" style="text-align: left;color: red; display: none;">Login já existe, favor informar outro login!</span> -->
						  </div>				  
					  	  <div class="form-group">
						    <label for="telefoneCel" class="col-sm-2 control-label">Celular</label>
						    <div class="col-sm-3">
						      <input required maxlength="10" minlength="10" type="text" name="telefoneCelular"  class="form-control" id="txtCelular" placeholder="Tel. Celular" value="<?=$cliente->telefoneCelular ?>"" disabled="disabled">
						    </div>
						  </div>					  			  
						  <div class="form-group">
						    <label for="nascCliente" class="col-sm-2 control-label">Nascimento</label>
						    <div class="col-sm-3">					      
						      <input required  type="date" maxlength="10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" name="dataNascimento" class="form-control" id="txtNasc" placeholder="Nascimento" value="<?=$cliente->dataNascimento ?>"" disabled="disabled">
						    </div>
						    <span style="text-align: left" class="help-block"></span>
						  </div>	
						  <div class="form-group">				 					  				  
							  <label for="statusUsuario" class="col-sm-2 control-label">Status</label>
							  <div class="col-sm-2">
								  <select class="form-control"  name="status" disabled="disabled">
										<?php if ($tipo != 'INS') {?> 
			 						  	   <?php if ($cliente->status == 'A') {?> 
									    	<option value="A">Ativo</option>
									    	<option value="D">Desativado</option>					    	
			 							   <?php }?>
										   <?php if ($cliente->status == 'D') {?> 
									    	<option value="D">Desativado</option> 
		 							    	<option value="A">Ativo</option>					    	 
		 								   <?php }?>
 											<?php }?>
										<?php if ($tipo == 'INS' || $cliente->status == '')  {?> 
		 									<option value="A">Ativo</option> 
		 							    	<option value="D">Desativado</option>									   
										<?php }?>
								  </select>
							  </div>
					  	 </div>
					</div>
					<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</div>
				</form>
			</div>
		</div>
	</div>		
	
	<!-- Modal Det Imovel-->
	<div class="modal fade" id="detimovel-modal" tabindex="-1" role="dialog" 
		aria-labelledby="modalLabel" style="margin-top: 80px;">
		<div class="modal-dialog modal-sm" role="document" style="width:800px;">
			<div class="modal-content">
				<form action="#" id="form4" class="form-horizontal" data-toggle="validator" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabel">Detalhe do Imovel</h4>
					</div>
					<div class="modal-body">		  	
						 <div class="form-group">
								<label for="tipoImovel" class="col-sm-2 control-label">Tipo Imovel</label>
								<div class="col-sm-4">
									<select required name="tipoImovel" class="form-control" id="txtTipo"
										placeholder="Tipo do Imovel" value="" disabled="disabled">			 							 
			 							 	<?php for($i=0; $i < count($tiposImoveis["idTipo"]); $i ++) {?>
			 							 		<option <?php if ($tiposImoveis["idTipo"][$i] == $imovel->tipo) {?> selected <?php }?>  value="<?=$tiposImoveis["idTipo"][$i]?>"><?=$tiposImoveis["nomeTipo"][$i]?></option> 
			 							 	<?php }?>									 
									</select>
								</div>
						  </div> 	
						  <div class="form-group">				 					  				  
							  <label for="situacao" class="col-sm-2 control-label">Situacao</label>
							  <div class="col-sm-2">
								  <select class="form-control"  name="situacao" disabled="disabled" >
										<?php if ($tipo != 'INS') {?> 
			 						  	   <?php if ($imovel->situacao == 'L') {?> 
									    	<option value="L">Livre</option>
									    	<option value="O">Ocupado</option>					    	
			 							   <?php }?>
										   <?php if ($imovel->situacao == 'O') {?> 
									    	<option value="O">Ocupado</option> 
		 							    	<option value="L">Livre</option>					    	 
		 								   <?php }?>
 											<?php }?>
										<?php if ($tipo == 'INS' || $imovel->situacao == '')  {?> 
		 									<option value="L">Livre</option> 
		 							    	<option value="O">Ocupado</option>									   
										<?php }?>
								  </select>
							  </div>
					  	  </div>					
					  	  <div class="form-group">				 					  				  
							  <label for="statusImovel" class="col-sm-2 control-label">Status</label>
							  <div class="col-sm-2">
								  <select class="form-control"  name="status" disabled="disabled">
										<?php if ($tipo != 'INS') {?> 
			 						  	   <?php if ($imovel->status == 'A') {?> 
									    	<option value="A">Ativo</option>
									    	<option value="D">Desativado</option>					    	
			 							   <?php }?>
										   <?php if ($imovel->status == 'D') {?> 
									    	<option value="D">Desativado</option> 
		 							    	<option value="A">Ativo</option>					    	 
		 								   <?php }?>
 											<?php }?>
										<?php if ($tipo == 'INS' || $imovel->status == '')  {?> 
		 									<option value="A">Ativo</option> 
		 							    	<option value="D">Desativado</option>									   
										<?php }?>
								  </select>
							  </div>
					  	  </div>	
<!-- 					  	   <div class="form-group"> -->
<!-- 						    <label for="valor" class="col-sm-2 control-label">Valor</label> -->
<!-- 						    <div class="col-sm-2"> -->
						     <!--  <input required  minlength="0" type="number" step="0.1" name="valor" class="form-control" id="txtValor" placeholder="Valor do Imovel" value="<?=$imovel->valor ?>"" disabled="disabled"> -->
<!-- 						    </div> -->
<!-- 						  </div>			 -->
						  <div class="form-group">
						    <label for="observacao" class="col-sm-2 control-label">Observacao</label>
						    <div class="col-sm-8">						      
						      <textarea required maxlength="500" rows="5" cols="100" name="observacao" class="form-control" id="txtObs" placeholder="Caracteristicas do Imovel" value="" class="form-control" id="txtObs" placeholder="Caracteristicas do Imovel" disabled="disabled"><?=$imovel->observacao ?></textarea>						   
						    </div>
						  </div>	  												  
					</div>
					<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</div>
				</form>
			</div>
		</div>
	</div>	

	<!-- Modal Fiadores-->
	<div class="modal fade" id="fiador-modal" tabindex="-1" role="dialog" 
		aria-labelledby="modalLabel" style="margin-top: 80px;">
		<div class="modal-dialog modal-sm" role="document" style="width:800px;">
			<div class="modal-content">
				<form action="/controle/implContrato.php" method="POST" id="form4" class="form-horizontal" data-toggle="validator" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabel">Buscar Fiadores</h4>
					</div>
					<div class="modal-body">		  	
						<table id="tbfiador" class="table table-bordered table-hover table-striped" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th width="10px"></th>						
									<th width="40px">Codigo</th>
									<th width="80px">CPF</th>
									<th width="350px">Nome</th>
								</tr>
							</thead>

						<tbody>
						<?php 
							foreach ((array)$fiadores as $fia) {
								 $codigo = $fia->idFiador;
								 $nome   = "CPF " .$fia->cpf . " - " . $fia->nome;							
						 ?>
								<tr>
									<td align="center">
									  <a href="#" id="linkFiador" onclick="SelecioneFiador('<?=$codigo?>','<?=$nome?>')">
										 <span class="glyphicon glyphicon-ok" aria-hidden="true" title="Selecionar"></span>
									  </a>
									</td>	
									<td align="center" id="codFiador"><?php echo $fia->idFiador ?></td>
									<td align="center" id="cpfFiador"><?php echo $fia->cpf ?></td>
									<td align="center" id="descFiador"><?php echo $fia->nome ?></td>																							
								</tr>		
						<?php
						}
						?>		
						</tbody>
					</table>
					</div>
					<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
	
<!-- Modal Contrato-->
<div class="modal fade" id="contrato-modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="margin-top: 80px;">
  <div class="modal-dialog" role="document" style="width: 75%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
        	<span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="modalLabel">Contrato</h4>
      </div>
      <div class="modal-body" style="text-align: center;">
           <object data="../relatorios/contratoLocacao1.php?codContrato=<?=$idContrato?>" type="text/html" style="display: block; border: none; height: 70vh; width: 70vw; text-align: center;"></object>
      </div>
      <div class="modal-footer">
<!--         <input type="hidden" id="txtCliente"></input>         -->
		<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>	
</body>
</html>