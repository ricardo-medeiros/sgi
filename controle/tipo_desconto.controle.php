<?php
	require_once(__ROOT__.'/modelo/tipo_desconto.model.php');
	require_once(__ROOT__.'/dao/daoTipoDesconto.php');

	
	class Tipo_Desconto_Controle{	

		function salvarTipoDesconto($tipoDesconto)
		{
			 $daoTipoDesconto = new daoTipoDesconto();
			 $idTipoDesconto = $daoTipoDesconto->salvarTipoDesconto($tipoDesconto); 
			 
			 $tipo   = base64_encode('UPD');
			 $codigo = base64_encode($idTipoDesconto);
			 
			 if ($idTipoDesconto == 0)
			 {
				echo 'Erro ao Salvar Tipo de Desconto';
			 }
			 else 
			 {
			 	header("Location: ../views/site/cadTipoDesconto.php?tipo=".$tipo."&idTipoDesconto=".$codigo);
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 }
		}

		function listaTipoDesconto(){
			$daoTipoDesconto = new daoTipoDesconto();
			$lista = $daoTipoDesconto->listaTipoDesconto(); 
			return $lista;
		}
		
		function getTipoDesconto($idTipoDesconto){
			$daoTipoDesconto = new daoTipoDesconto();
			$tipoDesconto = $daoTipoDesconto->getTipoDesconto($idTipoDesconto);
			return $tipoDesconto;
		}

		function alterarTipoDesconto($tipoDesconto){
			$daoTipoDesconto = new daoTipoDesconto();
			$idTipoDesconto = $tipoDesconto->idTipoDesconto;

			$ok = $daoTipoDesconto->alterarTipoDesconto($tipoDesconto);
		
			$tipo   = base64_encode('UPD');
			$codigo = base64_encode($idTipoDesconto);
			
			 if (!$ok)
			 {
				echo 'Erro ao Alterar Tipo de Desconto';
			 }
			 else 
			 {
				//echo "<script language='JavaScript'> window.parent.document.getElementById('resultado').innerHTML = 'Cliente Salvo com Sucesso';</script>";
			 	header("Location: ../views/site/cadTipoDesconto.php?tipo=".$tipo."&idTipoDesconto=".$codigo); 
			 }
		}
		
		function excluirTipoDesconto($idTipoDesconto){
			$daoTipoDesconto = new daoTipoDesconto();
			$ok = $daoTipoDesconto->excluirTipoDesconto($idTipoDesconto);
			header("Location: ../views/site/tipodesconto.php");
		}
	}
?>
