<?php
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/tipo_desconto.controle.php');
	require_once(__ROOT__.'/controle/verifica.login.php');
	$verifica = new verifica_login();
	$ok = $verifica->verifica();
	
	if ($ok){
		echo "<script type='text/javascript' language='javascript'>
				window.top.location.href = '/index.php';
			  </script>";
	}
		
	$tipo = base64_decode($_GET['tipo']);	
	$controleDesconto = new Tipo_Desconto_Controle();	
	$idTipoDesconto = base64_decode($_GET['idTipoDesconto']);
	$tipoDesconto = $controleDesconto->getTipoDesconto($idTipoDesconto);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Cadastro Tipo de Descontos</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="iso-8859-1" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript" language="javascript">
	function TipoDesconto(tipoDesconto){		
		document.getElementById('txtIdTipoDesconto').value = tipoDesconto;
	}
	function Fechar(){
		window.top.location.href = "tipodesconto.php";
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
		  <div class="panel-heading" style="text-align:center;">Cadastro Tipo de Descontos</div>
		  	<div class="panel-body">
		  		<div class="text-center">		  		
				    <form action="/controle/implTipoDesconto.php" method="post" class="form-horizontal" data-toggle="validator" role="form" id="form">
							  <div class="form-group">							  
							    <label for="cod" class="col-sm-3 control-label">Codigo</label>
							    <div class="col-sm-2">
							      <input type="text" name="tipoDesconto" value="<?=$tipoDesconto->idTipoDesconto ?>" class="form-control" id="txtCodigo" placeholder="" disabled>
							    </div>
							  </div>						  
							  <div class="form-group">
							    <label for="descDesconto" class="col-sm-3 control-label">Descricao do Desconto</label>
							    <div class="col-sm-8">
							      <input required maxlength="200" minlength="10" type="text" name="descDesconto" class="form-control" id="txtDescDesconto" placeholder="Descricao do Desconto" value="<?=$tipoDesconto->descDesconto ?>">
							    </div>
							  </div>		
							  <div class="form-group">
									<label for="tipoDesc" class="col-sm-3 control-label">Tipo Desconto</label>
									<div class="col-sm-2">
										<select required name="tipoDesc" class="form-control" id="txtTipo"
											placeholder="Tipo do Desconto" value="" >			 							 				 							 	
				 							 	<?php if ($tipo != 'INS') {?> 
					 						  	   <?php if ($tipoDesconto->tipo == 'C') {?> 
											    	<option value="C">Credito</option>
											    	<option value="D">Debito</option>					    	
					 							   <?php }?>
												   <?php if ($tipoDesconto->tipo == 'D') {?> 
											    	<option value="D">Debito</option> 
				 							    	<option value="C">Credito</option>					    	 
				 								   <?php }?>
	 											<?php }?>
												<?php if ($tipo == 'INS' || $tipoDesconto->tipo == '')  {?> 
				 									<option value="C">Credito</option> 
				 							    	<option value="D">Debito</option>									   
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
						<a href="#" onclick="Fechar()"><button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button></a>
				  		</div>
				  		<input type="hidden" name="idTipoDesconto" value="<?=$tipoDesconto->idTipoDesconto ?>"></input>
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
</body>
</html>