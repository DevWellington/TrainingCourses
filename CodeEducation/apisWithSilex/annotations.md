# APIS E SILEX

## INICIANDO

### Introdução a SOA

WebAPIs - Qualquer coisa tem uma API disponível (moda);

Silex MicroFramework baseado nos componentes do Symfony 2;

### SOA

Exemplo:

- Uma aplicação em Delphi
    - Todas as regras estão organizadas no software;
    - Integração com outro sistema;
    - Duplicar uma rotina do código para atender a necessidade;
    
Mas isso também pode acontecer em aplicações Web já desenvolvidas, por exemplo na necessidade de integração com um aplicativo para telefone moveis (Smartphone, iPhone, etc).

Se toda a lógica não estiver separada, o programador deverá reescrever o codigo, ou até mesmo duplicar o codigo, etc.

**SOA**: Service Oriented Architecture

Conceitos: Devine-se uma arquitetura, onde todas as regras são chamadas de **Serviços** e se houver a necessidade de extender essa aplicação para uma outra Mobile, ou outra plataforma qualquer, não será necessário *sofrer* para implementar a solução.

Vantagens:
    - Todas as regras separadas em um único local;
    - Manutenabilidade;
    - Facilidade nas integrações;
    
**APIs** Application Program Interface;

Interface para que outros sistemas se encaixem, e que ela consiga executar as solicitações/requests independente do cliente que à envia.

Mobile, desktop, tablet, multi dispositivos, etc. São muitas variedades de acesso a rede nos dias de hoje, portanto. Não é necessário criar todas as regras em ambientes diferentes e duplicar os codigos. 

### Complementando

Base para que seja claro quando for escrever o codigo;

Não desenvolva uma API somente se for necessário disponibiliza-la, pois em algum momento voce pode necessitar compartilhar esses dados com outros sistemas e fazer integrações.

Uma aplicação ja desenvolvida pode utilizar uma API normalmente mesmo que ela não seja compartilhada com outras aplicações. Com isso a API so será acessada **internamente** sem acesso externo.


### Instalando o Silex

Require com **composer**

```json
{
    "require": {
        "silex/silex": "~1.2"
    }
}
```
ou 

```shell
php composer.phar require 
silex
[0] silex/silex
```
ou 

```shell
php composer.phar require silex/silex
```

### Configurando o Silex

- Document root

```shell
mkdir public/
touch public/index.php
```

- Regras, Camada de Serviços, etc

```shell
mkdir src/

// Arquivo de inicialização
mkdir bootstrap.php
mkdir src/DevWellington


```

- bootstrap.php

```php
require_once "vendor/autoload.php";

$app = new Silex\Application();
```

- index.php

```php
require_once __DIR__."/../bootstrap.php";

$app->run();
```


### Falando sobre Responses

- index.php

```php
require_once __DIR__."/../bootstrap.php";

$app->get('/', function(){
    echo "Hello world";
});

$app->run();
```

- **Request**: Objeto responsável por manipular todas as requisições;

- **Response**: Cuida da resposta que o servidor envia para o cliente baseado na sua requisição, ou seja, eu faço uma pergunta *(Request)* e o servidor me envia uma resposta *(Response)*;


```php
require_once __DIR__."/../bootstrap.php";

use Symfony\Component\HttpFoundation\Response;

$response = new Response();

$app->get('/', function() use ($response){
    $response->setContent('Hello world!');
    return $response;
});

$app->run();
```

### Debug

Em modo de desenvolvimento, voce precisa o que um erro quer dizer. Com isso podemos settar o atributo `$app['debug']` para `true`, com isso todo e qualquer erro que for retornado o mesmo será descritivo e intuitivo, e não somente o "Whoops, looks like something went wrong."

Todo Controllador necessita de um return, que por sua vez se torna um **Response**;

### Parâmetros

```php
require_once __DIR__."/../bootstrap.php";

use Symfony\Component\HttpFoundation\Response;

$response = new Response();

$app->get('/', function() use ($response){
    $response->setContent('Hello world!');
    return $response;
});

$app->get('/ola/{nome}', function($nome){
    return "Ola {$nome}";
});

$app->run();
```

## SERVIÇOS

Organizar melhor a estrutura do software;

### Mudando o autoload

- Criando a camada de serviços
    - Regra de negocios

```shell    
mkdir ./src/CodeEducation
mkdir ./src/CodeEducation/Sistema
```

PSR - 4

```json
{
    "require": { 
        "silex/silex": "~1.2"
    },
    "autoload": {
        "psr-4": {
            "CodeEducation\\Sistema\\": "src/CodeEducation/Sistema"
        }
    }
}
```
    
### Criando a estrutura de Cliente

- Iniciar a criacao da estrutura;
- Cadastro de cliente simples;

Concentrar nossas regras de negocios


```shell
mkdir src/CodeEducation/Sistema/Entity
touch src/CodeEducation/Sistema/Entity/Cliente.php

mkdir src/CodeEducation/Sistema/Mapper
touch src/CodeEducation/Sistema/Mapper/ClienteMapper.php
```

```php
namespace CodeEducation\Sistema\Entity;	

class Cliente
{
	private $nome;
	private $email;
	
	//getters and setters
}
```

- Mapper:
    - Responsavel por relacionar os dados da Entidade com o Banco de Dados;


```php
namespace CodeEducation\Sistema\Mapper;

use CodeEducation\Sistema\Entity\Cliente;

class ClienteMapper
{
    public function insert(Cliente $cliente)
    {
        return [
            'nome' => 'Cliente XPTO',
            'email' => 'email@clientexpto.com'
        ];
    }
}
```

### Criando controller do cliente

```php

use CodeEducation\Sistema\Entity\Cliente;
use CodeEducation\Sistema\Mapper\ClienteMapper;

$app->get("/cliente", function() use ($app){
    
    $dados['nome'] = "Cliente";
    $dados['email'] = "email@cliente.com";
    
    $clienteEntity = new Cliente();
    $clienteEntity->setNome($dados['nome']);
    $clienteEntity->setEmail($dados['email']);
    
    $mapper = new ClienteMapper();
    $result = $mapper->insert($clienteEntity);
    
    return $app->json($result);
});
```

O processo de inserir o cliente não pode ser responsabilidade do Controller.

Deve-se separar a responsabilidade (para um serviço);

### Criando ClienteService

Caso seja necessario inserir uma informação/rotina antes ou depois de inserir o cliente, esta nova nessa funcionalidade, será replicada em todas as partes do sistema.

Duplicando codigo e dificultando a manutencao do mesmo. 

Muito ruim :(

Para isso criaremos um **Container de Serviços**

```shell
mkdir src/CodeEducation/Sistema/Service
touch src/CodeEducation/Sistema/Service/ClienteService.php
```

Todas as regras especificas de Cliente
```php
namespace CodeEducation\Sistema\Service;

use CodeEducation\Sistema\Entity\Cliente;
use CodeEducation\Sistema\Mapper\ClienteMapper;

class ClienteService
{
    public function insert(array $data)
    {    
        $clienteEntity = new Cliente();
        $clienteEntity->setNome($data['nome']);
        $clienteEntity->setEmail($data['email']);
        
        $mapper = new ClienteMapper();
        $result = $mapper->insert($clienteEntity);    
        
        return $result;
    }
      
}

```

Toda regra foi separada para o Servico.

```php
use CodeEducation\Sistema\Service\ClienteService;

$app->get("/cliente", function() use ($app){
    
    $dados['nome'] = "Cliente";
    $dados['email'] = "email@cliente.com";
    
    $clienteService = new ClienteService();
    $result = $clienteService->insert($dados);
    
    return $app->json($result);
});
```

### Desacoplando

Com o `new Cliente` e o `new ClienteMapper` na Classe **ClienteService** o acoplamento esta muito forte/alto e perde funcionalidade para uso em outros sistemas.

Para contornar utilizaremos Dependency Injection, passando as dependencias para o construtor

```php
class ClienteService
{
    private $cliente;
    private $clienteMapper;
    
    public function __construct(Cliente $cliente, ClienteMapper $clienteMapper)
    {
        $this->cliente = $cliente;
        $this->clienteMapper = $clienteMapper;
    }

    public function insert(array $data)
    {    
        $clienteEntity = $this->cliente;
        $clienteEntity->setNome($data['nome']);
        $clienteEntity->setEmail($data['email']);
        
        $mapper = $this->clienteMapper;
        $result = $mapper->insert($clienteEntity);    
        
        return $result;
    }    
}
```

Passamos a criação para o Controller e removemos o acoplamento da Classe ClienteService;
  
```php
$app->get('/cliente', function() use ($app){
    $dados['nome'] = "Cliente";
    $dados['email'] = "email@cliente.com";

    $clienteEntity = new Cliente;
    $clienteMapper = new ClienteMapper();

    $clienteService = new ClienteService($clienteEntity, $clienteMapper);
    $result = $clienteService->insert($dados);

    return $app->json($result);
});
```

Mas ainda assim, ainda temos o problema do acoplamento, mas agora no Controller.

### Criando container de serviço

Para isso utilizaremos o Container de Serviços do Silex (Pimple (Service Container)), e teremos o acesso facilitado.

Arquivo: **index.php**

```php

$app['clienteService'] = function()
{
    $clienteEntity = new Cliente;
    $clienteMapper = new ClienteMapper();

    return new ClienteService($clienteEntity, $clienteMapper);
};


$app->get('/cliente', function() use ($app){
    $dados['nome'] = "Cliente";
    $dados['email'] = "email@cliente.com";

    $result = $app['clienteService']->insert($dados);

    return $app->json($result);
});

```
















