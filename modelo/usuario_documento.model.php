<?php

class Usuario_Documento_Model{
	
	public $usuario;
	public $idDocumento;
	public $documento;
	public $documentoPadrao;
	public $nome;
		
	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}
	
	public function setIdDocumento($idDocumento){
		$this->idDocumento = $idDocumento;
	}

	public function setDocumento($documento){
		$this->documento = $documento;
	}
	
	public function setDocumentoPadrao($documentoPadrao){
		$this->documentoPadrao = $documentoPadrao;
	}
	
	public function setNome($nome){
		$this->nome = $nome;
	}

	public function getUsuario(){
		return $this->usuario;
	}
	
	public function getDocumento(){
		return $this->documento;
	}
	
	public function getDocumentoPadrao(){
		return $this->documentoPadrao;
	}
	
	public function getIdDocumento(){
		return $this->idDocumento;
	}
	
	public function getNome(){
		return $this->nome;
	}
}

?>