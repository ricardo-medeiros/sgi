<?php
	require_once(__ROOT__.'/modelo/usuario.model.php');
	require_once(__ROOT__.'/dao/daoUsuario.php');

	class Usuario_Controle{	

		function salvarUsuario($usuario)
		{
			 $cpf = $usuario->cpf;
			 $daoUsuario = new daoUsuario();
			 $ok = $daoUsuario->salvarUsuario($usuario); 
			 
			 $idUsuario = $daoUsuario->getUsuarioCPF($cpf);
			 
			 if (!$ok)
			 {
				echo 'Erro ao Salvar Usuario';
			 }
			 else 
			 {
				//echo 'Cliente Salvo com Sucesso';
			 	header("Location: ../views/site/cadUsuario.php?tipo=UPD&idUsuario=".$idUsuario);
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 }
		}
			
		function getUsuario($idUsuario){
			$daoUsuario = new daoUsuario();
			$usuario = $daoUsuario->getUsuario($idUsuario);
		
			return $usuario;
		}
		
		function alterarUsuario($usuario){
			$daoUsuario = new daoUsuario();
			$idUsuario = $usuario->idUsuario;
			$ok = $daoUsuario->alterarUsuario($usuario);
		
			 if (!$ok)
			 {
				echo 'Erro ao Alterar Usuario';
			 }
			 else 
			 {
				//echo 'Cliente Salvo com Sucesso';
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 	header("Location: ../views/site/cadUsuario.php?tipo=UPD&idUsuario=".$idUsuario); 
			 }
		}
		
		function excluirUsuario($idUsuario){
			$daoUsuario = new daoUsuario();
			$ok = $daoUsuario->excluirUsuario($idUsuario);
			header("Location: ../views/site/usuario.php");
		}
		
		function efetuarLogin($login,$senha){
			$daoUsuario = new daoUsuario();
			$nome = $daoUsuario->efetuarLogin($login,$senha);
			return $nome;
		}
	}
?>
