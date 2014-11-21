<?php

namespace CodeEducation\Db;

class DbManagerTest extends \PHPUnit_Framework_TestCase
{
	private $db;

	public function setUp()
	{
		$this->db = new \PDO("sqlite::memory:");

		$query = 'CREATE TABLE cliente (id INT AUTO_INCREMENT, nome VARCHAR(255), email VARCHAR(255));';
		$this->db->exec($query);
	}


	// Executa no final de cada teste
	public function tearDown()
	{
		$this->db->exec('DROP TABLE cliente;');
	}

	public function testVerificaSeTemAdaptadorValidoDeBancoDeDados()
	{
		$dbManager = new DbManager();
		$dbManager->setDbAdapter(new \PDO('sqlite::memory:'));

		$this->assertInstanceOf("\PDO", $dbManager->getConnection());

	}

	public function testVerificaInsertDeDadosDoCliente()
	{
		$dbManager = new DbManager();
		$dbManager->setDbAdapter($this->db);

		$cliente = new \CodeEducation\Cliente\Cliente();
		$cliente->setNome('Wellington Ribeiro');
		$cliente->setEmail('ribeiro.php@email.com');

		$dbManager->persist($cliente);
		$dbManager->flush();

		$stmt = $this->db->query("SELECT * FROM cliente;");

		$this->assertEquals(1, count($stmt->fetchAll()) );

	}

}