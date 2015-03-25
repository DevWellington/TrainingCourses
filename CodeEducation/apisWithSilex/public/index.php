<?php

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