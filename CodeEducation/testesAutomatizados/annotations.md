# TESTES AUTOMATIZADOS

## INTRODUÇÃO

### Introdução

- Mais importantes do curso;
- Garantir a estabilidade da aplicação;
- Garantir que quando alterarmos qualquer pedaço do codigo, tudo vai permanecer funcionando e que nada vai ser quebrado.

- Testes manuais dão muito trabalho.
	Gasta-se muito tempo para testar diversas partes do sistema

####Testes automatizados:
São scripts pre-programados para que consigam simplismente fazer as tarefas que fariam manualmente;

**Tipos de testes automatizados:**
- Unitários
- Funcionais
- De aceitação

- Produtividade cai um pouco, até se acostumar;
- Trabalhar com testes digita-se um pouco mais;

###Instalando o PHPUnit

- Mais Utilizado

Testes unitários são testes que testam a unidade, basicamente ele tem a responsabilidade de testar uma única coisa.
Ex.: Testar uma classe (independente das suas dependencias);

Estrutura das pastas

- Projeto
	- bin
	- src
	- tests
		+ f: bootstrap.php
		+ f: phpunit.xml
	- vendor
	+ f: composer.json
	+ f: composer.lock

**composer.json**
```json
{
	"config":{
		"bin-dir": "bin/" 
	},
	"autoload": {
		"psr-0": {"CodeEducation": "src/"}
	},
	"require": {
		"phpunit/phpunit": "4.2.6"
	}
}
```
- Binarios

Quando o composer baixar qualquer biblioteca que contenha arquivo binario ele irá guardar um atalho na pasta "bin/" do nosso projeto.

- Autoload

O composer gera o Autoload de todas as bibliotecas que forem instaladas, e ou criadas no diretório "src/" com o namespace "CodeEducation", utilizando a "psr-0";

- Require

Quais bibliotecas serão instaladas "phpunit/phpunit" e a sua versão "4.2.6"

- Vendor 

É uma pasta o qual o composer armazena todas as bibliotecas que ele instalou.

###Criando nosso primeiro teste

- arquivo de configuração

```xml
<phpunit backupGlobals="false"
		 bakcupStaticAttributes="false"
		 bootstrap="bootstrap.php"
		 cacheTokens="true"
		 colors="true"
		 convertErrorsToExceptions="true"
		 convertNoticesToExceptions="true"
		 convertWarningsToExceptions="true"
		 processIsolation="false"
		 stopOnFailure="false"
		 syntaxCheck="false"
		 verbose="true">
	<testsuite name="CodeEducation - Testes">
		<directory>.</directory>
	</testsuite>
</phpunit>
```

- Cria-se o mesmo diretorio da pasta "/src" dentro de "/tests"
- Cria o arquivo com o nome da classe e "Test.php" no final
	- Exemplo: testando o arquivo "Math.php" com "MathTest.php"
- Extende a classe de teste para a classe:
	- \PHPUnit_Framework_TestCase
- Cria o metodo utilizando camelCase:
	- testVerificarSeOTipoDaClasseEstaCorreto


```php
$this->assertInstanceOf("CodeEducation\Math", new \CodeEducation\Math());
```

**Executando o Test**
```shell
php bin/phpunit -c tests/phpunit.xml
```

###Testando um método

- Metodo

```php
public function soma($x, $y)
{
    return $x + $y;
}
```

- Testando o metodo

Garantir que o metodo esta funcionando.

```php
public function testVerificaSeConsegueSomar()
{
    $math = new \CodeEducation\Math();

    $resultado = $math->soma(10, 12);
    $this->assertEquals(22, $resultado);

    // Triangulação, valida novamente o teste para casos de coincidencias
    $resultado = $math->soma(2, 3);
    $this->assertEquals(5, $resultado);
}
```

###Tratando exceptions

```php
public function soma($x, $y)
{
    if(!is_numeric($x) || !is_numeric($y))
        throw new \InvalidArgumentException("Os valores nao sao numericos.");

    return $x + $y;
}
```

```php
/**
 * @expectedException \InvalidArgumentException
 */
public function testVerificaSeConsegueSomarQuandoValorNaoENumerico()
{
    $math = new \CodeEducation\Math();

    $resultado = $math->soma(1, "Isso eh um teste");
}
```

- A annotation espera uma $excepctedException e se caso ocorrer o teste passa, ou seja, testando o validador. :)


###Data Providers

Nos ajuda a testar quando temos muitos dados para testar e passar algumas informações.

Testar 10 vezes por exemplo

```php
public function somaProvider()
{
	return [
		[2,2,4],
		[10,10,20],
		[10,15,25],
		[15,15,30]
	];
}

/**
 * @dataProvider somaProvider
 */
public function testVerificaSeConsegueSomarComProvider($x, $y, $resultado)
{
	$math = new \CodeEducation\Math();
	
	$res = $math->soma($x, $y);
	$this->assertEquals($resultado, $res);
}

```

- A annotation chama todos os dados do array


###Documentação do PHPUnit

http://phpunit.de


##TESTES UNITARIOS

###Criando nossa estrutura

Especificamente sobre testes unitarios, ja foi feito no capitulo anterior, mas vale resaltar que nao eh so aquilo. :)

Neste capitulo vamos criar um sisteminha bem simples para realizar os testes;

###Testando a classe Cliente

Criar os testes para garantir a funcionalidade;

Testar a unidade, apenas a classe em si;.

Os testes nos Getters e nos Setters são necessários pois em determinados casos, podemos fazer validações antes de setar um valor, e ou devolver. Portanto faça-o;

	Ex: Validação de Emails;

Cliente.php
	Testado a unidade

###Testando classe ClienteAgregator

Este teste não eh um Teste Unitario:

Pode ser considerado um teste funcional

```php
$cliente1 = new \CodeEducation\Cliente\Cliente();
$cliente1->setNome("Wellington Ribeiro");
$cliente1->setEmail("devwellington@gmail.com");


$cliente2 = new \CodeEducation\Cliente\Cliente();
$cliente2->setNome("Ribeiro");
$cliente2->setEmail("ribeiro.php@gmail.com");

$clAgregator = new ClienteAgregator();
$clAgregator->addCliente($cliente1);
$clAgregator->addCliente($cliente2);

$clientes = $clAgregator->getClientes();

$this->assertEquals("Wellington Ribeiro", $clientes[0]->getNome());
$this->assertEquals("Ribeiro", $clientes[1]->getNome());
```

O codigo acima não condiz com um teste unitário, pois o mesmo esta testando uma funcionalidade da classe, testes unitarios testa a unidade;

Se a dependencia do **ClienteAgregator** que são os Clientes falhar, não teremos o esperado neste teste;

Essa dependencia de Cliente acaba sendo um paradoxo (leva a uma contradição lógica).

###Agregator com Mock

Mocks e stubs, são classes dublês. São classes que fingem ser uma coisa pra forcar um comportamento.

No nosso caso do Cliente, vamos criar um Mock para agregar ao ClienteAgregator.

```php

$cliente = $this->getMock('\CodeEducation\Cliente\Cliente', array('getNome'));
$cliente
    ->expects($this->any())
    ->method('getNome')
    ->willReturn('Wellington Ribeiro')
;
```

Quando eu chamar a classe Cliente, o agregator será "enganado" pelo Mock;

Toda vez que eu chamar `$cliente->getNome()` irá retornar **Wellington Ribeiro**;

Independente do funcionamento da classe Cliente, o importante aqui é testar a funcionalidade da classe **ClienteAgregator**;

####Agora de fato o nosso teste é unitário

Pois a única classe a qual esta sendo testada, é a **ClienteAgregator**, pq os objetos adicionados são Mocks (totalmente manipulavel);


###Criando Mock para classe Mail

A classe Mail também depende da Classe **Cliente** por isso também será necessario criar um Mock de Clientes para realizar os testes UNITARIOS da classe Mail;

Simular o envio de emails com algum outro resultado;

Quando passarmos o cliente o getTo tem que retornar o eMail cadastrado na classe **Cliente**.

```php

$cliente = $this->getMock('\CodeEducation\Cliente\Cliente', array('getEmail'));
$cliente
    ->expects($this->any())
    ->method('getEmail')
    ->willReturn('devwellington@gmail.com')
;

$mail = new \CodeEducation\Mail\Mail();
$mail->setCliente($cliente);

$this->assertEquals("devwellington@gmail.com", $mail->getTo());
```

####Mockeando o envio de email

Foi criado um novo atributo na classe **Cliente** `private $mailTransport` ele vai servir para guardar a classe que envia o eMail;

```php

$mailTransport = new \CodeEducation\Mail\SendMail();

$cliente = new Cliente();
$cliente->setMailTransport($mailTransport);

$this->assertTrue($cliente->sendEmail());

```

Esse teste tem que retornar true;

Só que cada vez que realizar esse teste será enviado um email de fato, mas a ideia aqui não eh enviar o email, pois estamos realizando um teste unitario.

Para isso usaremos um Mock.

```php

$mailTransport = $this->getMock('\CodeEducation\Mail\SendMail', array('send'));
$mailTransport
    ->expects($this->once())
    ->method('send')
    ->willReturn(true)
;
    
$cliente = new Cliente();
$cliente->setMailTransport($mailTransport);

$this->assertTrue($cliente->sendEmail());

```

O uso de Mocks consegue simular o comportamento de outras classes sem precisar de fato executa-las;

Esses tipos de testes são fundamentais para testar a **Classe** e somente a **Classe**;

## QUESTIONS of Module

1. Qual a diferença entre testes Unitários e Funcionais?
    
    R.: O teste unitário testa apenas a unidade, evitando que pontos exteriores afetem em seu resultado. O teste funcionam testa funções, ou conjunto de classes em operação


2. Qual a utilidade de utilizar Mocks?

    R.: O Mock consegue simular o comportamento de classes externas, porém, também nos da a possibilidade de controlar o comportamento e o resultado do mesmo.


## TESTES FUNCIONAIS

###Testes de Integração

Ele testa a integração entre duas ou mais unidades;

Confundido com testes funcionais;

Quando se tem um teste que envolve duas ou mais unidades entre si, para testar o funcionamento devemos utilizar o teste de integração;

###Testes funcionais

Testam uma funcionalidade como um todo, desde o **ponto A** até o **ponto B** da função;

Ele testa:

    - Uma funcionalidade;
    - Uma feature;
    - Um requisito funcional;
    
São úteis para verificar se uma determinada funcionalidade do sistema esta quebrada, ou não;

Consegue garantir todas as funcionalidades;

Testa o processo completo;

Este teste mais é o mais importante, não pode faltar nas aplicações;


###Setup e TearDown

**setUp**

O método `setUp()` sempre é executado antes de um teste de acordo com a quantidade de testes que você tenha na classe;

```php
private $cliente;
public function setUp()
{
    $this->cliente = new Cliente();
}
```

**tearDown**

O método `tearDown()` sempre é executado após a realização dos testes;

```php
public function tearDown()
{
    echo 'Fim da execução de um teste';
}
```

Normalmente o *tearDown* desfaz coisas que o *setUp* faz.

###Criando DbManager

```php
namespace CodeEducation\Db;

class DbManagerTest extends \PHPUnit_Framework_TestCase
{
	public function testVerificaSeTemAdaptadorValidoDeBancoDeDados()
	{
		$dbManager = new DbManager();
		$dbManager->setDbAdapter(new \PDO('sqlite::memory'));

		$this->assertInstanceOf('\PDO', $dbManager->getConnection());
	}
}
```

```php
namespace CodeEducation\Db;

class DbManager
{
	private $db;

	public function setDbAdapter(\PDO $db)
	{
		$this->db = $db;
	}

	public function getConnection()
	{
		return $this->db;
	}
}
```

###Criação da tabela cliente

```php

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

	}

}
```

###Teste para inserir

Ok, ver codigo

##TDD

###Falando sobre TDD

Metodologia de desenvolvimento ágil;

TDD - Test Driven Development

- Consiste em desenvolver as aplicações guiadas a Testes;
- Criar os testes antes de criar o software;
- Depois eh desenvolvida a solução para fazer o testes "passar";
- Primeiro o teste falha, logo apos voce deve fazer o teste passar, 
e finalmente você irá refatorar;

- Baby steps (passinhos de bebe)
    - Não saia criando algo muito amplo
    - Crie pequenas partes e evolua devagar;

- Ter um bom ambiente para desenvolver;

###Criando o primeiro teste

CrazyTest
```php
class CrazyTest extends PHPUnit_Framework_TestCase
{
    /*
     * Imprimir uma frase passar por parametro
     * loop de 0 a x
     * Retornar na tela a soma de dois numeros que passaremos por parametro
     */

    public function testVerificaSeImprimeUmaFrasePassandoParametro()
    {
        $crazy = new Crazy();
        $crazy->setFrase("Minha frase");
        
        $this->assertEquals("Minha Frase", $crazy->getFrase());
    }

}
```

Crazy
```php
class Crazy  
{
    private $frase;

    public function getFrase()
    {
        return $this->frase;
    }
    
    public function setFrase($frase)
    {
        $this->frase = $frase;
    }
}
```

###Criando teste - Parte 2

CrazyTest
```php
class CrazyTest extends PHPUnit_Framework_TestCase
{
    /*
     * Imprimir uma frase passar por parametro
     * loop de 0 a x
     * Retornar na tela a soma de dois numeros que passaremos por parametro
     */

    public function testVerificaSeImprimeUmaFrasePassandoParametro()
    {
        $crazy = new Crazy();
        $crazy->setFrase("Minha frase");
        
        $this->assertEquals("Minha Frase", $crazy->getFrase());
    }
    
    public function testVerificaSeRetornaLoop()
    {
        $crazy = new Crazy();
        $data = $crazy->getLoop(10);
        
        $array = range(0,10);
        
        $this->assertEquals($array, $data);
    }
    
    /**
     * @expectedException InvalidArgumentException
     */
    public function testVerificaSeAEntradaDoLoopEInteiro()
    {
    	$crazy = new Crazy();
        $data = $crazy->getLoop("Teste");
        
        $array = range(0,10);
        
        $this->assertEquals($array, $data);
    }

    public function testVerificaSomaDeDoisNumeros()
    {
    	$crazy = new Crazy();
    	$resultado = $crazy->soma(10,10);

    	$this->assertEquals(20, $resultado);
    }    

}
```

###Cobertura de código

- Resumo de todos os testes feitos:

`
php bin/phpunit -c tests/phpunit.xml --testdox
`


```xml
<logging>
    <log type="coverage-html" target="./log/report" charset="UTF-8" yui="true" highlight="true" lowUpperBound="35" highLowerBound="80" />

    <log type="testdox-html" target="./log/testdox.html" />
</logging>
```

Generating code coverage report in HTML format ... done


##TESTES DE ACEITAÇÃO

Testes de aceitação são que rodam são testes que rodam simulando a ação de um
usuario no browser utilizando a interface, cliques, etc.

###Instalando o Selenium

http://seleniumhq.org

Selenium Server

```shell
wget http://selenium-release.storage.googleapis.com/2.45/selenium-server-standalone-2.45.0.jar
```

http://docs.seleniumhq.org/download/

- Adicionar no composer.json
    - "phpunit/phpunit-selenium": ">=1.2"

###Rodando o primeiro teste

Criar um teste simples para trabalhar com o Selenium

mkdir **WebTest**

```php
namespace CodeEducation;

class ExemploTest extends \PHPUnit_Extensions_Selenium2TestCase
{
    public function setUp()
    {
        $this->setBrowser("firefox");
        $this->setBrowserUrl("http://www.wikipedia.org");
    }

    public function testVerificaTitle()
    {
        $this->url("http://wikipedia.org");
        $this->assertEquals('Wikipedia', $this->title);
    }
}
```

###Testando formulário

- Verificando um valor em um determinado campo

```php
public function testVerificaSeCampoDeBuscaEstaEmBranco()
{
    $this->url("/");
    $campoBusca = $this->byId("searchInput");
    
    $this->assertEquals('', $campoBusca->value());
}
```  
  
- Enviando um form
  
```php
public function testVerificaSubmitComPHP()
{
    $this->url("/");
    
    $form = $this->byClassName("search-form");
    $campoBusca = $this->byId("searchInput")->value("PHP");
    $botao = $this->byName("go");
    $form->submit();

    // Pagina depois do Submit
    
    $titulo = $this->byCssSelector("h1")->text();
    
    $this->assertContains("PHP", $titulo);
}  
```

###Dicas finais

- Comandos mais utilizados
    - $this->byName();
    - $this->byCssSelector();
    - $this->byId();
    - $this->byLinkText();
    
Expressao regular ($this->source() codigo fonte)

    - $this->assertRegExp('/log ?in/', $this->source());


## QUESTIONS of Module - GERAL

1. Qual das extensões abaixo precisam estar habilitadas para termos o relatório de cobertura de código?
    
    R. XDebug
    
2. Qual a função do método tearDown?

    R. Ser executado logo após cada teste 
    
3. Quando queremos realizar um teste que faz comunicação com uma ou mais unidades, esse teste pode ser chamado de:

    R. Integração
    
4. Qual a classe que devemos herdar para realizarmos os testes de aceitação?

    R. PHPUnit_Extensions_Selenium2TestCase     

5. Quais são os ciclos do TDD?

    R. Falhar-Passar-Refatorar 

