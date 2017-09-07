<?php

class Contrato_Model{
	
	public $idContrato;
	public $tipo;             //Venda ou Locaзгo
	public $situacao;         //Vбlido ou Invбlido
	public $observacao;
	public $imovel;
	public $usuario;
	public $cliente;
	public $refContrato;      //gerar este numero. Este numero irб aparecer no contrato como um identificador, mas a chave principal й o ID.

	//datas
	public $dataContrato;     //Data de criaзгo do contrato
	public $dataVigencia;     //atй quando vai o contrato
	public $dataInicial;      //Data que inicia o contrato (Locaзгo)
	public $dataFinal;	      //Data que acaba o contrato (Locaзгo)
	public $dataEntrada;      //Data do valor de entrada
	public $dataReajuste;     //Data do reajuste da locaзгo.
	public $diaVencimento;    //dia do Vencimento da locaзгo.
	
	//testemunhas serб impressa no contrato
	public $cpfTest1;		  //Cpf da testemunha 1
	public $nomeTest1;	      //Nome Testemunha 1
	public $cpfTest2;		  //Cpf da testemunha 2
	public $nomeTest2;		  //Nome da Testemunha 2
	
	//valores
	public $multaAtraso;	  //Valor de multra por atraso (percentual)
	public $diasAtraso;		  //Cobrar multa apуs x dias de atraso
	public $multaMora;	      //Multa Mora (percenctual)
	public $diasMora;		  //Dias de Mora
	public $comissaoCorretor; //Comissгo do Corretor (percentual)
	public $valorProp;        //Valor para o Proprietario (serб sempre o valor da locaзгo menos a comissгo do corretor e possiveis descontos de melhorias)
	public $percReaj;		  //Percentual de quanto serб o reajuste;
	public $valorContrato;    //Locaзгo ou Venda.
	
	//tagHTML
	public $tagContrato;      // conteudo html do contrato e pode ser editado pelo usuario do sistema.
	//fiadores
	//public $fiador ;		  //Fiador do Imovel que estб sendo locado (pode ser mais de um fiador).
	

// 	public function __construct(){
// 		$this->fiador = new ArrayCollection();
		//$this->refContrato = refContrato + 1;
// 	}
	
	public function setIdContrato($idContrato){
		$this->idContrato = $idContrato;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}

	public function setSituacao($situacao){
		$this->situacao = $situacao;
	}

	public function setObservacao($observacao){
		$this->observacao = $observacao;
	}
		
	public function setDataContrato($dataContrato){
		$this->dataContrato = $dataContrato;
	}
	
	public function setImovel($imovel){
		$this->imovel = $imovel;
	}
		
	public function setCliente($cliente){
		$this->cliente = $cliente;	
	}
	
	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}
	
	public function setRefContrato($refContrato){
		$this->refContrato = $refContrato;
	}
	
	public function setDataVigencia($dataVigencia){
		$this->dataVigencia = $dataVigencia;
	}
	
	public function setDataInicial($dataInicial){
		$this->dataInicial = $dataInicial;
	}
	
	public function setDataFinal($dataFinal){
		$this->dataFinal = $dataFinal;
	}
	
	public function setDataEntrada($dataEntrada){
		$this->dataEntrada = $dataEntrada;
	}
	
	public function setDataReajuste($dataReajuste){
		$this->dataReajuste = $dataReajuste;
	}
	
	public function setDiaVencimento($diaVencimento){
		$this->diaVencimento = $diaVencimento;
	}
	
	public function setCpfTest1($cpfTest1){
		$this->cpfTest1 = $cpfTest1;
	}		  
	
	public function setNomeTest1($nomeTest1){
		$this->nomeTest1 = $nomeTest1;
	}	      
	
	public function setCpfTest2($cpfTest2){
		$this->cpfTest2 = $cpfTest2;
	}		  
	
	public function setNomeTest2($nomeTest2){
		$this->nomeTest2 = $nomeTest2;
	}		  
	
	public function setMultaAtraso($multaAtraso){
		$this->multaAtraso = $multaAtraso;
	}	 
	
	public function setDiasAtraso($diasAtraso){
		$this->diasAtraso = $diasAtraso;	
	}	
		 
	public function setMultaMora($multaMora){
		$this->multaMora = $multaMora;
	}	     
	
	public function setDiasMora($diasMora){
		$this->diasMora = $diasMora;
	}		 
	
	public function setComissaoCorretor($comissaoCorretor){
		$this->comissaoCorretor = $comissaoCorretor;
	}
	
	public function setValorProp($valorProp){
		$this->valorProp = $valorProp;	
	}   
	    
	public function setPerReaj($percReaj){
		$this->percReaj = $percReaj;	
	}	
		 
	public function setValorContrato($valorContrato){
		$this->valorContrato = $valorContrato;
	}  

	public function setTagContrato($tagContrato){
		$this->tagContrato = $tagContrato;
	}
	
// 	public function setFiador($fiador){
// 		$this->fiador = $fiador;
// 	}
	
	public function getIdContrato(){
		return $this->idContrato;
	}
	
	public function getImovel(){
		return $this->imovel;
	}

	public function getTipo(){
		return $this->tipo;
	}
	
	public function getObservacao(){
		return $this->observacao;
	}
	
	public function getSituacao(){
		return $this->situacao;
	}
	
	public function getDataContrato(){
		return $this->dataContrato;
	}
	
	public function getCliente(){
		return $this->cliente;
	}
	
	public function getUsuario(){
		return $this->usuario;
	}
	
	public function getRefContrato(){
		return $this->refContrato;
	}
	
	public function getDataVigencia(){
		return $this->dataVigencia;
	}
	
	public function getDataInicial(){
		return $this->dataInicial;
	}
	
	public function getDataFinal(){
		return $this->dataFinal;
	}
	
	public function getDataEntrada(){
		return $this->dataEntrada;
	}
	
	public function getDataReajuste(){
		return $this->dataReajuste;
	}
	
	public function getDiaVencimento(){
		return $this->diaVencimento;
	}
	
	public function getCpfTest1(){
		return $this->cpfTest1;
	}
	
	public function getNomeTest1(){
		return $this->nomeTest1;
	}
	
	public function getCpfTest2(){
		return $this->cpfTest2;
	}
	
	public function getNomeTest2(){
		return $this->nomeTest2;
	}
	
	public function getMultaAtraso(){
		return $this->multaAtraso;
	}
	
	public function getDiasAtraso(){
		return $this->diasAtraso;
	}
		
	public function getMultaMora(){
		return $this->multaMora;
	}
	
	public function getDiasMora(){
		return $this->diasMora;
	}
	
	public function getComissaoCorretor(){
		return $this->comissaoCorretor;
	}
	
	public function getValorProp(){
		return $this->valorProp;
	}
	 
	public function getPerReaj(){
		return $this->percReaj;
	}
		
	public function getValorContrato(){
		return $this->valorContrato;
	}
	
	public function getTagContrato(){
		return $this->tagContrato;
	}
// 	public function getFiador(){
// 		return $this->fiador;
// 	}
}

?>