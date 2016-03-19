<?php
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/proprietario.controle.php');
	require_once(__ROOT__.'/controle/verifica.login.php');
	$verifica = new verifica_login();
	$ok = $verifica->verifica();
	
	if ($ok){
		echo "<script type='text/javascript' language='javascript'>
				window.top.location.href = '/sgi/index.php';
			  </script>";
	}
	
	//$tipo = $_REQUEST["tipo"];	
	$tipo = base64_decode($_GET['tipo']);	
	$controleProprietario = new Proprietario_Controle();	
	//$idCliente = $_REQUEST["idCliente"];
	$idProprietario = base64_decode($_GET['idProprietario']);
	$proprietario = $controleProprietario->getProprietario($idProprietario);
	//$endereco = new Endereco_Model();
	$estados = $controleProprietario->getEstados();
	//if ($cliente->endereco > 0){
	//	$endereco= $controleCliente->getEndCliente($cliente);
	//}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Cadastro de Proprietario</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript">
	function Proprietario(proprietario){		
		document.getElementById('txtIdProprietario').value = proprietario;
	}
	function Fechar(){
		window.top.location.href = "proprietario.php";
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
		  <div class="panel-heading" style="text-align:center;">Cadastro de Proprietario</div>
		  	<div class="panel-body">
		  		<div class="text-center">		  		
				    <!-- <form action="/sgi/controle/implCliente.php" method="post" class="form-horizontal" data-toggle="validator" role="form" id="form"> -->
				    <form action="/sgi/controle/implProprietario.php" method="post" class="form-horizontal" data-toggle="validator" role="form" id="form">
							  <div class="form-group">							  
							    <label for="cod" class="col-sm-2 control-label">Codigo</label>
							    <div class="col-sm-2">
							      <input type="text" name="proprietario" value="<?=$proprietario->idProprietario ?>" class="form-control" id="txtCodigo" placeholder="" disabled>
							    </div>
							     
							    <?php if ($tipo != 'INS') {?> 
							    	<!--<label for="enderecos" class="col-sm-1 control-label">Endereco</label>
								    <div class="col-sm-1">					      
								      <a href="#" id="usuModal" data-toggle="modal" data-target="#endereco-modal">
								      		<button type="button" onclick="Cliente(<?=$cliente->idCliente ?>)" class="btn btn-primary" data-dismiss="modal">
								      			<span class="glyphicon glyphicon-home" aria-hidden="true"></span> Visualizar							      		
								      		</button>
								      </a>
								    </div> -->
								<?php }?> 
							  </div>
							  <div class="form-group">
							    <label for="cpfProprietario" class="col-sm-2 control-label">CPF</label>
							    <div class="col-sm-2">
							      <input required maxlength="11" minlength="11" type="text" name="cpf" class="form-control" id="txtCpf" placeholder="CPF" value="<?=$proprietario->cpf ?>">
							    </div>
							    <span id="erroMsgCpf" style="text-align: left;color: red; display: none;">CPF já existe, favor informar outro CPF!</span>
							  </div>						  
							  <div class="form-group">
							    <label for="nomeProprietario" class="col-sm-2 control-label">Nome</label>
							    <div class="col-sm-6">
							      <input required maxlength="150" minlength="10" type="text" name="nome" class="form-control" id="txtProprietario" placeholder="Nome" value="<?=$proprietario->nome ?>">
							    </div>
							  </div>			  		
							  <div class="form-group">
							    <label for="emailProprietario" class="col-sm-2 control-label">E-mail</label>
							    <div class="col-sm-4">
							      <input required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" name="emailProprietario" class="form-control" id="txtEmail" placeholder="E-mail" value="<?=$proprietario->email ?>">
							    </div>
							    <!-- <span id="erroMsg" style="text-align: left;color: red; display: none;">Login já existe, favor informar outro login!</span> -->
							  </div>				  
						  	  <div class="form-group">
							    <label for="telefoneCel" class="col-sm-2 control-label">Celular</label>
							    <div class="col-sm-2">
							      <input required maxlength="10" minlength="10" type="text" name="telefoneContato"  class="form-control" id="txtCelular" placeholder="Tel. Celular" value="<?=$proprietario->telefoneContato ?>"">
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
				  		<input type="hidden" name="idProprietario" value="<?=$proprietario->idProprietario ?>"></input>
				  		<!-- <input type="hidden" name="txtIdEndereco" value="<?=$endereco->idEndereco ?>" id="txtIdEndereco" > -->
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
				<form action="/sgi/controle/implCliente.php" method="POST" id="form2" class="form-horizontal" data-toggle="validator" role="form">
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
						    <div class="col-sm-2">
						      <input type="text" name="idEndereco" value="<?=$endereco->idEndereco ?>" class="form-control" id="idEndereco" placeholder="" disabled>
						      <input type="hidden" name="txtIdEndereco" value="<?=$endereco->idEndereco ?>" id="txtIdEndereco" >
						      <input type="hidden" name="txtIdCliente" id="txtIdCliente">
						    </div>
						 </div>		
						 <div class="form-group">
								<label for="cep" class="col-sm-2 control-label">CEP</label>
								<div class="col-sm-2">
									<input required maxlength="9" minlength="9" type="text" name="cep" class="form-control"
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
</body>
</html>