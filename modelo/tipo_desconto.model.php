<?php

class Tipo_Desconto_Model{
	
	public $idTipoDesconto;
	public $descDesconto;
	public $tipo; // Credito ou Débito
		
	public function setIdTipoDesconto($idTipoDesconto){
		$this->idTipoDesconto = $idTipoDesconto;
	}

	public function setDescDesconto($descDesconto){
		$this->descDesconto = $descDesconto;
	}
	
	public function setTipo($tipo){
		$this->tipo = $tipo;
	}
	
	public function getIdTipoDesconto(){
		return $this->idTipoDesconto;
	}

	public function getDescDesconto(){
		return $this->descDesconto;
	}
	
	public function getTipo(){
		return $this->tipo;
	}
}

?>