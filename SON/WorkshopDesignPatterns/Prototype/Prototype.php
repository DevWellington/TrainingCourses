<?php

abstract class DataPrototype
{
	private $size;
	private $data;

	abstract public function __clone();
	abstract public function getData();
	abstract public function setData($data);
	abstract public function getSize();
}

class ArrayPrototype extends DataPrototype
{
	public function setData($data)
	{
		if(!is_array($data))
			throw new Exception("Precisa ser array.", 1);

		$this->data = $data;
	}

	public function getData()
	{
		return $this->data;
	}

	public function getSize()
	{
		if(!$size = count($this->data))
			throw new Exception("Error ao pegar o tamanho do array.", 1);

		return $size;
	}

	public function __clone()
	{
		//throw new Exception("Error não pode clonar!", 1);
	}
}


$arrayPrototype = new ArrayPrototype();

$array1 = clone $arrayPrototype;
$array1->setData(
	array(
		'elemento 1', 
		'elemento 2', 
		'elemento 3'
	)
);

echo "Numero de elementos no array eh: " . $array1->getSize() . "\n";

$array2 = clone $arrayPrototype;
$array2->setData(
	array(
		'elemento 1', 
		'elemento 2', 
		'elemento 3',
		'elemento 4'
	)
);

echo "Numero de elementos no array eh: " . $array2->getSize() . "\n";

$arrayX = clone $array2;
echo $arrayX->getSize()."\n";