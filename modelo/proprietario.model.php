<?php

class Proprietario_Model{
	
	public $idProprietario;
	public $cpf; //cpf ou cnpj
	public $rg;
	public $nome;
	public $telefoneContato;
	public $email;
	public $usuario;
	public $endereco;
		
	public function setIdProprietario($idProprietario){
		$this->idProprietario = $idProprietario;
	}

	public function setCpf($cpf){
		$this->cpf = $cpf;
	}
	
	public function setRg($rg){
		$this->rg = $rg;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function setTelefoneContato($telefoneContato){
		$this->telefoneContato = $telefoneContato;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function setUsuario($usuario){
		$this->usuario = $usuario;	
	}
	
	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}
	
	public function getIdProprietario(){
		return $this->idProprietario;
	}

	public function getCpf(){
		return $this->cpf;
	}
	
	public function getRg(){
		return $this->rg;
	}
	
	public function getNome(){
		return $this->nome;
	}
		
	public function getTelefoneContato(){
		return $this->telefoneContato;
	}
	
	public function getEmail(){
		return $this->email;
	}	
	
	public function getUsuario(){
		return $this->usuario;
	}
	
	public function getEndereco(){
		return $this->enderecp;
	}
}

?>