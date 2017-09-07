<?php

class Fiador_Contrato_Model{
	
	public $contrato;
	public $fiador;
		
	public function setContrato($contrato){
		$this->contrato = $contrato;
	}

	public function setFiador($fiador){
		$this->fiador = $fiador;
	}

	public function getContrato(){
		return $this->contrato;
	}
	
	public function getFiador(){
		return $this->fiador;
	}
}

?>