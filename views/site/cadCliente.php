<?php 
	$tipo = $_REQUEST["tipo"];
?>
<head>
<title>Cadastro de Cliente</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<script	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

</head>
<body style="margin: 0">
	<div id="menu">
		<?php
                include("../cabecalho/menu.php");
            ?>
	</div>
	<div id="corpo" class="container" style="margin-top: 80px; width: 85%;">
		<div class="panel panel-primary">
		  <div class="panel-heading" style="text-align:center;">Cadastro de Cliente</div>
		  	<div class="panel-body">
		  		<div class="text-center">
				    <form action="#" method="post" class="form-horizontal" data-toggle="validator" role="form" id="form">
					  <!-- <table border="1" style="width: 100%; font-size: 14px;"> -->
<!-- 					  	<tr> -->
<!-- 					  	   <td> -->
							  <div class="form-group">
							    <label for="cod" class="col-sm-2 control-label">Codigo</label>
							    <div class="col-sm-1">
							      <input type="text" name="cliente" value="" class="form-control" id="txtCodigo" placeholder="" disabled>
							    </div>
							  </div>
							  <div class="form-group">
							    <label for="cpfCliente" class="col-sm-2 control-label">CPF</label>
							    <div class="col-sm-2">
							      <input required maxlength="11" minlength="11" type="text" name="cpf" class="form-control" id="txtCpf" placeholder="CPF" value="">
							    </div>
							    <span id="erroMsgCpf" style="text-align: left;color: red; display: none;">CPF já existe, favor informar outro CPF!</span>
							  </div>					
							  <div class="form-group">
							    <label for="rgCliente" class="col-sm-2 control-label">RG</label>
							    <div class="col-sm-2">
							      <input required maxlength="11" minlength="8" type="text" name="rg" class="form-control" id="txtRg" placeholder="RG" value="">
							    </div>
							  </div>	  
							  <div class="form-group">
							    <label for="nomeCliente" class="col-sm-2 control-label">Nome</label>
							    <div class="col-sm-6">
							      <input required maxlength="150" minlength="10" type="text" name="nome" class="form-control" id="txtCliente" placeholder="Nome" value="">
							    </div>
							  </div>			  		
							  <div class="form-group">
							    <label for="emailCliente" class="col-sm-2 control-label">E-mail</label>
							    <div class="col-sm-4">
							      <input required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" name="emailCliente" class="form-control" id="txtEmail" placeholder="E-mail" value="">
							    </div>
							    <!-- <span id="erroMsg" style="text-align: left;color: red; display: none;">Login já existe, favor informar outro login!</span> -->
							  </div>				  
						  	  <div class="form-group">
							    <label for="telefoneCel" class="col-sm-2 control-label">Celular</label>
							    <div class="col-sm-2">
							      <input required maxlength="10" minlength="10" type="text" name="telefoneCelular"  class="form-control" id="txtCelular" placeholder="Tel. Celular" value="">
							    </div>
							  </div>					  			  
							  <div class="form-group">
							    <label for="nascCliente" class="col-sm-2 control-label">Nascimento</label>
							    <div class="col-sm-2">					      
							      <input required  type="date" maxlength="10" pattern="[0-9]{2}\/[0-9]{2}\/[0-9]{4}$" name="dataNasc" class="form-control" id="txtNasc" placeholder="Nascimento" value="#">
							    </div>
							    <span style="text-align: left" class="help-block">Formato: dd/mm/aaaa</span>
							  </div>	
							  <div class="form-group">				 					  				  
								  <label for="statusUsuario" class="col-sm-2 control-label">Status</label>
								  <div class="col-sm-2">
									  <select class="form-control"  name="status">
			<!-- 							<c:if test="${modo != 'ins'}"> -->
			<!-- 						  		<c:if test="${funcionario.usuario.status == 'A'}"> -->
										    	<option value="#">Ativo</option>
										    	<option value="D">Desativado</option>					    	
			<!-- 							    </c:if> -->
			<!-- 						  		<c:if test="${funcionario.usuario.status == 'D'}"> -->
			<!-- 							    	<option value="${funcionario.usuario.status}">Desativado</option> -->
			<!-- 							    	<option value="A">Ativo</option>					    	 -->
			<!-- 							    </c:if>	 -->
			<!-- 							 </c:if> -->
			<!-- 						     <c:if test="${modo == 'ins'}">	 -->
			<!-- 									<option value="A">Ativo</option> -->
			<!-- 							    	<option value="D">Desativado</option>									   -->
			<!-- 							  </c:if>	 -->
									  </select>
								  </div>
						  		</div>		
<!-- 				  			</td> -->
				  			<!-- <td style="vertical-align: top; width: 200px;"> -->
				  				
<!-- 				  			</td> -->
<!-- 				  		  </tr> -->
<!-- 				  		</table>  	   -->
				  		<div>
	<!-- 				    <c:if test="${modo == 'cns'}"> -->
					  		<a href="cliente.php"><button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button></a>
	<!-- 					</c:if> -->
	<!-- 					<c:if test="${modo != 'cns'}"> -->
	<!-- 						<button type="submit" name="submit" class="btn btn-success">Salvar</button> -->
	<!-- 				  		<a href="listaFuncionario"><button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button></a> -->
	<!-- 					</c:if>		  	 -->
				  		</div>
				  		<input type="hidden" name="idCliente" value="#"></input>
				  </form>
	 			</div>  
			 </div>
		  </div>
		</div>
	</div>
	<div id="rodape">
		<?php
                include("../rodape/rodape.php");
            ?>
	</div> 
</body>
</html>