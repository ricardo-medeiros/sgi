<?php

class Usuario_Model{
	
	public $idUsuario;
	public $cpf;
	public $nome;
	public $telefoneContato;
	public $login;
	public $senha;
	public $status;
	public $caminhoLogo;

	
	public function setIdUsuario($idUsuario){
		$this->idUsuario = $idUsuario;
	}

	public function setCpf($cpf){
		$this->cpf = $cpf;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function setTelefoneContato($telefoneContato){
		$this->telefoneContato = $telefoneContato;
	}
	
	public function setLogin($login){
		$this->login = $login;
	}
	
	public function setSenha($senha){
		$this->senha = $senha;
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
	
	public function setCaminhoLogo($caminhoLogo){
		$this->caminhoLogo = $caminhoLogo;
	}
	
	public function getIdUsuario(){
		return $this->idUsuario;
	}

	public function getCpf(){
		return $this->cpf;
	}
	
	public function getNome(){
		return $this->nome;
	}
		
	public function getTelefoneContato(){
		return $this->telefoneContato;
	}
	
	public function getLogin(){
		return $this->login;
	}
	
	public function getSenha(){
		return $this->senha;
	}
	
	public function getStatus(){
		return $this->status;
	}
	
	public function getCaminhoLogo(){
		return $this->caminhoLogo;
	}
}

?>