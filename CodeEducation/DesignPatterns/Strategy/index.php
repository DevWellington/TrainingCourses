<?php
require_once 'autoloader.php';

class ProdutoManager
{
	public function __construct(\CodeEducation\Logger\Logger $logger)
	{
		$this->logger = $logger;
	}

	public function salvar($produto)
	{
		echo "Salvando o produto {$produto->nome}! ";
		$this->logger->success("Produto {$produto->nome} foi salvo!");
	}

}

$logger = new \CodeEducation\Logger\XmlLoggerStrategy();
$manager = new ProdutoManager($logger);

$produto = new stdClass();
$produto->nome = 'Mouse';
$produto->valor = 20.9;
$manager->salvar($produto);
