<?php

class Usuario_Model{
	
	public $idUsuario;
	public $cpf;
	public $nome;
	public $telefoneContato;
	public $login;
	public $senha;
	public $status;
	public $banco;
	public $agencia;
	public $conta;
	public $tipoConta; //poupança ou corrente
	public $numeroCRA;
	public $numeroCRECI;
	public $caminhoLogo;
	public $endereco;

	
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
	
	public function setBanco($banco){
		$this->banco = $banco;
	}
	
	public function setAgencia($agencia){
		$this->agencia = $agencia;
	}
	
	public function setTipoConta($tipoConta){
		$this->tipoConta = $tipoConta;
	}
	
	public function setNumeroCRA($numeroCRA){
		$this->numeroCRA = $numeroCRA;
	}
	
	public function setNumeroCRECI($numeroCRECI){
		$this->numeroCRECI = $numeroCRECI;
	}
	
	public function setConta($conta){
		$this->conta = $conta;
	}
	
	public function setCaminhoLogo($caminhoLogo){
		$this->caminhoLogo = $caminhoLogo;
	}
	
	public function setEndereco($endereco){
		$this->endereco = $endereco;
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
	
	public function getBanco(){
		return $this->banco;
	}
	
	public function getAgencia(){
		return $this->agencia;
	}
	
	public function getTipoConta(){
		return $this->tipoConta;
	}
	
	public function getNumeroCRA(){
		return $this->numeroCRA;
	}
	
	public function getNumeroCRECI(){
		return $this->numeroCRECI;
	}
	
	public function getConta(){
		return $this->conta;
	}
	
	public function getCaminhoLogo(){
		return $this->caminhoLogo;
	}
	
	public function getEndereco(){
		return $this->endereco;
	}
}

?>