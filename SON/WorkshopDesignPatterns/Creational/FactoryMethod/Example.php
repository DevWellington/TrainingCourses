<?php

abstract class Montadora
{
	public function fabricar($tipo)
	{
		$carro = $this->createCarro($tipo);
		$carro->preparar();
		$carro->montar();
		$carro->pintar();
		$carro->entregar();

		return $carro;
	}

	public abstract function createCarro($tipo);
}

class MontadoraBrasil extends Montadora
{
	public function createCarro($tipo)
	{
		if($tipo == "ka")
			$carro = new KaCarroBrasil();
		elseif($tipo == "gol")
			$carro = new GolCarroBrasil();	
		elseif($tipo == "uno")
			$carro = new UnoCarroBrasil();

		return $carro;
	}
}

class MontadoraLondres extends Montadora
{
	public function createCarro($tipo)
	{
		if($tipo == "ka")
			$carro = new KaCarroLondres();
		elseif($tipo == "gol")
			$carro = new GolCarroLondres();	
		elseif($tipo == "uno")
			$carro = new UnoCarroLondres();

		return $carro;
	}
}


abstract class Carro
{
	protected $nome;
	protected $cor;

	public function preparar()
	{
		echo "Preparou ".$this->nome;
	}

	public function montar()
	{
		echo "montou ".$this->nome;
	}

	public function pintar()
	{
		echo "Pintou da cor ".$this->cor;
	}

	public function entregar()
	{
		echo $this->nome. " foi entregue";
	}
}


class KaCarroLondres extends Carro
{
	public function __construct()
	{
		$this->nome = "Ka";
		$this->cor = "Preto";
	}
}

class GolCarroLondres extends Carro
{
	public function __construct()
	{
		$this->nome = "Gol";
		$this->cor = "Branco";
	}
}

class UnoCarroLondres extends Carro
{
	public function __construct()
	{
		$this->nome = "Uno";
		$this->cor = "Azul";
	}
}


class KaCarroBrasil extends Carro
{
	public function __construct()
	{
		$this->nome = "Ka";
		$this->cor = "Verde";
	}
}

class GolCarroBrasil extends Carro
{
	public function __construct()
	{
		$this->nome = "Gol";
		$this->cor = "Perola";
	}
}

class UnoCarroBrasil extends Carro
{
	public function __construct()
	{
		$this->nome = "Uno";
		$this->cor = "Azul Claro";
	}
}


// Quero um ka do brasil montado

$montadoraBrasil = new MontadoraBrasil();
$montadoraBrasil->fabricar("ka");

