<?php

class Carro{

	private int $id;
    private string $marca;
    private string $modelo;
    private string $cor;
    private string $anoFabricacao;
    private string $anoModelo;
    private string $combustivel;
    private float $preco;
    private string $detalhes;
    private string $foto;


	public function getMarca(): string {
		return $this->marca;
	}
	

	public function setMarca(string $marca): self {
		$this->marca = $marca;
		return $this;
	}
	
	public function getModelo(): string {
		return $this->modelo;
	}

	public function setModelo(string $modelo): self {
		$this->modelo = $modelo;
		return $this;
	}
	
	public function getCor(): string {
		return $this->cor;
	}

	public function setCor(string $cor): self {
		$this->cor = $cor;
		return $this;
	}
	
	public function getAnoFabricacao(): string {
		return $this->anoFabricacao;
	}
	
	public function setAnoFabricacao(string $anoFabricacao): self {
		$this->anoFabricacao = $anoFabricacao;
		return $this;
	}
	

	public function getAnoModelo(): string {
		return $this->anoModelo;
	}
	

	public function setAnoModelo(string $anoModelo): self {
		$this->anoModelo = $anoModelo;
		return $this;
	}
	
	public function getCombustivel(): string {
		return $this->combustivel;
	}
	
	public function setCombustivel(string $combustivel): self {
		$this->combustivel = $combustivel;
		return $this;
	}
	
	public function getPreco(): float {
		return $this->preco;
	}
	
	public function setPreco(float $preco): self {
		$this->preco = $preco;
		return $this;
	}

	public function getDetalhes(): string {
		return $this->detalhes;
	}
	

	public function setDetalhes(string $detalhes): self {
		$this->detalhes = $detalhes;
		return $this;
	}
	
	public function getFoto(): string {
		return $this->foto;
	}
	
	public function setFoto(string $foto): self {
		$this->foto = $foto;
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