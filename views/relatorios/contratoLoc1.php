<?php 
	define('__ROOT__',dirname(dirname(dirname(__FILE__))));
	require_once(__ROOT__.'/controle/acoes_contrato.controle.php');
	require_once(__ROOT__.'/controle/usuario.controle.php');
	require_once(__ROOT__.'/modelo/word.model.php');
	
	$controleUsuario = new Usuario_Controle();
	$usuario = $controleUsuario->getUsuario($_SESSION["USUARIO"]);
	
	$controleVO = new acoes_Contrato_Controle();
	$idContrato = $_GET["codContrato"];
	$contrato = $controleVO->getContrato($idContrato);
	
	//if ($contrato->tagContrato == '' or $contrato->tagContrato == null)
	//{
			$dataReajuste = $contrato->dataReajuste;
			$partes_data = explode('-', $dataReajuste);
			$dataFormatada= $partes_data[2] ."/". $partes_data[1] ."/". $partes_data[0];
				
			$cliente      = $controleVO->getCliente($contrato->cliente);
			$imovel       = $controleVO->getImovel($contrato->imovel);
			$proprietario = $controleVO->getProprietario($imovel->proprietario);
			$endCli       = $controleVO->getEndereco($cliente->endereco);
			$endImo       = $controleVO->getEndereco($imovel->endereco);
			$endPro       = $controleVO->getEndereco($proprietario->endereco);
			$estado       = $controleVO->getEstado($endCli->uf);
			$fiadores     = $controleVO->listaFiadores($contrato->idContrato);
			
			$logo = str_replace("..","", $usuario->caminhoLogo);
			
			//locahost
			$logo = "http://".$_SERVER["HTTP_HOST"]."/views". $logo;
			
			//produção
			//$logo = "http://".$_SERVER["HTTP_HOST"]."/views". $logo;
			
			$nome = '';
			foreach ((array)$fiadores as $fia) {
				$nome  = $nome . $fia->nome . " , ";
			}
		
		 	$table .= '
		 		<br/><br/>
		 		<table id="tbcab1" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th width="300px" style="text-align: left;" colspan="3">1 - PARTES CONTRATANTES:</th></tr>
		 		</table>
				<table id="tbcab2" width="100%" border="0" style="font-size: 12px;">
		 				<tr><th colspan="3"></th></tr>
		 				<tr><th colspan="3"></th></tr>
		 				<tr><th colspan="3"></th></tr>
		 				<tr><th colspan="3"></th></tr>
		 				<tr><th width="140px" style="text-align: left;">1.1 - LOCADOR(A):</th><th style="text-align: left;  font-weight: normal;" colspan="2">'.$proprietario->nome.'</th></tr>
		 				<tr><th width="140px" style="text-align: left;">1.2 - LOCAT&Aacute;RIO(A):</th><th style="text-align: left; font-weight: normal;" colspan="2" >'.$cliente->nome.'</th></tr>
		 				<tr><th width="140px" style="text-align: left;">1.3 - FIADOR(A):</th><th style="text-align: left;  font-weight: normal;" colspan="2">'.$nome.'</th></tr>		
		 	
		 	
				</table>
		 		<table id="tbcab3" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th width="320px" style="text-align: left;">1.4 - REPRESENTANTE LEGAL - ADMINISTRADOR:</th><th style="text-align: left;  font-weight: normal;">'.$usuario->nome.'</th></tr>
		 		</table>
		 		<br/><br/>
		 		<table id="tbcab4" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify;">LOCADOR(A):<font style="font-weight: normal;"> ' .$proprietario->nome . ' , portador do RG: ' .$proprietario->rg. ' e do CPF: ' . $proprietario->cpf . ' , residente e domiciliado a ' .$endPro->rua. ' - ' . $endPro->bairro. ' - ' .$endPro->cidade. ' - ' .$endPro->uf. ' - CEP:' .$endPro->cep. '</font></th></tr>
		 		</table>
		 		<br/><br/>
		 		<table id="tbcab5" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify;">LOCAT&Aacute;RIO(A):<font style="font-weight: normal;"> ' .$cliente->nome . ' , portador do RG: ' .$cliente->rg. ' e do CPF: ' . $cliente->cpf . ' , residente e domiciliado a ' .$endCli->rua. ' - ' . $endCli->bairro. ' - ' .$endCli->cidade. ' - ' .$endCli->uf. ' - CEP:' .$endCli->cep. '</font></th></tr>
		 		</table>
		 		<br/>
		 		<table id="tbcab6" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: normal;">O locat&aacute;rio como principal pagador das mensalidades do aluguel e demais obriga&ccedil;&otilde;es constantes 
		 					neste contrato, assina e se responsabiliza em pagar em dia todas as suas obriga&ccedil;&otilde;es locacionais vincendas, todos os impostos, e demais despesas 
		 					de contribui&ccedil;&otilde;es que incidem ou venham incidir sobre o im&oacute;vel, tais como o consumo de luz, &aacute;gua, IPTU, seguro contra 
		 					inc&ecirc;ndio, apresentando posteriormente ao administrador do im&oacute;vel a devolu&ccedil;&atilde;o das chaves ao <font style="font-weight: bold;">LOCADOR(a)</font>, 
		 					renunciando expressamente o benef&iacute;cio de ordem de que tratam os artigos 827 e 835 e seguintes do C&oacute;digo Civil Brasileiro.</th></tr>
		 		</table>	
		 		<br/><br/>
		 		<table id="tbcab7" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">PAR&Aacute;GRAFO &Uacute;NICO: O LOCAT&Aacute;RIO <font style="font-weight: normal;">e o(s) </font> FIADOR(ES) <font style="font-weight: normal;">outorgam  
		 					irrevog&aacute;vel m&uacute;tua e reciprocamente poderes para receber CITA&Ccedil;&Otilde;ES, NOTIFICA&Ccedil;&Otilde;ES ou INTIMA&Ccedil;&Otilde;ES que ser&atilde;o feitas  
		 					mediante correspond&ecirc;ncias </font> com aviso de recebimento, trantando-se de pessoa f&iacute;sica e jur&iacute;dica, tamb&eacute;m fax-s&iacute;mile, ou ainda, se necess&aacute;rio, pelas demais 
		 					formas previstas no C&oacute;digo de Processo Civil.</th></tr>
		 		</table>			
		 		<br/>
		 		<table id="tbcab8" width="100%" border="0" style="font-size: 12px;">
		 			<tr style="text-align: center;"><th style="text-decoration: underline;">I - OBJETO</th></tr>
		 		</table>
		 		<br/><br/>			
		 		<table id="tbcab9" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA PRIMEIRA: <font style="font-weight: normal;"> O objeto do presente contrato &eacute; a loca&ccedil;&atilde;o do im&oacute;vel localizado 
							na ' .$endImo->rua. ' - ' .$endImo->bairro. ' - ' .$endImo->cidade. ' - ' .$endImo->uf. ' - CEP:' .$endImo->cep. '</font>  
		 					</th></tr>
		 		</table>
				<br/>
		 		<table id="tbcab10" width="100%" border="0" style="font-size: 12px;">
		 			<tr style="text-align: center;"><th style="text-decoration: underline;">II - DESTINA&Ccedil;&Atilde;O </th></tr>
		 		</table>
				<br/><br/>			
		 		<table id="tbcab11" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA SEGUNDA: O LOCAT&Aacute;RIO <font style="font-weight: normal;">utilizar&aacute; o im&oacute;vel </font> <font style="text-decoration: underline; font-weight: bold;">EXCLUSIVAMENTE PARA FINS </font> <font style="font-weight: normal;">  
		 					do Sr(a) e seus familiares, destino que n&atilde;o poder&aacute; ser alterado sem o pr&eacute;vio consentimento por escrito do </font><font style="font-weight: bold;">LOCADOR,</font> <font style="font-weight: normal;"> sendo vedada qualquer cess&atilde;o, transfer&ecirc;ncia ou subloca&ccedil;&atilde;o, 
									ainda quando parcial e tempor&aacute;ria, gratuita ou onerosa.</font>  
		 					</th></tr>
		 		</table>
				<br/>
				<table id="tbcab12" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA TERCEIRA: <font style="font-weight: normal;"> Ser&aacute; equiparada a viola&ccedil;&atilde;o da Cl&aacute;usula anterior, qualquer situa&ccedil;&atilde;o de fato pela qual o </font> LOCAT&Aacute;RIO <font style="font-weight: normal;">deixe   
		 					de ocupar direta e integralmente o im&oacute;vel locado, em seu nome e conta pr&oacute;pria. </font>   
		 					</th></tr>
		 		</table>
				<br/>
		 		<table id="tbcab13" width="100%" border="0" style="font-size: 12px;">
		 			<tr style="text-align: center;"><th style="text-decoration: underline;">III - PRAZO</th></tr>
		 		</table>
				<br/>
				<table id="tbcab14" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA QUARTA: <font style="font-weight: normal;">A loca&ccedil;&atilde;o ser&aacute; pelo prazo determinado de meses, contando-se esse per&iacute;odo de</font> <font style="font-weight: bold;">  
		 					a terminar no dia, data em que o(a) locat&aacute;rio(a) obriga-se a restituir o im&oacute;vel completamente desocupado, </font> <font style="font-weight: bold;"> em conformidade com a LEI N<sup>0</sup> 8.245 (LEI DO INQUILINO) modificada pela Lei 12.112/2009. 
							</font>  
		 					</th></tr>
		 		</table>
				<br/><br/>		
				<table id="tbcab15" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA QUINTA: <font style="font-weight: normal;">Se o </font>LOCAT&Aacute;RIO <font style="font-weight: normal;">devolver o im&oacute;vel antes de transcorrido o prazo estabelecido na cl&aacute;usula anterior ou a rescis&atilde;o ocorrer por  
		 					inadimplemento de obriga&ccedil;&atilde;o aqui ajustada, pagar&aacute; uma multa contratual correspondente a 03 (tr&ecirc;s) meses de aluguel, sem preju&iacute;zo do integral cumprimento das demais san&ccedil;&otilde;es legais e contratuais.
							</font>  
		 					</th></tr>
		 		</table>
				<br/><br/>
				<table id="tbcab16" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">PAR&Aacute;GRAFO &Uacute;NICO: <font style="font-weight: normal;">O </font>LOCAT&Aacute;RIO, <font style="font-weight: normal;">ficar&aacute; dispensado da multa contratual se a devolu&ccedil;&atilde;o do im&oacute;vel decorrer de transfer&ecirc;ncia pelo 
		 					seu empregador para prestar servi&ccedil;os em, localidades diversas daquela do in&iacute;cio do contrato ou, se notificar por escrito ao LOCADOR ou seu representante legal, ap&oacute;s decorridos 12 (doze) meses de aluguel, com o prazo de no m&iacute;nimo 30 (trinta) dias de anteced&ecirc;ncia.
							</font>  
		 					</th></tr>
		 		</table>
				<br/><br/>		
				<table id="tbcab17" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA SEXTA: <font style="font-weight: normal;">Findo o prazo de loca&ccedil;&atilde;o estipulado na Cl&aacute;sula Quarta, se n&atilde;o ocorrer a hip&oacute;tese de rescis&atilde;o ou a da ren&uacute;ncia, o que neste &uacute;ltimo caso dever&aacute;  
		 					ocorrer mediante aviso por escrito de qualquer dos contratantes ao outro at&eacute; trinta (30) dias antes de se vencer cada per&iacute;odo contratual, prorrogar-se-&aacute; a loca&ccedil;&atilde;o, consoante a assinatura de um novo contrato, com garantia consoante deste contrato.
							</font>  
		 					</th></tr>
		 		</table>
				<br/><br/>
				<table id="tbcab18" width="100%" border="0" style="font-size: 12px;">
		 			<tr style="text-align: center;"><th style="text-decoration: underline;">IV - PRE&Ccedil;O</th></tr>
		 		</table>
				<br/><br/>
				<table id="tbcab19" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA S&Eacute;TIMA: <font style="font-weight: normal;">O valor do aluguel mensal &eacute; de R$ '. $contrato->valorContrato .' com </font><font style="font-weight: bold;">REAJUSTE ANUAL a partir de ' .$dataFormatada. '</font><font style="font-weight: normal;">  
		 					pelo &iacute;ndice IGPM, ou outro &iacute;ndice oficial determinado pelo governo que venha &agrave; substitu&iacute;-lo. Da&iacute; por diante, caso ocorra a hip&oacute;tese prevista na Cl&aacute;usula Sexta, ficar&aacute; sujeito a reajustamentos peri&oacute;dicos estabelecidos na legisla&ccedil;&atilde;o pertinente que estiver em vigor.
							</font>  
		 					</th></tr>
		 		</table>
				<br/><br/>
				<table id="tbcab20" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA OITAVA: <font style="font-weight: normal;">O aluguel dever&aacute; ser pago pontualmente at&eacute; o dia ' .$contrato->diaVencimento. ' de cada m&ecirc;s, diretamente na conta do Representante Legal - Administrador do referido Im&oacute;vel, no  
		 					<font style="font-weight: bold; text-decoration: underline;"> ' .$usuario->banco. ' - ag&ecirc;ncia: ' .$usuario->agencia. ' e conta '.$usuario->tipoConta.': ' .$usuario->conta. '</font> <font style="font-weight: normal;">de loca&ccedil;&atilde;o ajustada na cl&aacute;usula quarta deste instrumento, independente de cobran&ccedil;a, no domic&iacute;lio do administrador do im&oacute;vel, o <font style="font-weight: bold;"> Sr. '.$usuario->nome.', </font> 
							<font style="font-weight: normal;"> ou onde o(a) </font><font style="font-weight: bold;">LOCADOR(A) </font> <font style="font-weight: normal;">determinar, estendendo-se esse prazo para o primeiro dia &uacute;til seguinte, caso coincida com s&aacute;bado, domingo ou feriado. Ultrapassando o dia acima estipulado, o aluguel ser&aacute; acrescido de multa de '.$contrato->multaAtraso.'% ao m&ecirc;s a partir do primeiro dia &uacute;til do vencimento e mais '.$contrato->multaMora.'% de juros de mora, ao dia.
		 					</font>  
		 					</th></tr>
		 		</table>
		 		<br/><br/>
				<table id="tbcab21" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA NONA: <font style="font-weight: normal;"> Se o </font> <font style="font-weight: bold;">LOCADOR(A), </font> <font style="font-weight: normal;">ou seu representante legal, recusar o recebimento sem justa causa ou o </font><font style="font-weight: bold;">LOCAT&Aacute;RIO(A) </font><font style="font-weight: normal;"> tiver dificuldade em efetuar o pagamento das obriga&ccedil;&otilde;es contratuais, dever&aacute; este(a) promover o respectivo dep&oacute;sito   
		 					judicial at&eacute; o 5<sup>0</sup> (quinto) dia &uacute;til do m&ecirc;s subsequente ao vencido. N&atilde;o o fazendo, entender-se-&aacute; que ficou constitu&iacute;do em mora, para todos os efeitos legais, especialmente para a incid&ecirc;ncia das obriga&ccedil;&otilde;es adiante convencionadas.
		 					</font>  
		 					</th></tr>
		 		</table>
				<br/><br/>
				<table id="tbcab22" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA D&Eacute;CIMA: <font style="font-weight: normal;"> O aluguel ser&aacute; inteiramente l&iacute;quido ao(&agrave;) </font> <font style="font-weight: bold;">LOCADOR(A), </font> <font style="font-weight: normal;">respeitada a legisla&ccedil;&atilde;o sobre a renda, ocorrendo por conta exclusiva do(a)</font><font style="font-weight: bold;">LOCAT&Aacute;RIO(A):</font>   
		 					</font>  
		 					</th></tr>
		 		</table>		
				<br/>
				<table id="tbcab23" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">a) - <font style="font-weight: normal;"> Despesas de for&ccedil;a e luz, telefone, g&aacute;s e servi&ccedil;os semelhantes, al&eacute;m das despesas ordin&aacute;rias de condom&iacute;nio, se for o caso. Os comprovantes dos pagamentos dever&atilde;o ser entregues ao(&agrave;) </font> <font style="font-weight: bold;">LOCADOR(A), </font> <font style="font-weight: normal;">ou seu representante legal, junto com o pagamento do 
									aluguel vencido, no prazo da loca&ccedil;&atilde;o estipulado neste instrumento ou prov&aacute;vel prorroga&ccedil;&atilde;o; </font>     
		 					</th></tr>
		 		</table>
				<br/>
				<table id="tbcab24" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">b) - <font style="font-weight: normal;"> Pagamento do Imposto Predial e Territorial Urbano (IPTU), al&eacute;m das taxas municipais relativas ao im&oacute;vel locado. Os comprovantes dos pagamentos dever&atilde;o ser entregues ao(&agrave;) </font> <font style="font-weight: bold;">LOCADOR(A), </font> <font style="font-weight: normal;">ou seu representante legal, junto com o pagamento do 
									aluguel vencido, no prazo da loca&ccedil;&atilde;o estipulado neste instrumento ou prov&aacute;vel prorroga&ccedil;&atilde;o; </font>
		 					</th></tr>
		 		</table>
				<br/>
				<table id="tbcab25" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">c) - <font style="font-weight: normal;"> Satisfa&ccedil;&atilde;o de todas as exig&ecirc;ncias do poder p&uacute;blico, relativas ao im&oacute;vel locado. </font>
		 					</th></tr>
		 		</table>
				<br/><br/>
				<table id="tbcab26" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA D&Eacute;CIMA PRIMEIRA: <font style="font-weight: normal;"> Obriga-se o(a) </font> <font style="font-weight: bold;">LOCAT&Aacute;RIO(A) </font> <font style="font-weight: normal;">a remeter ao(&agrave;) <font style="font-weight: bold;">LOCADOR(A), </font> 
									 <font style="font-weight: normal;">ou seu representante legal, dentro das 24 (vinte e quatro) horas de seu recebimento, qualquer correspond&ecirc;ncia, intima&ccedil;&atilde;o ou notifica&ccedil;&atilde;o que lhe for dirigida sobre o im&oacute;vel locado, e, caso n&atilde;o o fa&ccedil;a, assume integralmente 
									todas as responsabilidades pelas obriga&ccedil;&otilde;es exigidas em tais interven&ccedil;&otilde;es e suas consequ&ecirc;ncias.</font>
		 					</th></tr>
		 		</table>	
				<br/><br/>
				<table id="tbcab27" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA D&Eacute;CIMA SEGUNDA: <font style="font-weight: normal;"> Obriga-se o(a) </font> <font style="font-weight: bold;">LOCAT&Aacute;RIO(A) </font> <font style="font-weight: normal;">a cumprir e assumir toda e qualquer responsabilidade com os danos causados a terceiros.</font> 
		 					</th></tr>
		 		</table>	
				<br/><br/>
				<table id="tbcab27" width="100%" border="0" style="font-size: 12px;">
		 			<tr style="text-align: center;"><th style="text-decoration: underline;">V - CONSERVA&Ccedil;&Atilde;O</th></tr>
		 		</table>
				<br/><br/>
				<table id="tbcab28" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA D&Eacute;CIMA TERCEIRA: <font style="font-weight: normal;"> Obriga-se o(a) </font> <font style="font-weight: bold;">LOCAT&Aacute;RIO(A) </font> <font style="font-weight: normal;">a devolver o im&oacute;vel em perfeito estado de conserva&ccedil;&atilde;o, principalmente na pintura geral do im&oacute;vel, de 
									acordo com o Laudo de Vistoria em anexo, que passa a fazer parte integralmente deste Contrato.</font> 
		 					</th></tr>
		 		</table>
				<br/><br/>
				<table id="tbcab28" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA D&Eacute;CIMA QUARTA: <font style="font-weight: normal;"> O(A) </font> <font style="font-weight: bold;">LOCAT&Aacute;RIO(A) </font> <font style="font-weight: normal;">satisfar&aacute; &agrave; pr&oacute;pria custa, com solidez e perfei&ccedil;&atilde;o, todos os reparos e consertos de que necessite ou venha 
									a necessitar o im&oacute;vel locado, satisfazendo, nesse sentido, todas e quaisquer exig&ecirc;ncias das autoridades p&uacute;blicas. 
									</font> 
		 					</th></tr>
		 		</table>		
				<br/><br/>
				<table id="tbcab29" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA D&Eacute;CIMA QUINTA: <font style="font-weight: normal;"> O(A) </font> <font style="font-weight: bold;">LOCAT&Aacute;RIO(A) </font> <font style="font-weight: normal;">ser&aacute; respons&aacute;vel pelos danos causados ao im&oacute;vel pelo mau trato ou por aqueles que resultarem para os vizinhos do mau uso  
									 do im&oacute;vel locado, n&atilde;o se prejudicando, durante os respectivos reparos, a continuidade deste contrato, em todos os seus efeitos.
									</font> 
		 					</th></tr>
		 		</table>	
				<br/><br/>
				<table id="tbcab30" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA D&Eacute;CIMA SEXTA: <font style="font-weight: normal;"> O(A) </font> <font style="font-weight: bold;">LOCADOR(A) </font> <font style="font-weight: normal;">ou seu representante legal, poder&aacute; inspecionar o im&oacute;vel, pessoalmente, ou atrav&eacute;s de representantes, sendo tal vistoria imprescind&iacute;vel   
									 antes da restitui&ccedil;&atilde;o, a fim de verificar a fiel observ&acirc;ncia das obriga&ccedil;&otilde;es assumidas pelo(a)</font> <font style="font-weight: bold;"> LOCAT&Aacute;RIO(A) </font><font style="font-weight: normal;"> neste contrato, o(a) qual n&atilde;o poder&aacute;, sob pretexto algum, fazer oposi&ccedil;&atilde;o a esse direito.
									</font> 
		 					</th></tr>
		 		</table>
				<br/><br/>
				<table id="tbcab31" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA D&Eacute;CIMA S&Eacute;TIMA: <font style="font-weight: normal;"> As benfeitorias ou acess&otilde;es que vierem a ser introduzidas, de qualquer natureza, aderir&atilde;o automaticamente ao im&oacute;vel locado, integrando a plena propriedade do(a) </font> <font style="font-weight: bold;">LOCADOR(A). </font> 
									<font style="font-weight: normal;">O consentimento escrito do </font> <font style="font-weight: bold;"> LOCADOR(A), </font><font style="font-weight: normal;">ou representante legal, todavia, </font><font style="font-weight: bold; text-decoration: underline;">ser&aacute; imprescind&iacute;vel.</font><font style="font-weight: normal;"> O </font>   
									<font style="font-weight: bold;">LOCAT&Aacute;RIO(A) </font><font style="font-weight: normal;">renuncia desde logo, irrevogavelmente, a todo direito de indeniza&ccedil;&atilde;o, compensa&ccedil;&atilde;o ou reten&ccedil;&atilde;o, relativo aos valores despedidos.
									</font> 
		 					</th></tr>
		 		</table>	
				<br/><br/>
				<table id="tbcab32" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA D&Eacute;CIMA OITAVA: <font style="font-weight: normal;"> As adapta&ccedil;&otilde;es que se fizerem necess&aacute;rias &agrave; instala&ccedil;&atilde;o de aparelhos eletrodom&eacute;sticos, inclusive ar-condicionado, e que prescindam de mutilar o im&oacute;vel, poder&atilde;o ser efetuados mediante pr&eacute;vio  
									consentimento do(a) </font><font style="font-weight: bold;"> LOCADOR(A), </font><font style="font-weight: normal;">ou seu representante legal, sempre por escrito.   
									</font> 
		 					</th></tr>
		 		</table>	
				<br/><br/>
				<table id="tbcab33" width="100%" border="0" style="font-size: 12px;">
		 			<tr style="text-align: center;"><th style="text-decoration: underline;">VI - SAN&Ccedil;&Otilde;ES</th></tr>
		 		</table>																			
				<br/><br/>
				<table id="tbcab34" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA D&Eacute;CIMA NONA: <font style="font-weight: normal;"> Ao inadimplemento total ou parcial de qualquer das obriga&ccedil;&otilde;es deste contrato, ser&atilde;o aplicadas cumulativamente ou alternativamente, a ju&iacute;zo do(a)  
									</font><font style="font-weight: bold;"> LOCADOR(A), </font><font style="font-weight: normal;">ou seu representante legal, as seguintes san&ccedil;&otilde;es:      
									</font> 
		 					</th></tr>
		 		</table>	
				<br/>
				<table id="tbcab35" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">a) - <font style="font-weight: normal;"> Rescis&atilde;o contratual autom&aacute;tica, independentemente de interpela&ccedil;&atilde;o judicial ou extrajudicial, n&atilde;o significando a toler&acirc;ncia de qualquer infra&ccedil;&atilde;o como ren&uacute;ncia deste direito, caso a mesma se repita ou se prolongue, com exig&ecirc;ncia das obriga&ccedil;&otilde;es  
									financeiras totais previstas neste contrato, por antecipa&ccedil;&atilde;o; </font>
		 					</th></tr>
		 		</table>	
				<br/>
				<table id="tbcab36" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">b) - <font style="font-weight: normal;"> Multa penal igual ao valor do dano, em se tratando de desconserva&ccedil;&atilde;o do im&oacute;vel e suas benfeitorias; </font>
		 					</th></tr>
		 		</table>	
				<br/>
				<table id="tbcab37" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">c) - <font style="font-weight: normal;"> Perdas e danos que se apurarem, incluindo custos processuais; </font>
		 					</th></tr>
		 		</table>		
				<br/>
				<table id="tbcab38" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">d) - <font style="font-weight: normal;"> Pagamentos dos honor&aacute;rios dos advogados e peritos do(a) </font><font style="font-weight: bold;"> LOCADOR(A), </font><font style="font-weight: normal;"> ou seu representante legal, desde j&aacute; fixado em 20% (vinte por cento) se for litigioso e 10% (dez por cento) se for amig&aacute;vel. </font>
		 					</th></tr>
		 		</table>	
				<br/><br/>		
				<table id="tbcab39" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: justify; font-weight: bold;">CL&Aacute;USULA VIG&Eacute;SIMA: <font style="font-weight: normal;">As partes contratantes elegem o Foro da Comarca da capital do Estado do(a) </font> <font style="font-weight: bold;">'.$estado.' </font><font style="font-weight: normal;">, para dirimir quaisquer d&uacute;vidas oriundas deste Contrato, renunciando a qualquer outro, por mais privilegiado que seja.
		 					<br/><br/>
		 					E por estarem justos e contratados, assinam o presente contrato em 03 (tr&ecirc;s) vias de igual teor e forma, na presen&ccedil;a de 02 (duas) testemunhas que tamb&eacute;m assinam, elegendo o Foro da Comarca da capital do Estado do(a)</font> <font style="font-weight: bold;"> '.$estado.' </font><font style="font-weight: normal;">, para qualquer a&ccedil;&atilde;o oriunda deste contrato.
							</font>  
		 					</th></tr>
		 		</table>	
		 		<br/><br/><br/><br/>
		 		<table id="tbcab40" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: right; font-weight: normal;">________________________________,______ de ____________________ de 20______.
		 					</th></tr>
		 		</table>
				<br/><br/><br/><br/> 	
				<table id="tbcab41" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: center; font-weight: normal;">
		 					___________________________________________________________					  
		 					</th>
		 			</tr>
					<tr><th style="text-align: center; font-weight: normal;">
		 					LOCAT&Aacute;RIO(A)	CPF: '.$cliente->cpf.' / RG: '.$cliente->rg.'				  
		 					</th>
		 			</tr>
		 		</table> 							
		 		<br/><br/><br/><br/>	
		 		<table id="tbcab41" width="100%" border="0" style="font-size: 12px;">
		 			<tr><th style="text-align: center; font-weight: normal;">
		 					___________________________________________________________  
		 					</th>
		 			</tr>
		 			<tr><th style="text-align: center; font-weight: normal;">
		 					LOCADOR(A) CPF: '.$proprietario->cpf.' / RG: '.$proprietario->rg.'
		 					</th>
		 			</tr> 		
		 		</table>
		 		<br/><br/><br/><br/>
				<table id="tbcab41" width="100%" border="0" style="font-size: 12px;"> 								
					<tr><th style="text-align: center; font-weight: normal;">
		 					___________________________________________________________  
		 					</th>
		 			</tr> 							
		 			<tr><th style="text-align: center; font-weight: normal;">
		 					'.$usuario->nome.'
		 					</th>
		 			</tr> 
		 			<tr><th style="text-align: center; font-weight: normal;">
		 					'.$usuario->numeroCRA.' / '.$usuario->numeroCRECI.' 
		 					</th>
		 			</tr> 							
		 		</table> 
				<br/><br/><br/><br/><br/> 	
				<table id="tbcab41" width="100%" border="0" style="font-size: 12px;" align="left">
		 			<tr><th style="text-align: left; font-weight: normal;">
		 					TESTEMUNHAS:					  
		 					</th>
		 			</tr>
		 		</table>
		 		<br/><br/><br/>	
		 		<table id="tbcab42" width="100%" border="0" style="font-size: 12px;" align="center"> 							
		 			<tr><th style="text-align: center; font-weight: normal;">
		 					_________________________________________________  
		 					</th>
		 				<th style="text-align: center; font-weight: normal;">
		 					_________________________________________________  
		 					</th>
		 			</tr>
		 			<tr><th style="text-align: center; font-weight: normal;">
		 					'.$contrato->nomeTest1.' <br/>
		 					CPF: '.$contrato->cpfTest1.' 
		 					</th>
							<th style="text-align: center; font-weight: normal;">
		 					'.$contrato->nomeTest2.' <br/>
		 					CPF: '.$contrato->cpfTest2.' 
		 					</th> 							
		 			</tr> 									
		 		</table></html>		 																				
				'; 	 	
		$html = '<html><head><meta http-equiv="content-type" content="text/html; charset=UTF-8"></head>
		<table width="100%" border = "0">
				<tr>
					
					<td style="padding-left: 200px; vertical-align: bottom;">
						<h5>
							<a name="top"></a>CONTRATO DE LOCA&Ccedil;&Atilde;O RESIDENCIAL 
						</h5>		
					</td>
				</tr>
		</table>
		<hr>'
		.$table.''; 
	//}
	//else {
	//	$html = $contrato->tagContrato;
	//}
	//gravar HTML no banco
	//$controleVO->salvarHTML($idContrato, $html);
	
	include ('../MPDF57/mpdf.php'); 
	$mpdf = new mPDF (); 
	$cabecalho = '<div><img src="'.$logo.'" border="0" width="120" height="60" /></div>';	
	$mpdf->SetHTMLHeader($cabecalho);
	$mpdf->AddPage('','','','','',20,20,25,10,5,0);
	$mpdf->ignore_invalid_utf8 = true;
	$mpdf->charset_in='iso-8859-1';	
	$mpdf->WriteHTML ( $html ); 
	$mpdf->Output (); 
	exit (); 
	//new Word($html);
?>
<!-- 
<html>
<body>
<textarea rows="100" cols="100"><?=$html;?></textarea>
</body>
</html>
 -->  
