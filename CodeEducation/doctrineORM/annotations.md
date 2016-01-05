# DOCTRINE 

## INICIANDO

### Falando sobre o Doctrine

www.doctrine-project.org

É um ORM (Object Relations Mapper), mapeia através de entidades e relaciona com o banco de dados;

Importante: Aprender a trabalhar com ele e fazer uma integração com o Silex.

Ele também é um DBAL (DataBase Abstract Layer) ele faz a abstração da camada de dados, com isso podemos utiliza-lo também como DBAL.

É um grande projeto, por esse motivo, existe uma complexidade para configurá-lo, com isso é só com *copy and paste*.

### Configurando o Doctrine

```json
"require": {
    "doctrine/orm": "~2.4",
},
"config": {
    "bin-dir": "bin/"
}
```

`php composer.phar update doctrine/orm`

**Arquivo de bootstrap**

```php
use Doctrine\ORM\Tools\Setup,
    Doctrine\ORM\EntityManager,
    Doctrine\Common\EventManager as EventManager,
    Doctrine\ORM\Events,
    Doctrine\ORM\Configuration,
    Doctrine\Common\Cache\ArrayCache as Cache,
    Doctrine\Common\Annotations\AnnotationRegistry,
    Doctrine\Common\Annotations\AnnotationReader,
    Doctrine\Common\ClassLoader;

$cache = new Doctrine\Common\Cache\ArrayCache;
$annotationReader = new Doctrine\Common\Annotations\AnnotationReader;

$cachedAnnotationReader = new Doctrine\Common\Annotations\CachedReader(
    $annotationReader, // use reader
    $cache // and a cache driver
);

$annotationDriver = new Doctrine\ORM\Mapping\Driver\AnnotationDriver(
    $cachedAnnotationReader, // our cached annotation reader
    array(__DIR__ . DIRECTORY_SEPARATOR . 'src')
);

$driverChain = new Doctrine\ORM\Mapping\Driver\DriverChain();
$driverChain->addDriver($annotationDriver,'Code');

$config = new Doctrine\ORM\Configuration;
$config->setProxyDir('/tmp');
$config->setProxyNamespace('Proxy');
$config->setAutoGenerateProxyClasses(true); // this can be based on production config.
// register metadata driver
$config->setMetadataDriverImpl($driverChain);
// use our allready initialized cache driver
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

AnnotationRegistry::registerFile(__DIR__. DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'doctrine' . DIRECTORY_SEPARATOR . 'orm' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Doctrine' . DIRECTORY_SEPARATOR . 'ORM' . DIRECTORY_SEPARATOR . 'Mapping' . DIRECTORY_SEPARATOR . 'Driver' . DIRECTORY_SEPARATOR . 'DoctrineAnnotations.php');

$evm = new Doctrine\Common\EventManager();
$em = EntityManager::create(
    array(
        'driver'  => 'pdo_mysql',
        'host'    => '127.0.0.1',
        'port'    => '3306',
        'user'    => 'root',
        'password'  => 'root',
        'dbname'  => 'trilhando_doctrine',
    ),
    $config,
    $evm
);
```

### Configurando o console

Linha de comandos do doctrine. 

Muito utilizado para criar:

- Bancos de Dados;
- Schemas;
- etc;

`php bin/doctrine;'

Necessário criar o arquivo **cli-config.php**

```php

<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once '../bootstrap.php';

// replace with mechanism to retrieve EntityManager in your app
$entityManager = $em;

return ConsoleRunner::createHelperSet($entityManager);

```

O arquivo cli-config.php é relativo ao doctrine, por esse motivo devemos estar na pasta bin/ para executar o console.
`cd bin/`

`php doctrine`


### Criando nossa primeira entidade

```php

namespace CodeEducation\Sistema\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="clientes")
 */
 
class Cliente
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=255)
     */
	private $nome;
	
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $email;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
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
    }
}

```


### Gerando Schema

```sql
CREATE DATABASE trilhando_doctrine;
```

Alguns comandos do console do doctrine;

- Informaçoes sobre as Entidades
```sh
php doctrine orm:info

///
Found 1 mapped entities:
[OK]   CodeEducation\Sistema\Entity\Cliente
///
```

- Criando a tabela do Danco de Dados baseada na nossa Entidade
```sh
php doctrine orm:schema-tool:create

///
ATTENTION: This operation should not be executed in a production environment.

Creating database schema...
Database schema created successfully!
///
```

- Verificando o SQL que ele utiliza
```sh
php doctrine orm:schema-tool:create --dump-sql

///
CREATE TABLE clientes (id INT AUTO_INCREMENT NOT NULL, nome VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
///
```

### Persistindo

Utilizando o ClienteMapper para persistir os dados

```php

use Doctrine\ORM\EntityManager;


class ClienteMapper
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function insert(Cliente $cliente)
    {
        // Vai pra fila para ser inserido no banco de dados
        $this->em->persist($cliente);
        
        // Concretiza os dados no banco;
        $this->em->flush();
        
        // Retornando os dados do cliente
        
        return [
            'success' => true,
            'data' => [
                'id' => $cliente->getId(),
                'nome' => $cliente->getNome(),
                'email' => $cliente->getEmail()
            ]
        ];
    }
}
```

- Controllers (index)
```php
$app['clienteService'] = function() use ($em)
{
    $clienteEntity = new Cliente;
    $clienteMapper = new ClienteMapper($em);

    return new ClienteService($clienteEntity, $clienteMapper);
};
```

## REFATORANDO

### Ajustando a estrutura

```php
<?php

use CodeEducation\Sistema\Entity\Cliente as ClienteEntity;

class ClienteService
{
    private $cliente;
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function insert(array $data)
    {
        $clienteEntity = new ClienteEntity;
        $clienteEntity->setNome($data['nome']);
        $clienteEntity->setEmail($data['email']);

        $this->em->persist($clienteEntity);
        $this->em->flush();

        return $clienteEntity;
    }
```
        
        
    
    
    

















