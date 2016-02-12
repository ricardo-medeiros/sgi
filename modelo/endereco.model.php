<?php

class Endereco_Model{
	
	public $idEndereco;
	public $rua;
	public $bairro;
	public $cidade;
	public $uf;
	public $cep;
	//public $cliente;
	//public $usuario;
	//public $proprietario;

	
	public function setIdEndereco($idEndereco){
		$this->idEndereco = $idEndereco;
	}

	public function setRua($rua){
		$this->rua = $rua;
	}

	public function setBairro($bairro){
		$this->bairro = $bairro;
	}
	
	public function setCidade($cidade){
		$this->cidade = $cidade;
	}
	
	public function setUf($uf){
		$this->uf = $uf;
	}
	
	public function setCep($cep){
		$this->cep = $cep;
	}
	
	/*public function setCliente($cliente){
		$this->cliente = $cliente;
	}
	
	public function setUsuario($usuario){
		$this->usuario = $usuario;
	}
	
	public function setProprietario($proprietario){
		$this->proprietario = $proprietario;
	}*/
	
	public function getIdEndereco(){
		return $this->idEndereco;
	}

	public function getRua(){
		return $this->rua;
	}
	
	public function getBairro(){
		return $this->bairro;
	}
	
	public function getCidade(){
		return $this->cidade;
	}
	
	public function getUf(){
		return $this->uf;
	}
	
	public function getCep(){
		return $this->cep;
	}
	/*
	public function getCliente(){
		return $this->cliente;
	}
	
	public function getUsuario(){
		return $this->usuario;
	}
	
	public function getProprietario(){
		return $this->proprietario;
	}*/
}

?>