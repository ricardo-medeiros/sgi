<?php

class Tipo_Desconto_Model{
	
	public $idTipoDesconto;
	public $descDesconto;
		
	public function setIdTipoDesconto($idTipoDesconto){
		$this->idTipoDesconto = $idTipoDesconto;
	}

	public function setDescDesconto($descDesconto){
		$this->descDesconto = $descDesconto;
	}
	
	public function getIdTipoDesconto(){
		return $this->idTipoDesconto;
	}

	public function getDescDesconto(){
		return $this->descDesconto;
	}
}

?>