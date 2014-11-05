<?php

class Conexao
{
	public function connect()
	{
		try{
			$db = new \PDO("mysql:host=localhost;dbname=teste;", "root", "");
			return $db;

		} catch(Exception $e) {
			echo "Error :". $e->getMessage();

		}
	}
}


/** 
 * O Erro aqui eh que toda vez que um novo 
 * objeto for criado será uma nova conexao com o DB
 */
$conexao = new Conexao();
$conexao2 = new Conexao();

$conn = $conexao->connect();

