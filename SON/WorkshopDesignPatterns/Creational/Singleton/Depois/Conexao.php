<?php

class Conexao
{
	private static $instance;

	// Nao deixa instanciar a Classe (new Conexao())
	private function __construct() { }

	public static function getInstance()
	{
		if (!isset(self::$instance)){
			try{
				self::$instance = new \PDO("mysql:host=localhost;dbname=teste;", "root", "");
			} catch(Exception $e){
				echo $e->getMessage();
			}
		} 

		return self::$instance;
	}
}

$conexao = Conexao::getInstance();
$conexao2 = Conexao::getInstance();
