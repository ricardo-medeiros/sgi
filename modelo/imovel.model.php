<?php

class Imovel_Model{
	
	public $idImovel;
	public $tipo;
	public $situacao;
	public $valor;
	public $status;
	public $observacao;
	public $endereco;
	public $usuario;
	public $proprietario;

	
	public function setIdImovel($idImovel){
		$this->idImovel = $idImovel;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}

	public function setSituacao($situacao){
		$this->situacao = $situacao;
	}
	
	public function setValor($valor){
		$this->valor = $valor;
	}
	
	public function setStatus($status){
		$this->status = $status;
	}

	public function setObservacao($observacao){
		$this->observacao = $observacao;
	}
		
	public function setProprietario($proprietario){
		$this->proprietario = $proprietario;
	}
		
	public function setEndereco($endereco){
		$this->endereco = $endereco;	
	}
	
	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}
	
	public function getIdImovel(){
		return $this->idImovel;
	}

	public function getTipo(){
		return $this->tipo;
	}
	
	public function getValor(){
		return $this->valor;
	}
	
	public function getStatus(){
		return $this->status;
	}
	
	public function getObservacao(){
		return $this->observacao;
	}
	
	public function getSituacao(){
		return $this->situacao;
	}
	
	public function getProprietario(){
		return $this->proprietario;
	}
	
	public function getEndereco(){
		return $this->endereco;
	}
	
	public function getUsuario(){
		return $this->usuario;
	}
}

?>