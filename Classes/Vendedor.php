<?php

class Vendedor{
	private int $id;
    private string $nome;
    private string $email;
    private string $telefone;

	public function getNome(): string {
		return $this->nome;
	}
	
	public function setNome(string $nome): self {
		$this->nome = $nome;
		return $this;
	}
	

	public function getEmail(): string {
		return $this->email;
	}
	
	public function setEmail(string $email): self {
		$this->email = $email;
		return $this;
	}
	

	public function getTelefone(): string {
		return $this->telefone;
	}
	
	
	public function setTelefone(string $telefone): self {
		$this->telefone = $telefone;
		return $this;
	}

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}
	
	/**
	 * @param int $id 
	 * @return self
	 */
	public function setId(int $id): self {
		$this->id = $id;
		return $this;
	}
}