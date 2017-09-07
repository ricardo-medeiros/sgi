<?php
	require_once(__ROOT__.'/modelo/contrato.model.php');
	require_once(__ROOT__.'/modelo/imovel.model.php');
	require_once(__ROOT__.'/modelo/cliente.model.php');
	require_once(__ROOT__.'/modelo/endereco.model.php');
	require_once(__ROOT__.'/modelo/proprietario.model.php');
	require_once(__ROOT__.'/modelo/fiador.model.php');
	require_once(__ROOT__.'/dao/acoesContratoVO.php');

	
	class acoes_Contrato_Controle{	
		
		function listaContrato(){
			$acoes_contratoVO = new acoescontratoVO();
			$lista = $acoes_contratoVO->listaContrato(); 
			return $lista;
		}
		
		function listaImoveis(){
			$acoes_contratoVO = new acoescontratoVO();
			$lista = $acoes_contratoVO->listaImovel();
			return $lista;
		}
		
		function listaClientes(){
			$acoes_contratoVO = new acoescontratoVO();
			$lista = $acoes_contratoVO->listaCliente();
			return $lista;
		}
		
		function listaFiadores($idContrato){
			$acoes_contratoVO = new acoescontratoVO();
			$lista = $acoes_contratoVO->listaFiadorContrato($idContrato);
			return $lista;
		}
		
		function getCliente($idCliente){
			$cliente = new Cliente_Model();
			if ($idCliente > 0)
			{
				$acoes_contratoVO = new acoescontratoVO();
				$cliente = $acoes_contratoVO->getCliente($idCliente);
			}
			return $cliente;
		}
		
		function getImovel($idImovel){
			$imovel = new Imovel_Model();
			if ($idImovel > 0){
				$acoes_contratoVO = new acoescontratoVO();
				$imovel = $acoes_contratoVO->getImovel($idImovel);
			}
			return $imovel;
		}
		
		function getContrato($idContrato){
			if($idContrato > 0)
			{
				$acoes_contratoVO = new acoescontratoVO();
				$contrato = $acoes_contratoVO->getContrato($idContrato);
			}
			return $contrato;
		}
			
		function getProprietario($idProprietario){
			if($idProprietario > 0)
			{
				$acoes_contratoVO = new acoescontratoVO();
				$proprietario = $acoes_contratoVO->getProprietario($idProprietario);
			}
			return $proprietario;
		}
		
		function getEndereco($idEndereco){
			if($idEndereco > 0)
			{
				$acoes_contratoVO = new acoescontratoVO();
				$endereco = $acoes_contratoVO->getEndereco($idEndereco);
			}
			return $endereco;
		}
		
		function salvarHTML($idContrato,$html){
			$acoes_contratoVO = new acoescontratoVO();
			$acoes_contratoVO->guardarHTML($idContrato, $html);
		}
		
		function getEstado($sigla){
			switch ($sigla)
			{
				case 'AC':
					$estado = 'Acre';
					break;
				case 'AL':
					$estado = 'Alagoas';
					break;
				case 'AP':
					$estado = 'Amap&aacute;';
					break;
				case 'AM':
					$estado = 'Amazonas';
					break;						
				case 'BA':
					$estado = 'Bahia';
					break;
				case 'CE':
					$estado = 'Cear&aacute;';
					break;
				case 'DF':
					$estado = 'Distrito Federal';
					break;
				case 'ES':
					$estado = 'Esp&iacute;rito Santo';
					break;
				case 'GO':
					$estado = 'Goi&aacute;s';
					break;
				case 'MA':
					$estado = 'Maranh&atilde;o';
					break;
				case 'MS':
					$estado = 'Mato Grosso do Sul';
					break;					
				case 'MT':
					$estado = 'Mato Grosso';
					break;
				case 'MG':
					$estado = 'Minas Gerais';
					break;
				case 'PA':
					$estado = 'Par&aacute;';
					break;
				case 'PB':
					$estado = 'Para&iacute;ba';
					break;
				case 'PR':
					$estado = 'Paran&aacute;';
					break;
				case 'PE':
					$estado = 'Pernambuco';
					break;
				case 'PI':
					$estado = 'Piau&iacute;';
					break;
				case 'RJ':
					$estado = 'Rio de Janeiro';
					break;
				case 'RN':
					$estado = 'Rio Grande do Norte';
					break;
				case 'RS':
					$estado = 'Rio Grande do Sul';
					break;
				case 'RO':
					$estado = 'Rond&ocirc;nia';
					break;
				case 'RR':
					$estado = 'Roraima';
					break;
				case 'SC':
					$estado = 'Santa Catarina';
					break;
				case 'SP':
					$estado = 'S&atilde;o Paulo';
					break;
				case 'SE':
					$estado = 'Sergipe';
					break;
				case 'TO':
					$estado = 'Tocantins';
					break;
			}
			return $estado;
		}
	}
?>
