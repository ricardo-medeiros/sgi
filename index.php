<?php
session_start ();
$erro = '';
if (isset ( $_SESSION ["erroLogin"] )) {
	$erro = $_SESSION ["erroLogin"];
	session_unset ();
	session_destroy ();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>SGI-WEB</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="views/images/favicon.ico"
	type="image/x-icon"></link>
<link rel="stylesheet" type="text/css"
	href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
	});
	function limpaMsg(){
		document.getElementById('txtEmail').value = '';
		document.getElementById('usuario').value = '';
		document.getElementById('senha').value = '';
		
	}
</script>
<style type="text/css">
.carousel {
	height: 400px;
	margin-bottom: 0px;
}
/* Since positioning the image, we need to help out the caption */
.carousel-caption {
	z-index: 10;
}

/* Declare heights because of positioning of img element */
.carousel .item {
	height: 400px;
	background-color: #DCDCDC;
}

.carousel-inner>.item>img {
	position: absolute;
	top: 0;
	left: 0;
	min-width: 100%;
	height: 400px;
}
</style>
</head>
<body>
	<div id="menu" >
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand" href="#">SGI-WEB Sistema de Gerenciamento
						de Imoveis </a>
				</div>
				<div class="bar-login text-right">
					<button type="button" class="btn btn-warning"
						style="margin-top: 8px;" onclick="limpaMsg()" data-toggle="modal"
						data-target="#loginModal">Entrar</button>
				</div>
			</div>
		</nav>
	</div>
	<center>
		<div id="myCarousel" class="carousel slide" data-ride="carousel"
			style="width: 70%;">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner" role="listbox" >
				<div class="item active">
					<div class="container">
						<div class="carousel-caption" style="color: black;">
							<h1>Especifico para corretores.</h1>
							<p>
								Cadastre sua carteira de Clientes, Imoveis e proprietarios.
								Tenha de forma organizada todos seus registros. Controle todo seu fluxo imobiliario.
								Um sistema simples e objetivo para facilitar e modernizar sua estrutura de trabalho.<br/>
								Sem taxa de adesao, somente pagamento mensal. <h3>R$ 50,00</h3>								
							<p>
								<a class="btn btn-lg btn-warning" href="#" role="button">Contratar</a>
							</p>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="container">
						<div class="carousel-caption" style="color: black">
							<h1>Financeiro</h1>
							<p>Realiza o controle financeiro de suas contas a receber (Clientes) e a pagar (Proprietarios).<br/>
								O Sistema SGI apresenta de forma descomplicada todos seus dados financeiros, 
								e ainda possiblita a visualizacao em graficos para acompanhamento. <br/> 
								<h3>Gereciamento facil!</h3>
							</p>
							<p>
								<a class="btn btn-lg btn-warning" href="#" role="button">Saiba
									Mais</a>
							</p>
						</div>
					</div>
				</div>
				<div class="item">
					<div class="container">
						<div class="carousel-caption" style="color: black">
							<h1>Relatorios e Recibos</h1>
							<p>Visualize seus relatorios rapidamente!<br/>
								Recibos e contratos com o seu proprio logotipo.<br/>
								Relatorios de clientes, imoveis, contas a pagar, contas a receber.<br/>
								<h3>Mapeamento de todos seus registros.</h3>
							</p>
							<p>
								<a class="btn btn-lg btn-warning" href="#" role="button">Saiba
									Mais</a>
							</p>
						</div>
					</div>
				</div>
			</div>
			<a class="left carousel-control" href="#myCarousel" role="button"
				data-slide="prev"> <span class="glyphicon glyphicon-chevron-left"
				aria-hidden="true"></span> <span class="sr-only">Previous</span>
			</a> <a class="right carousel-control" href="#myCarousel"
				role="button" data-slide="next"> <span
				class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
		<!-- /.carousel -->
		<div class="container">
	      <!-- Example row of columns -->
	      <div class="row">
	        <div class="col-md-4">
	          <h3>Sem Taxa de Adesao</h3>
	          <p>O Sistema SGI foi desenvolvido para possibilitar o gerencimento facil e rapido, com isso nao cobramos taxa de adesao, somente pagamento mensal.</p>
	        </div>
	        <div class="col-md-4">
	          <h3>Sem Custo de Hospedagem</h3>
	          <p>Nao e cobrado nenhum custo de hospedagem do site, cada usuario vai ter um unico perfil por CPF e ainda podera utilizar seu proprio logotipo para impressao de relatorios. </p>
	       </div>
	        <div class="col-md-4">
	          <h3>Seguranca</h3>
	          <p>Suas informacoes de perfil e seus dados cadastrais de clientes, proprietario e imoveis, estarao disponiveis somente para o usuario logado. </p>
	        </div>
	      </div>		
	      
	</center>
	<div id="rodape"
		style="position: fixed; bottom: 0; width: 100%; font-weight: bold; background-color: black;">
		 <?php
        echo "<p align='center' style='font-size:10px;color:white' >SGI-WEB - Versao 1.0 - Produzido por Ricardo Medeiros</p>";
    ?>
    </div>
	<!-- Login-->
	<div style="margin-top: 100px;" id="loginModal" tabindex="-1"
		class="modal fade" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h3 class="modal-title" id="myModalLabel"
						style="text-align: center; font-weight: bold;">Acesso ao Sistema</h3>
				</div>
				<div class="modal-body">
					<form name='f' action="controle/login.controller.php" method='POST'
						data-toggle="validator" role="form">
						<div class="form-group">
							<label for="usuario" class="control-label">Login:</label> <input
								required type='email'
								pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
								class="form-control" id="usuario" name='j_username'
								placeholder="E-mail" />
						</div>
						<div class="form-group">
							<label for="senha" class="control-label">Senha:</label> <input
								required type='password' class="form-control" id="senha"
								name='j_password' placeholder="Senha" />
						</div>
						<div class="modal-footer">
							<!-- <label id="msgLogin" class="col-md-12" style="color: red;"></label>-->
							<?php if ($erro != ''){?>
							  <div class="alert alert-danger">
								<a href="#" class="close" data-dismiss="alert"
									aria-label="close">&times;</a> Login ou Senha invalidos.
							</div>
							<?php }?>
							<?php if($erro != '') {?><script type="text/javascript">$('#loginModal').modal();</script><?php }?>
							<input type="submit" name="submit" class="btn btn-success"
								value="Entrar" /> <br /> <br />
							<div class="passwordRecoverLink col-md-15"
								style="text-align: center;">
								<table width="100%">
									<tr>
										<!-- <td align="left"><a href="#" onclick="limpaMsg()"
											data-toggle="modal" data-target="#cadastro-modal"
											data-dismiss="modal" style="font-size: 13px;">Cadastrar-se </a>
										</td> -->
										<td align="right"><a href="#" onclick="limpaMsg()"
											data-toggle="modal" data-target="#envio-modal"
											data-dismiss="modal" style="font-size: 13px;">Recuperar Senha
										</a></td>
									</tr>
								</table>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal Envio de Senha -->
	<div class="modal fade" id="envio-modal" tabindex="-1" role="dialog"
		aria-labelledby="modalLabel">
		<div class="modal-dialog modal-sm" role="document">
			<div class="modal-content">
				<form action="controle/envia_email.php" method="POST" data-toggle="validator" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabel">Recuperar Senha</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="email" class="control-label">E-mail:</label> <input
								required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"
								id="txtEmail" name="txtEmail" type="email"
								placeholder="Digite seu E-mail" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<label id="msgEmail" style="color: blue;"></label><br /> <input
							type="submit" name="submit" class="btn btn-success"
							value="Enviar" />
						<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
					</div>
				</form>
			</div>
		</div>
	</div>	
</body>
</html>