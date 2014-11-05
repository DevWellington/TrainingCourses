<?php

interface CarroTipoFactory
{
	public function createCarroEsportivo();
	public function createCarroEconomico();
}

class GMFactory implements CarroTipoFactory
{
	public function createCarroEsportivo()
	{
		return new Corvette();
	}

	public function createCarroEconomico()
	{
		return new Celta();
	}
}

class FordFactory implements CarroTipoFactory
{
	public function createCarroEsportivo()
	{
		return new Mustang();
	}

	public function createCarroEconomico()
	{
		return new Fiesta();
	}
}

interface CarroEsportivo
{
	public function correr();
}

class Mustang implements CarroEsportivo
{
	public function correr()
	{
		echo "Correndo: Mustang\n";
	}
}

class Corvette implements CarroEsportivo
{
	public function correr()
	{
		echo "Correndo: Corvette\n";
	}
}

interface CarroEconomico
{
	public function passear();
}

class Celta implements CarroEconomico
{
	public function passear()
	{
		echo "Passeando: Celta\n";
	}
}

class Fiesta implements CarroEconomico
{
	public function passear()
	{
		echo "Passeando: Fiesta\n";
	}
}


$gm = new GMFactory();

$carro1 = $gm->createCarroEconomico();
$carro2 = $gm->createCarroEsportivo();

$carro1->passear();
$carro2->correr();

$ford = new FordFactory();

$carro1 = $ford->createCarroEconomico();
$carro2 = $ford->createCarroEsportivo();

$carro1->passear();
$carro2->correr();

