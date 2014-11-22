# Security PHP

[Link das aulas](http://code.education/zend/security/video-106294729/1)

##Controlando dados de entrada e saída

Importancia de filtrar as informações que entram e que saem da aplicação;

- SQL Injection
- XSS
- Etc

Ter certeza que os dados são confiaveis;

Principais dicas para conseguir tratar as informações que o sistema recebe, e valida-las de forma simples, rápida e coesa;

**Funções nativas do PHP**

Filtros de validação

```php
$value = 111;
$var = filter_var($value, FILTER_VALIDATE_INT);
// boolean true

$value = 'Ribeiro';
$var = filter_var($value, FILTER_VALIDATE_INT);
// boolean false

$value = "ribeiro.php@email.com";
$var = filter_var($value, FILTER_VALIDATE_EMAIL);
// string 'ribeiro.php@email.com' (length=21)

$value = "ribeiro.php-email.com";
$var = filter_var($value, FILTER_VALIDATE_EMAIL);
// boolean false

```

Filtros de higienização (filter.sanitaze)

```php
$value = "Olá <b>Mundo</b>";
$var = filter_var($value, FILER_SANITIZE_STRING);
// string 'Olá Mundo'; (length=9)

$value = 15;
$var = filter_var($value, FILTER_VALIDATE_INT, array('options' => array('min_range' => 10, 'max_range'=> 20)));

// int 15

$value = 25;
$var = filter_var($value, FILTER_VALIDATE_INT, array('options' => array('min_range' => 10, 'max_range'=> 20)));

// boolean 25



































