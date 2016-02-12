<?php

class Cliente_Model{
	
	public $idCliente;
	public $cpf;
	public $nome;
	public $rg;
	public $dataNascimento;
	public $telefoneFixo;
	public $telefoneCelular;
	public $email;
	public $status;
	public $caminhoFoto;
	public $endereco;

	
	public function setIdCliente($idCliente){
		$this->idCliente = $idCliente;
	}

	public function setCpf($cpf){
		$this->cpf = $cpf;
	}

	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function setRg($rg){
		$this->rg = $rg;
	}
	
	public function setDataNascimento($dataNascimento){
		$this->dataNascimento = $dataNascimento;
	}
	
	public function setTelefoneFixo($telefoneFixo){
		$this->telefoneFixo = $telefoneFixo;
	}
	
	public function setTelefoneCelular($telefoneCelular){
		$this->telefoneCelular = $telefoneCelular;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
	
	public function setCaminhoFoto($caminhoFoto){
		$this->caminhoFoto = $caminhoFoto;
	}
	
	public function setEndereco($endereco){
		$this->endereco = $endereco;	
	}
	
	public function getIdCliente(){
		return $this->idCliente;
	}

	public function getCpf(){
		return $this->cpf;
	}
	
	public function getNome(){
		return $this->nome;
	}
	
	public function getRg(){
		return $this->rg;
	}
	
	public function getDataNascimento(){
		return $this->dataNascimento;
	}
	
	public function getTelefoneFixo(){
		return $this->telefoneFixo;
	}
	
	public function getTelefoneCelular(){
		return $this->telefoneCelular;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function getStatus(){
		return $this->status;
	}
	
	public function getCaminhoFoto(){
		return $this->caminhoFoto;
	}
	
	public function getEndereco(){
		return $this->endereco;
	}
}

?>