<?php
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/cliente.controle.php');
	$tipo = $_REQUEST["tipo"];		
	$controleCliente = new Cliente_Controle();	
	//$lista = $controleCliente->listaCliente();
	$idCliente = $_REQUEST["idCliente"];
	$cliente = $controleCliente->getCliente($idCliente);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Cadastro de Cliente</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript">

</script>
</head>
<body style="margin: 0">
	<div id="menu">
		<?php
               // include("../cabecalho/menu.php");
            ?>
	</div>
	<div id="corpo" class="container" style="margin-top: 80px; width: 85%;">
		<div class="panel panel-primary">
		  <div class="panel-heading" style="text-align:center;">Cadastro de Cliente</div>
		  	<div class="panel-body">
		  		<div class="text-center">		  		
				    <form action="/sgi/controle/implCliente.php" method="post" class="form-horizontal" data-toggle="validator" role="form" id="form">
							  <div class="form-group">
							    <label for="cod" class="col-sm-2 control-label">Codigo</label>
							    <div class="col-sm-1">
							      <input type="text" name="cliente" value="<?=$cliente->idCliente ?>" class="form-control" id="txtCodigo" placeholder="" disabled>
							    </div>
							    <?php if ($tipo != 'INS') {?> 
							    	<label for="enderecos" class="col-sm-1 control-label">Endereco</label>
								    <div class="col-sm-1">					      
								      <a href="#" id="usuModal" data-toggle="modal" data-target="#endereco-modal">
								      		<button type="button" class="btn btn-primary" data-dismiss="modal">
								      			<span class="glyphicon glyphicon-home" aria-hidden="true"></span> Visualizar							      		
								      		</button>
								      </a>
								    </div>
								<?php }?>
							  </div>
							  <div class="form-group">
							    <label for="cpfCliente" class="col-sm-2 control-label">CPF</label>
							    <div class="col-sm-2">
							      <input required maxlength="11" minlength="11" type="text" name="cpf" class="form-control" id="txtCpf" placeholder="CPF" value="<?=$cliente->cpf ?>">
							    </div>
							    <span id="erroMsgCpf" style="text-align: left;color: red; display: none;">CPF j� existe, favor informar outro CPF!</span>
							  </div>					
							  <div class="form-group">
							    <label for="rgCliente" class="col-sm-2 control-label">RG</label>
							    <div class="col-sm-2">
							      <input required maxlength="11" minlength="8" type="text" name="rg" class="form-control" id="txtRg" placeholder="RG" value="<?=$cliente->rg ?>"">
							    </div>
							  </div>	  
							  <div class="form-group">
							    <label for="nomeCliente" class="col-sm-2 control-label">Nome</label>
							    <div class="col-sm-6">
							      <input required maxlength="150" minlength="10" type="text" name="nome" class="form-control" id="txtCliente" placeholder="Nome" value="<?=$cliente->nome ?>">
							    </div>
							  </div>			  		
							  <div class="form-group">
							    <label for="emailCliente" class="col-sm-2 control-label">E-mail</label>
							    <div class="col-sm-4">
							      <input required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" name="emailCliente" class="form-control" id="txtEmail" placeholder="E-mail" value="<?=$cliente->email ?>">
							    </div>
							    <!-- <span id="erroMsg" style="text-align: left;color: red; display: none;">Login j� existe, favor informar outro login!</span> -->
							  </div>				  
						  	  <div class="form-group">
							    <label for="telefoneCel" class="col-sm-2 control-label">Celular</label>
							    <div class="col-sm-2">
							      <input required maxlength="10" minlength="10" type="text" name="telefoneCelular"  class="form-control" id="txtCelular" placeholder="Tel. Celular" value="<?=$cliente->telefoneCelular ?>"">
							    </div>
							  </div>					  			  
							  <div class="form-group">
							    <label for="nascCliente" class="col-sm-2 control-label">Nascimento</label>
							    <div class="col-sm-3">					      
							      <input required  type="date" maxlength="10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" name="dataNascimento" class="form-control" id="txtNasc" placeholder="Nascimento" value="<?=$cliente->dataNascimento ?>"">
							    </div>
							    <span style="text-align: left" class="help-block">Formato: dd/mm/aaaa</span>
							  </div>	
							  <div class="form-group">				 					  				  
								  <label for="statusUsuario" class="col-sm-2 control-label">Status</label>
								  <div class="col-sm-2">
									  <select class="form-control"  name="status">
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
				  		<div>
						<?php if ($tipo == 'INS') {?>
	 						<button type="submit" id="salvar" name="salvar" class="btn btn-success" value="Salvar">Salvar</button>  
						<?php }?>
						<?php if ($tipo == 'UPD') {?>
	 						<button type="submit" id="alterar" name="alterar" class="btn btn-success" value="Alterar">Alterar</button>  
						<?php }?>
						<a href="cliente.php"><button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button></a>
				  		</div>
				  		<input type="hidden" name="idCliente" value="<?=$cliente->idCliente ?>"></input>
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
				<form action="#" method="POST" id="form2" class="form-horizontal" data-toggle="validator" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabel">Endereco do Cliente</h4>
					</div>
					<div class="modal-body">				
						 <!-- <label class="control-label">Selecionar Arquivo</label><br/>
						 <input required id="input-1" type="file" name="uploadFile" class="file" accept="image/gif, image/jpeg, image/png"> 
						 <input type="hidden" id="txtPagina" name="txtPagina" /> -->
						 <div class="form-group">
						    <label for="cod" class="col-sm-2 control-label">Codigo</label>
						    <div class="col-sm-1">
						      <input type="text" name="idEndereco" value="" class="form-control" id="txtIdEndereco" placeholder="" disabled>
						    </div>
						 </div>		
						 <div class="form-group">
								<label for="cep" class="col-sm-2 control-label">CEP</label>
								<div class="col-sm-2">
									<input required maxlength="9" minlength="9" type="text" name="cep" class="form-control"
										id="txtCep" placeholder="Cep" value="">
								</div>
								<span style="text-align: left" class="help-block">Formato: 00000-000</span>
						 </div>
						 <div class="form-group">
								<label for="rua" class="col-sm-2 control-label">Rua</label>
								<div class="col-sm-8">
									<input  required maxlength="200" minlength="1" type="text" name="rua" value=""
										class="form-control" id="txtRua" placeholder="Rua">
								</div>
						 </div>
						 <div class="form-group">
								<label for="bairroCliente" class="col-sm-2 control-label">Bairro</label>
								<div class="col-sm-5">
									<input  required maxlength="70" minlength="1" type="text" name="bairro" class="form-control"
										id="txtBairro" placeholder="Bairro"
										value="">
								</div>
						 </div>
						 <div class="form-group">
								<label for="cidadeCliente" class="col-sm-2 control-label">Cidade</label>
								<div class="col-sm-5">
									<input  required maxlength="50" minlength="1" type="text" name="cidade" class="form-control"
										id="txtCidade" placeholder="Cidade"
										value="">
								</div>
						 </div>
						 <div class="form-group">
								<label for="ufCliente" class="col-sm-2 control-label">Estado</label>
								<div class="col-sm-4">
									<select required name="uf" class="form-control" id="txtUf"
										placeholder="UF" value="">
			 							 <?php if ($tipo == 'INS') {?> 
										    	<option value="#">Selecione</option>
												<option value="ac">Acre</option> 
												<option value="al">Alagoas</option> 
												<option value="am">Amazonas</option> 
												<option value="ap">Amapa</option> 
												<option value="ba">Bahia</option> 
												<option value="ce">Ceara</option> 
												<option value="df">Distrito Federal</option> 
												<option value="es">Espirito Santo</option> 
												<option value="go">Goias</option> 
												<option value="ma">Maranhao</option> 
												<option value="mt">Mato Grosso</option> 
												<option value="ms">Mato Grosso do Sul</option> 
												<option value="mg">Minas Gerais</option> 
												<option value="pa">Para</option> 
												<option value="pb">Paraiba</option> 
												<option value="pr">Parana</option> 
												<option value="pe">Pernambuco</option> 
												<option value="pi">Piaui</option> 
												<option value="rj">Rio de Janeiro</option> 
												<option value="rn">Rio Grande do Norte</option> 
												<option value="ro">Rondonia</option> 
												<option value="rs">Rio Grande do Sul</option> 
												<option value="rr">Roraima</option> 
												<option value="sc">Santa Catarina</option> 
												<option value="se">Sergipe</option> 
												<option value="sp">Sao Paulo</option> 
												<option value="to">Tocantins</option> 					    	
			 							 <?php } ?> 
			 							 <?php if ($tipo != 'INS') {?> 
										    	<option value="#">Selecione</option>
												<option value="ac">Acre</option> 
												<option value="al">Alagoas</option> 
												<option value="am">Amazonas</option> 
												<option value="ap">Amapa</option> 
												<option value="ba">Bahia</option> 
												<option value="ce">Ceara</option> 
												<option value="df">Distrito Federal</option> 
												<option value="es">Espirito Santo</option> 
												<option value="go">Goias</option> 
												<option value="ma">Maranhao</option> 
												<option value="mt">Mato Grosso</option> 
												<option value="ms">Mato Grosso do Sul</option> 
												<option value="mg">Minas Gerais</option> 
												<option value="pa">Para</option> 
												<option value="pb">Paraiba</option> 
												<option value="pr">Parana</option> 
												<option value="pe">Pernambuco</option> 
												<option value="pi">Piaui</option> 
												<option value="rj">Rio de Janeiro</option> 
												<option value="rn">Rio Grande do Norte</option> 
												<option value="ro">Rondonia</option> 
												<option value="rs">Rio Grande do Sul</option> 
												<option value="rr">Roraima</option> 
												<option value="sc">Santa Catarina</option> 
												<option value="se">Sergipe</option> 
												<option value="sp">Sao Paulo</option> 
												<option value="to">Tocantins</option> 				    	
			 							 <?php } ?> 
									</select>
								</div>
						 </div> 				 
					</div>
					<div class="modal-footer">
					   <?php if ($tipo == 'INS') {?>
							<button type="submit" class="btn btn-success" name="submit" id="i_submit">Salvar</button>
					   <?php }?>
					   <?php if ($tipo == 'UPD') {?>
					    	<button type="submit" id="alterarEnd" name="alterarEnd" class="btn btn-success" value="Alterar">Alterar</button>
					   <?php }?>
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

					</div>
				</form>
			</div>
		</div>
	</div>	
</body>
</html>