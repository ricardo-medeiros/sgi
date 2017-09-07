<?php
	require_once(__ROOT__.'/modelo/usuario.model.php');
	require_once(__ROOT__.'/modelo/usuario_documento.model.php');
	require_once(__ROOT__.'/dao/daoUsuario.php');

	class Usuario_Controle{	

		function salvarUsuario($usuario)
		{
			 $cpf = $usuario->cpf;
			 $daoUsuario = new daoUsuario();
			 $ok = $daoUsuario->salvarUsuario($usuario); 
			 
			 $idUsuario = $daoUsuario->getUsuarioCPF($cpf);
			 $tipo   = base64_encode('UPD');
			 $codigo = base64_encode($idUsuario);
			 
			 if (!$ok)
			 {
				echo 'Erro ao Salvar Usuario';
			 }
			 else 
			 {
				//echo 'Cliente Salvo com Sucesso';
			 	header("Location: ../views/site/usuario.php?tipo=".$tipo."&usuario=".$codigo);
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 }
		}
			
		function getUsuario($idUsuario){
			$daoUsuario = new daoUsuario();
			$usuario = $daoUsuario->getUsuario($idUsuario);
		
			return $usuario;
		}
		
		function listaDocsUsuario($idUsuario){
			$daoUsuario = new daoUsuario();
			$lista = $daoUsuario->listaDocumetoUsuario($idUsuario);
		
			return $lista;
		}
		
		function getDocumentoUsuario($idUsuario,$idDocumento){
			$daoUsuario = new daoUsuario();
			$usuario_documento = $daoUsuario->getDocumetoUsuario($idUsuario, $idDocumento);
		
			return $usuario_documento;
		}
		
		function getDocumentoUsuarioPorNome($idUsuario,$nomeDocumento){
			$daoUsuario = new daoUsuario();
			$usuario_documento = $daoUsuario->getDocumetoUsuarioPorNome($idUsuario, $nomeDocumento);
		
			return $usuario_documento;
		}
		
		function alterarUsuario($usuario,$idEndereco){
			$daoUsuario = new daoUsuario();
			$idUsuario = $usuario->idUsuario;
			$ok = $daoUsuario->alterarUsuario($usuario,$idEndereco);
		
			 $tipo   = base64_encode('UPD');
			 $codigo = base64_encode($idUsuario);
			
			 if (!$ok)
			 {
				echo 'Erro ao Alterar Usuario';
			 }
			 else 
			 {
				//echo 'Cliente Salvo com Sucesso';
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 	header("Location: ../views/site/usuario.php?tipo=".$tipo."&usuario=".$codigo); 
			 }
		}
		
		function salvarEndUsuario($idUsuario,$endereco)
		{
			echo $idUsuario;
			$daoUsuario = new daoUsuario();
			$ok =  false;
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idUsuario);
						
			if ($endereco->idEndereco > 0){
				$ok = $daoUsuario->alterarEndUsuario($idUsuario,$endereco);
			}
			else {
				$idEndereco = $daoUsuario->salvarEndUsuario($idUsuario,$endereco);
				$usuario = $daoUsuario->getUsuario($idUsuario);
				$ok = $daoUsuario->alterarUsuario($usuario,$idEndereco);
			}
				
			if (!$ok)
			{
				echo 'Erro ao Alterar Usuario';
			}
			else
			{
				//echo 'Cliente Salvo com Sucesso';
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
				header("Location: ../views/site/usuario.php?tipo=".$tipo."&usuario=".$codigo); 
			}
				
		}
		
		function excluirUsuario($idUsuario){
			$daoUsuario = new daoUsuario();
			$ok = $daoUsuario->excluirUsuario($idUsuario);
			header("Location: ../views/site/usuario.php");
		}
		
		function efetuarLogin($login,$senha){
			$daoUsuario = new daoUsuario();
			$usuario = $daoUsuario->efetuarLogin($login,$senha);
			return $usuario;
		}
		
		function getEndUsuario($usuario){
			$daoUsuario = new daoUsuario();
			$endereco = $daoUsuario->getEndUsuario($usuario);
		
			return $endereco;
		}
		
		function salvarHTML($idDocumento,$idUsuario,$html){
			$daoUsuario = new daoUsuario();
			$codUsuario = base64_decode($idUsuario);
			$usuario_documento = $daoUsuario->getDocumetoUsuario($codUsuario, $idDocumento);
			$usuario_documento->documento = str_replace("&gt;",">",$html);
			$daoUsuario->alterarDocumentoUsuario($usuario_documento);
			header("Location: ../views/site/editarDocumento.php?idDocumento=$idDocumento&idUsuario=$codUsuario");
// 			echo '<script type="text/javascript">';
// 			echo 'function Fechar(){';
// 			echo 'window.location.href = "../views/site/editarDocumento.php?idDocumento='.$idDocumento.'&idUsuario='.$codUsuario.'";}';
// 			echo '</script>';
				
// 			echo '<link rel="stylesheet"	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">';
// 			echo "<h4 style='color:red; text-align:center; font-weight: bold;'>Documento de Contrato Atualizado!</h4>";
// 			echo '<center><button type="button" id="voltar" name="voltar" class="btn btn-success" value="Voltar" onClick="Fechar()">Voltar</button></center>';
		}
		
		function restaurarHTML($idDocumento,$idUsuario){
			$daoUsuario = new daoUsuario();
			$codUsuario = $idUsuario;
			$usuario_documento = $daoUsuario->getDocumetoUsuario($codUsuario, $idDocumento);
			$daoUsuario->restaurarDocumentoUsuario($usuario_documento);
			header("Location: ../views/site/editarDocumento.php?idDocumento=$idDocumento&idUsuario=$codUsuario");
		}
		
		function getEstados(){
				
			$estados = array();
			$estados["idEstado"]   = array('#','AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MS','MT','MG',
					'PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO');
			$estados["nomeEstado"] = array('Selecione','Acre','Alagoas','Amapa','Amazonas','Bahia','Ceara','Distrito Federal',
					'Espirito Santo','Goias','Maranhao','Mato Grosso do Sul','Mato Grosso','Minas Gerais','Para','Paraiba','Parana',
					'Pernambuco','Piaui','Rio de Janeiro','Rio Grande do Norte','Rio Grande do Sul','Rondonia','Roraima',
					'Santa Catarina','Sao Paulo','Sergipe','Tocantins');
			return $estados;
		}		
	}
?>
