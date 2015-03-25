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


















