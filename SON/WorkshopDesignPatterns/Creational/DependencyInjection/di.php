<?php

class Pessoa
{
    private $nome;
    private $email;
    private $idade;

    private $db;

    public function __construct(\PDO $db)
    {
    	$this->db = $db;
    }

    public function save()
    {
    	$sql = "INSERT INTO ...";
    }


    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdade()
    {
        return $this->idade;
    }

    /**
     * @param mixed $idade
     */
    public function setIdade($idade)
    {
        $this->idade = $idade;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

}

$pessoa1 = new Pessoa(new \PDO());
$pessoa2 = new Pessoa(new \PDO());
$pessoa3 = new Pessoa(new \PDO());
$pessoa4 = new Pessoa(new \PDO());
$pessoa5 = new Pessoa(new \PDO());



class Container
{
	public static $db;
	public static $db2;

	public static function makePessoa()
	{
		return new Pessoa(self::$db, self::$db2);
	}

	public static function make($classe)
	{
		if($classe == "Pessoa")
			return new Pessoa(self::$db, self::$db2);
		else if($classe == "Cliente")
			return new Cliente(self::$db);

		return false;
	}
}

Container::$db = new PDO();
Container::$db2 = new PDO();

$pessoa = Container::makePessoa();

$pessoaMake = Container::make('Pessoa'); // Não preciso passar parametros, o Container resolve!
$clienteMake = Container::make('Cliente');
