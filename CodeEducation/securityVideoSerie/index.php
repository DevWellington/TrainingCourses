<?php

/**
 * Filtros de validação
 */

$value = 111;
$var = filter_var($value, FILTER_VALIDATE_INT);

var_dump($var);
// boolean true

$value = 'Ribeiro';
$var = filter_var($value, FILTER_VALIDATE_INT);

var_dump($var);
// boolean false

$value = "ribeiro.php@email.com";
$var = filter_var($value, FILTER_VALIDATE_EMAIL);

var_dump($var);
// string 'ribeiro.php@email.com' (length=21)

$value = "ribeiro.php-email.com";
$var = filter_var($value, FILTER_VALIDATE_EMAIL);

var_dump($var);
// boolean false

/**
 * Filtros de higienização (filter.sanitaze)
 */

$value = "Olá <b>Mundo</b>";
$var = filter_var($value, FILTER_SANITIZE_STRING);

var_dump($var);
// string 'Olá Mundo'; (length=9)

$value = 15;
$var = filter_var($value, FILTER_VALIDATE_INT, array('options' => array('min_range' => 10, 'max_range'=> 20)));

var_dump($var);
// int 15

$value = 25;
$var = filter_var($value, FILTER_VALIDATE_INT, array('options' => array('min_range' => 10, 'max_range'=> 20)));

var_dump($var);
// boolean 25

/**
 * Filtros Query String
 */


// localhost:8888/?str=Olá Mundo <script>alert('oi') </script>
$qs = filter_input(INPUT_GET, 'str', FILTER_SANITIZE_SPECIAL_CHARS);

var_dump($qs);
// Olá mundo <script>alert('oi')</script>

















