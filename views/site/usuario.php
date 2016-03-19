<?php
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/usuario.controle.php');
	require_once(__ROOT__.'/modelo/endereco.model.php');
	$idUsuario = base64_decode($_GET['usuario']);//$_REQUEST["idUsuario"];	
	$endereco = new Endereco_Model();
	$controleUsuario = new Usuario_Controle();
		
	$usuario = $controleUsuario->getUsuario($idUsuario);		
	$estados = $controleUsuario->getEstados();
	if ($usuario->endereco > 0){
		$endereco= $controleUsuario->getEndUsuario($usuario);
	}						
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Corretor(a)</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta charset="utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--   <link rel="shortcut icon" href="../images/favicon.ico" type="image/x-icon"></link> -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="//code.jquery.com/jquery-2.2.1.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script type="text/javascript">
  	$(document).ready(function(){
  		function limpa_formulario_cep() {
            // Limpa valores do formulário de cep.
            $("#txtRua").val("");
            $("#txtBairro").val("");
            $("#txtCidade").val("");
            $("#txtUf").val("");
        }
        
  		$('img').attr('src', $('img').attr('src') + '?' + Math.random());
  		$('#alterar').click( function() {
    	    //check whether browser fully supports all File API
    	    if (window.File && window.FileReader && window.FileList && window.Blob)
    	    {
    	        //get the file size and file type from file input field
    	        var fsize = $('#imgLogo')[0].files[0].size;
    	        
    	        if(fsize > 524288) //não pode ter mais que 500kb 
    	        {
    	            alert("Imagem muito grande, superior a 500kb!");
    	            return false;
    	        }else{
    	            //alert(fsize +" bites\nYou are good to go!");
    	        }
    	    }else{
    	        alert("Por favor atualize seu navegador, depois repita a operação!");
    	    }
    	});     
    	$("#txtCep").blur(function(){
    		
     		var cep = $(this).val().replace(/\D/g, '');
     		
     		if (cep != "") {     			
         		   //Expressão regular para validar o CEP.
                   var validacep = /^[0-9]{8}$/;

                 //Valida o formato do CEP.
                 if(validacep.test(cep)) {
                    //Preenche os campos com "..." enquanto consulta webservice.
                     $("#txtRua").val("...")
                     $("#txtBairro").val("...")
                     $("#txtCidade").val("...")
                     $("#txtUf").val("...")

//                     //Consulta o webservice viacep.com.br/
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
                            //CEP pesquisado não foi encontrado.
                            //limpa_formulario_cep();
                            alert("CEP nao encontrado.");
                        }
                     });
                } //end if.
                  else {
                      //cep é inválido.
                      limpa_formulario_cep();
                      alert("Formato de CEP inválido.");
                  }
             } //end if.
              else {
                  //cep sem valor, limpa formulário.
                  limpa_formulario_cep();
              }
    	});
  	});

  	
  	function Usuario(usuario){		
		document.getElementById('txtIdUsuario').value = usuario;
	}
  </script>
</head>
    <body>
        <div id="menu">
            <?php
                include("../cabecalho/menu.php");
            ?>
        </div>
        <div id="corpo" class="container" style="padding-top: 80px">
            <div class="panel panel-primary">
			  <div class="panel-heading" style="text-align:center;">Cadastro de Corretor(a)</div>
			  	<div class="panel-body">
			  		<div class="text-center">		  		
					    <form action="/sgi/controle/implUsuario.php" enctype="multipart/form-data" method="post" class="form-horizontal" data-toggle="validator" role="form" id="form">
					    <table>
					      <tr>
					         <td style="width: 100%;">
								  <div class="form-group">
								    <label for="codigo" class="col-sm-2 control-label">Codigo</label>			    
								    <div class="col-sm-2">
								      <input type="text" name="usuario" value="<?=$usuario->idUsuario ?>" class="form-control" id="txtCodigo" placeholder="" disabled>
								    </div>
							    	<label for="enderecos" class="col-sm-1 control-label">Endereco</label>
								    <div class="col-sm-1">					      
								      <a href="#" id="usuModal" data-toggle="modal" data-target="#endereco-modal">
								      		<button type="button" onclick="Usuario(<?=$usuario->idUsuario ?>)" class="btn btn-primary" data-dismiss="modal">
								      			<span class="glyphicon glyphicon-home" aria-hidden="true"></span> Visualizar							      		
								      		</button>
								      </a>
								    </div>
								  </div>
								  <div class="form-group">
								    <label for="cpfUsuario" class="col-sm-2 control-label">CPF</label>
								    <div class="col-sm-2">
								      <input  required maxlength="11" minlength="11" type="text" name="cpf" class="form-control" id="txtCpf" placeholder="CPF" value="<?=$usuario->cpf ?>">
								    </div>
								    <span id="erroMsgCpf" style="text-align: left;color: red; display: none;">CPF já existe, favor informar outro CPF!</span>
								  </div>					  
								  <div class="form-group">
								    <label for="nomeUsuario" class="col-sm-2 control-label">Nome</label>
								    <div class="col-sm-6">
								      <input required maxlength="150" minlength="10" type="text" name="nome" class="form-control" id="txtUsuario" placeholder="Nome" value="<?=$usuario->nome ?>">
								    </div>
								  </div>			  		
								  <div class="form-group">
								    <label for="emailUsuario" class="col-sm-2 control-label">Login</label>
								    <div class="col-sm-4" >
								      <input disabled="disabled" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" type="email" name="login" class="form-control" id="txtEmail" placeholder="E-mail" value="<?=$usuario->login ?>">
								    </div>
								    <!-- <span id="erroMsg" style="text-align: left;color: red; display: none;">Login já existe, favor informar outro login!</span> -->
								  </div>				
								  <div class="form-group">
								    <label for="senhaUsuario" class="col-sm-2 control-label">Senha</label>
								    <div class="col-sm-4">					      
								      <input required  type="password" minlength="6" maxlength="10" name="senha" class="form-control" id="txtSenha" placeholder="Senha" value="<?=$usuario->senha ?>"">
								    </div>
								  </div>	  
							  	  <div class="form-group">
								    <label for="telefoneCel" class="col-sm-2 control-label">Celular</label>
								    <div class="col-sm-2">
								      <input required maxlength="10" minlength="10" type="text" name="telefoneCelular"  class="form-control" id="txtCelular" placeholder="Tel. Celular" value="<?=$usuario->telefoneContato ?>"">
								    </div>
								  </div>					  			  								 
								  <div class="form-group">				 					  				  
									  <label for="statusUsuario" class="col-sm-2 control-label">Status</label>
									  <div class="col-sm-2">
										  <select class="form-control"  name="status" disabled="disabled">
			 						  	   <?php if ($usuario->status == 'A') {?> 
									    	<option value="A">Ativo</option>
									    	<option value="D">Desativado</option>					    	
			 							   <?php }?>
										   <?php if ($usuario->status == 'D') {?> 
									    	<option value="D">Desativado</option> 
		 							    	<option value="A">Ativo</option>					    	 
		 								   <?php }?>
										  </select>
									  </div>
							  	 </div>
							  	 <div class="form-group">
								    <label for="imagemLogo" class="col-sm-2 control-label">Logo Corretor(a)</label>
								    <div class="col-sm-4">
								      <input   required class="file" accept="image/gif, image/jpeg, image/png" type="file" name="caminhoLogo" id="imgLogo" value="<?=$usuario->caminhoLogo ?>">
								    </div>
								 </div>			
						  		<div>
			 						<button type="submit" id="alterar" name="alterar" class="btn btn-success" value="Alterar">Alterar</button>  
						  		</div>
					  		</td>
					  		<td style="width: 30%; vertical-align: bottom;">
					  			<img src="<?=$usuario->caminhoLogo ?>" width="240px" height="120px"><br/>
					  			<label style="color: red;">tamanho ideal 300px por 150px</label>
					  		</td>
					  	</tr>
					  	</table>
					  		<input type="hidden" name="idUsuario" value="<?=$usuario->idUsuario ?>"></input>
					  		<input type="hidden" name="txtIdEndereco" value="<?=$endereco->idEndereco ?>" id="txtIdEndereco" >
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
<!-- Modal Endereco-->
	<div class="modal fade" id="endereco-modal" tabindex="-1" role="dialog" 
		aria-labelledby="modalLabel" style="margin-top: 80px;">
		<div class="modal-dialog modal-sm" role="document" style="width:800px;">
			<div class="modal-content">
				<form action="/sgi/controle/implUsuario.php"  method="POST" id="form2" class="form-horizontal" data-toggle="validator" role="form">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"
							aria-label="Fechar">
							<span aria-hidden="true">&times;</span>
						</button>
						<h4 class="modal-title" id="modalLabel">Endereco do Corretor</h4>
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
						      <input type="hidden" name="txtIdUsuario" id="txtIdUsuario">
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
									<input  required maxlength="200" minlength="1" type="text"  name="rua" value="<?=$endereco->rua ?>"
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
					    	<button type="submit" id="salvarEnd" name="salvarEnd" class="btn btn-success" value="Salvar">Salvar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>

					</div>
				</form>
			</div>
		</div>
	</div>	        
    </body>
</html>

<!-- 
<html>
<head>
    <meta charset="ISO-8859-1" http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<body> 

<?php
	echo '<h1>Ola Mundo!</h1><br/><br/>';
?>

<form action="#" method="post" enctype="multipart/form-data">
    <p>
        Upload a new photo to the server:<br/><br/><br/>
        <input type="file" name="fileUpload"/><br/><br/>
        <input type="submit" value="Upload photo"/>
    </p>
</form>

</body>
</head>
</html>

<?php
   if(isset($_FILES['fileUpload']))
   {
      //date_default_timezone_set("Brazil/East"); //Definindo timezone padrÃ£o
 
      $ext = strtolower(substr($_FILES['fileUpload']['name'],-4)); //Pegando extensÃ£o do arquivo
      $new_name = 'teste' . $ext; //Definindo um novo nome para o arquivo
      $env_var = getenv('OPENSHIFT_DATA_DIR') ."uploads/". $new_name;
      //$dir = 'uploads/'; //DiretÃ³rio para uploads
 
      //move_uploaded_file($_FILES['fileUpload']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
      move_uploaded_file($_FILES['fileUpload']['tmp_name'], $env_var); //Fazer upload do arquivo
      echo $env_var .'<br/>';
      echo ($_SERVER['REQUEST_URI']);
   }
   //$env_var = getenv('OPENSHIFT_DATA_DIR');
   
?>-->