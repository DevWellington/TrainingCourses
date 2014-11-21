<?php

namespace CodeEducation\Db;

class DbManager
{
	private $db;
	private $entities;

	public function setDbAdapter(\PDO $db)
	{
		$this->db = $db;
	}

	public function getConnection()
	{
		return $this->db;
	}

	public function persist($entity)
	{
		$this->entities[] = $entity;
	}

	public function flush()
	{
		// send to database;
		foreach ($this->entities as $entity) {
			$query = "INSERT INTO cliente VALUES (1, '{$entity->getNome()}', '{$entity->getEmail()}')";
			$this->db->query($query);

		}
	}
}