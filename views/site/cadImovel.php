<?php
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/imovel.controle.php');
	require_once(__ROOT__.'/controle/verifica.login.php');
	$verifica = new verifica_login();
	$ok = $verifica->verifica();
	
	if ($ok){
		echo "<script type='text/javascript' language='javascript'>
				window.top.location.href = '/index.php';
			  </script>";
	}
	
	$tipo = base64_decode($_GET['tipo']);	
	$controleImovel = new Imovel_Controle();	

	$idImovel = base64_decode($_GET['idImovel']);
	$imovel = $controleImovel->getImovel($idImovel);
	$endereco = new Endereco_Model();
	$proprietario = new Proprietario_Model();
	$estados = $controleImovel->getEstados();
	$tiposImoveis = $controleImovel->getTipoImoveis();
	$listaProprietario = $controleImovel->listaProprietarios();
	if ($imovel->endereco > 0){
		$endereco= $controleImovel->getEndImovel($imovel);
	}
	if ($imovel->proprietario > 0){
		$proprietario= $controleImovel->getPropImovel($imovel);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Cadastro de Imovel</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="//code.jquery.com/jquery-2.2.1.min.js"></script>
<script	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		function limpa_formulario_cep() {
        // Limpa valores do formul�rio de cep.
        $("#txtRua").val("");
        $("#txtBairro").val("");
        $("#txtCidade").val("");
        $("#txtUf").val("");
    	}
        
		$("#txtCep").blur(function(){
		
 		var cep = $(this).val().replace(/\D/g, '');
 		
 		if (cep != "") {     			
     		   //Express�o regular para validar o CEP.
               var validacep = /^[0-9]{8}$/;

             //Valida o formato do CEP.
             if(validacep.test(cep)) {
                //Preenche os campos com "..." enquanto consulta webservice.
                 $("#txtRua").val("...")
                 $("#txtBairro").val("...")
                 $("#txtCidade").val("...")
                 $("#txtUf").val("...")

                 //Consulta o webservice viacep.com.br/
                 $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                     if (!("erro" in dados)) {
                         //Atualiza os campos com os valores da consulta.
                         $("#txtRua").val(dados.logradouro);
                         $("#txtBairro").val(dados.bairro);
                         $("#txtCidade").val(dados.localidade);
                         $("#txtUf").val(dados.uf);
                         $("#txtCep").val(dados.cep);
                     } //end if.
                    else {
                        //CEP pesquisado n�o foi encontrado.
                        //limpa_formulario_cep();
                        alert("CEP nao encontrado.");
                    }
                 });
            } //end if.
              else {
                  //cep � inv�lido.
                  limpa_formulario_cep();
                  alert("Formato de CEP inv�lido.");
              }
         } //end if.
          else {
              //cep sem valor, limpa formul�rio.
              limpa_formulario_cep();
          }
		});
	});

	function Imovel(imovel){		
		document.getElementById('txtIdImovel').value = imovel;
		document.getElementById('txtIdImovelProp').value = imovel;
	}
	
	function Fechar(){
		window.top.location.href = "imovel.php";
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
		  <div class="panel-heading" style="text-align:center;">Cadastro de Imovel</div>
		  	<div class="panel-body">
		  		<div class="text-center">		  		
				    <form action="/controle/implImovel.php" method="post" class="form-horizontal" data-toggle="validator" role="form" id="form">
							  <div class="form-group">							  
							    <label for="cod" class="col-sm-2 control-label">Codigo</label>
							    <div class="col-sm-2">
							      <input type="text" name="imovel" value="<?=$imovel->idImovel ?>" class="form-control" id="txtCodigo" placeholder="" disabled>
							    </div>
							    <?php if ($tipo != 'INS') {?> 
							    	<label for="enderecos" class="col-sm-1 control-label">Endereco</label>
								    <div class="col-sm-1">					      
								      <a href="#" id="usuModal" data-toggle="modal" data-target="#endereco-modal">
								      		<button type="button" onclick="Imovel(<?=$imovel->idImovel ?>)" class="btn btn-primary" data-dismiss="modal">
								      			<span class="glyphicon glyphicon-home" aria-hidden="true"></span> Visualizar							      		
								      		</button>
								      </a>
								    </div>
								    <label for="proprietarios" class="col-sm-1 control-label" style="padding-left: 50px;">Proprietario</label>
								    <div class="col-sm-1" style="padding-left: 50px;">					      
								      <a href="#" id="propModal" data-toggle="modal" data-target="#proprietario-modal">
								      		<button type="button" onclick="Imovel(<?=$imovel->idImovel ?>)" class="btn btn-primary" data-dismiss="modal">
								      			<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Visualizar							      		
								      		</button>
								      </a>
								    </div>
								<?php }?>
							  </div>
							  <div class="form-group">
									<label for="tipoImovel" class="col-sm-2 control-label">Tipo Imovel</label>
									<div class="col-sm-4">
										<select required name="tipoImovel" class="form-control" id="txtTipo"
											placeholder="Tipo do Imovel" value="" >			 							 
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
									  <select class="form-control"  name="status">
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
<!-- 						  	  <div class="form-group"> -->
<!-- 							    <label for="valor" class="col-sm-2 control-label">Valor</label> -->
<!-- 							    <div class="col-sm-2"> -->
<!-- 							      <input required  minlength="0" type="number" step="0.1" name="valor" class="form-control" id="txtValor" placeholder="Valor do Imovel" value="<?=$imovel->valor ?>""> -->
<!-- 							    </div> -->
<!-- 							  </div>			 -->
							  <div class="form-group">
							    <label for="observacao" class="col-sm-2 control-label">Observacao</label>
							    <div class="col-sm-8">
							      
							      <textarea required maxlength="500" rows="5" cols="100" name="observacao" class="form-control" id="txtObs" placeholder="Caracteristicas do Imovel" value="c>class="form-control" id="txtObs" placeholder="Caracteristicas do Imovel"><?=$imovel->observacao ?></textarea>
							    </div>
							  </div>	  							  
						  	  <div>
								<?php if ($tipo == 'INS') {?>
			 						<button type="submit" id="salvar" name="salvar" class="btn btn-success" value="Salvar">Salvar</button>  
								<?php }?>
								<?php if ($tipo == 'UPD') {?>
			 						<button type="submit" id="alterar" name="alterar" class="btn btn-success" value="Alterar">Alterar</button>  
								<?php }?>
								<a href="#" onclick="Fechar()"><button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button></a>
						  	  </div>
				  			<input type="hidden" name="idImovel" value="<?=$imovel->idImovel ?>"></input>
				  			<input type="hidden" name="txtIdEndereco" value="<?=$endereco->idEndereco ?>" id="txtIdEndereco" >
				  			<input type="hidden" name="txtIdProprietario" value="<?=$proprietario->idProprietario ?>" id="txtIdProprietario" >
				  </form>			  
	 			</div>  
			 </div>
		  </div>
		</div>
	</div>
	<div id="rodape">
		<?php
                //include("../rodape/rodape.php");
            ?>
	</div> 
	
	<!-- Modal Endereco-->
	<div class="modal fade" id="endereco-modal" tabindex="-1" role="dialog" 
		aria-labelledby="modalLabel" style="margin-top: 80px;">
		<div class="modal-dialog modal-sm" role="document" style="width:800px;">
			<div class="modal-content">
				<form action="/controle/implImovel.php" method="POST" id="form2" class="form-horizontal" data-toggle="validator" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabel">Endereco do Imovel</h4>
					</div>
					<div class="modal-body">				
						 <div class="form-group">
						    <label for="cod" class="col-sm-2 control-label">Codigo</label>
						    <div class="col-sm-2">
						      <input type="text" name="idEndereco" value="<?=$endereco->idEndereco ?>" class="form-control" id="idEndereco" placeholder="" disabled>
						      <input type="hidden" name="txtIdEndereco" value="<?=$endereco->idEndereco ?>" id="txtIdEndereco" >
						      <input type="hidden" name="txtIdImovel" id="txtIdImovel">
						      <input type="hidden" name="txtIdProprietario" value="<?=$proprietario->idProprietario ?>" id="txtIdProprietario" >
						    </div>
						 </div>		
						 <div class="form-group">
								<label for="cep" class="col-sm-2 control-label">CEP</label>
								<div class="col-sm-2">
									<input required maxlength="9" minlength="9" type="text" name="cep" class="form-control" pattern="[0-9]{5}-[0-9]{3}" 
										id="txtCep" placeholder="Cep" value="<?=$endereco->cep ?>">
								</div>
								<span style="text-align: left" class="help-block">Formato: 00000-000</span>
						 </div>
						 <div class="form-group">
								<label for="rua" class="col-sm-2 control-label">Rua</label>
								<div class="col-sm-8">
									<input  required maxlength="200" minlength="1" type="text" name="rua" value="<?=$endereco->rua ?>"
										class="form-control" id="txtRua" placeholder="Rua">
								</div>
						 </div>
						 <div class="form-group">
								<label for="bairroCliente" class="col-sm-2 control-label">Bairro</label>
								<div class="col-sm-5">
									<input  required maxlength="70" minlength="1" type="text" name="bairro" class="form-control"
										id="txtBairro" placeholder="Bairro"
										value="<?=$endereco->bairro ?>">
								</div>
						 </div>
						 <div class="form-group">
								<label for="cidadeCliente" class="col-sm-2 control-label">Cidade</label>
								<div class="col-sm-5">
									<input  required maxlength="50" minlength="1" type="text" name="cidade" class="form-control"
										id="txtCidade" placeholder="Cidade"
										value="<?=$endereco->cidade ?>">
								</div>
						 </div>
						 <div class="form-group">
								<label for="ufCliente" class="col-sm-2 control-label">Estado</label>
								<div class="col-sm-4">
									<select required name="uf" class="form-control" id="txtUf"
										placeholder="UF" value="" >			 							 
			 							 	<?php for($i=0; $i < count($estados["idEstado"]); $i ++) {?>
			 							 		<option <?php if ($estados["idEstado"][$i] == $endereco->uf) {?> selected <?php }?>  value="<?=$estados["idEstado"][$i]?>"><?=$estados["nomeEstado"][$i]?></option> 
			 							 	<?php }?>									 
									</select>
								</div>
						 </div> 				 
					</div>
					<div class="modal-footer">
					   <?php if ($tipo == 'INS') {?>
							<button type="submit" class="btn btn-success" name="salvarEndereco" id="salvarEndereco" value="Salvar">Salvar</button>
					   <?php }?>
					   <?php if ($tipo == 'UPD') {?>
					    	<button type="submit" id="salvarEnd" name="salvarEnd" class="btn btn-success" value="Salvar">Salvar</button>
					   <?php }?>
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

					</div>
				</form>
			</div>
		</div>
	</div>	
	
	<!-- Modal Proprietario-->
	<div class="modal fade" id="proprietario-modal" tabindex="-1" role="dialog" 
		aria-labelledby="modalLabel" style="margin-top: 80px;">
		<div class="modal-dialog modal-sm" role="document" style="width:800px;">
			<div class="modal-content">
				<form action="/controle/implImovel.php" method="POST" id="form2" class="form-horizontal" data-toggle="validator" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabel">Proprietario do Imovel</h4>
					</div>
				    <input type="hidden" name="txtIdImovelProp" id="txtIdImovelProp">
				    <input type="hidden" name="txtIdEndereco" value="<?=$endereco->idEndereco ?>" id="txtIdEndereco" >					
				<?php if ($proprietario->idProprietario != null) {?>
					<div class="modal-body">				
						 <div class="form-group">
						    <label for="cod" class="col-sm-2 control-label">Codigo</label>
						    <div class="col-sm-2">
						      <input type="text" name="idProprietario" value="<?=$proprietario->idProprietario ?>" class="form-control" id="idProprietario" placeholder="" disabled>
						      <input type="hidden" name="txtIdProprietario" value="<?=$proprietario->idProprietario ?>" id="txtIdProprietario" >
						    </div>
						 </div>		
					 	 <div class="form-group">
						    <label for="cpfProprietario" class="col-sm-2 control-label">CPF</label>
						    <div class="col-sm-4">
						      <input required maxlength="11" minlength="11" type="text" name="cpf" class="form-control" id="txtCpf" placeholder="CPF" value="<?=$proprietario->cpf ?>">
						    </div>
						    <span id="erroMsgCpf" style="text-align: left;color: red; display: none;">CPF j� existe, favor informar outro CPF!</span>
						  </div>		
						  <div class="form-group">
							    <label for="rgProprietario" class="col-sm-2 control-label">RG</label>
							    <div class="col-sm-2">
							      <input required maxlength="11" minlength="8" type="text" name="rg" class="form-control" id="txtRg" placeholder="RG" value="<?=$proprietario->rg ?>">
							    </div>
						  </div>					  
						  <div class="form-group">
						    <label for="nomeProprietario" class="col-sm-2 control-label">Nome</label>
						    <div class="col-sm-8">
						      <input required maxlength="150" minlength="10" type="text" name="nome" class="form-control" id="txtProprietario" placeholder="Nome" value="<?=$proprietario->nome ?>">
						    </div>
						  </div>			  		
						  <div class="form-group">
						    <label for="emailProprietario" class="col-sm-2 control-label">E-mail</label>
						    <div class="col-sm-6">
						      <input required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" name="emailProprietario" class="form-control" id="txtEmail" placeholder="E-mail" value="<?=$proprietario->email ?>">
						    </div>
						    <!-- <span id="erroMsg" style="text-align: left;color: red; display: none;">Login j� existe, favor informar outro login!</span> -->
						  </div>				  
					  	  <div class="form-group">
						    <label for="telefoneCel" class="col-sm-2 control-label">Celular</label>
						    <div class="col-sm-4">
						      <input required maxlength="10" minlength="10" type="text" name="telefoneContato"  class="form-control" id="txtCelular" placeholder="Tel. Celular" value="<?=$proprietario->telefoneContato ?>"">
						    </div>
						  </div>					  			  	
					</div>
				 <?php } else {?>
				 	<div class="modal-body">
					 	 <div class="form-group">
								<label for="listaProprietario" class="col-sm-2 control-label">Proprietario</label>
								<div class="col-sm-8">
									<select required name="opcaoProprietario" class="form-control" id="cbxOpcaoProprietario"
										placeholder="Proprietarios" value="" >		
											<option value="">Selecione um Proprietario</option>
										 <?php foreach ((array)$listaProprietario as $proprietario) { ?>
											<option value="<?=$proprietario->idProprietario ?>"><?=$proprietario->cpf . " - " . $proprietario->nome ?></option>
										 <?php }?>	 							 								 
									</select>
								</div>
								<div class="col-sm-1">					      
							      <a href="#" id="novoModal" data-toggle="modal" data-target="#novoProprietario-modal">
							      		<button type="button" onclick="Imovel(<?=$imovel->idImovel ?>)" class="btn btn-primary" data-dismiss="modal">
								      			<span class="glyphicon glyphicon-user" aria-hidden="true"></span> Novo							      		
								      	</button>
							      </a>
							     </div>
						 </div> 	
					</div>
				 <?php }?>	
					<div class="modal-footer">
					   <?php if ($tipo == 'UPD') {?>
					    	<button type="submit" id="salvarProp" name="salvarProp" class="btn btn-success" value="Salvar">Salvar</button>
					   <?php }?>
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

					</div>
				</form>
			</div>
		</div>
	</div>	
	
	<!-- Novo Modal Proprietario-->
	<div class="modal fade" id="novoProprietario-modal" tabindex="-1" role="dialog" 
		aria-labelledby="modalLabel" style="margin-top: 80px;">
		<div class="modal-dialog modal-sm" role="document" style="width:800px;">
			<div class="modal-content">
				<form action="/controle/implImovel.php" method="POST" id="form3" class="form-horizontal" data-toggle="validator" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabel">Proprietario do Imovel</h4>
					</div>
					<div class="modal-body">				
						 <div class="form-group">
						    <label for="cod" class="col-sm-2 control-label">Codigo</label>
						    <div class="col-sm-2">
						      <input type="text" name="idProprietario" value="" class="form-control" id="idProprietario" placeholder="" disabled>
						      <input type="hidden" name="txtIdProprietario" value="" id="txtIdProprietario" >
						      <input type="hidden" name="txtIdImovelProp" id="txtIdImovelProp">
						      <input type="hidden" name="txtIdEndereco" value="<?=$endereco->idEndereco ?>" id="txtIdEndereco" >
						    </div>
						 </div>		
					 	 <div class="form-group">
						    <label for="cpfProprietario" class="col-sm-2 control-label">CPF</label>
						    <div class="col-sm-4">
						      <input required maxlength="11" minlength="11" type="text" name="cpf" class="form-control" id="txtCpf" placeholder="CPF" value="">
						    </div>
						    <span id="erroMsgCpf" style="text-align: left;color: red; display: none;">CPF j� existe, favor informar outro CPF!</span>
						  </div>				
						  <div class="form-group">
							    <label for="rgProprietario" class="col-sm-2 control-label">RG</label>
							    <div class="col-sm-2">
							      <input required maxlength="11" minlength="8" type="text" name="rg" class="form-control" id="txtRg" placeholder="RG" value="">
							    </div>
						  </div>			  
						  <div class="form-group">
						    <label for="nomeProprietario" class="col-sm-2 control-label">Nome</label>
						    <div class="col-sm-8">
						      <input required maxlength="150" minlength="10" type="text" name="nome" class="form-control" id="txtProprietario" placeholder="Nome" value="">
						    </div>
						  </div>			  		
						  <div class="form-group">
						    <label for="emailProprietario" class="col-sm-2 control-label">E-mail</label>
						    <div class="col-sm-6">
						      <input required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" name="emailProprietario" class="form-control" id="txtEmail" placeholder="E-mail" value="">
						    </div>
						    <!-- <span id="erroMsg" style="text-align: left;color: red; display: none;">Login j� existe, favor informar outro login!</span> -->
						  </div>				  
					  	  <div class="form-group">
						    <label for="telefoneCel" class="col-sm-2 control-label">Celular</label>
						    <div class="col-sm-4">
						      <input required maxlength="10" minlength="10" type="text" name="telefoneContato"  class="form-control" id="txtCelular" placeholder="Tel. Celular" value="">
						    </div>
						  </div>					  			  	
					</div>	
					<div class="modal-footer">
					   <?php if ($tipo == 'UPD') {?>
					    	<button type="submit" id="salvarProp" name="salvarProp" class="btn btn-success" value="Salvar">Salvar</button>
					   <?php }?>
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

					</div>
				</form>
			</div>
		</div>
	</div>	
</body>
</html>