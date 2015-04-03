<?php

require_once __DIR__."/../bootstrap.php";

use Symfony\Component\HttpFoundation\Response;
use CodeEducation\Sistema\Service\ClienteService;
use CodeEducation\Sistema\Entity\Cliente;
use CodeEducation\Sistema\Mapper\ClienteMapper;


$response = new Response();

$app['clienteService'] = function()
{
    $clienteEntity = new Cliente;
    $clienteMapper = new ClienteMapper();

    return new ClienteService($clienteEntity, $clienteMapper);
};

$app->get('/', function() use ($response){
    $response->setContent('Hello world!');
    return $response;
});

$app->get('/ola/{nome}', function($nome){
    return "Ola {$nome}";
});

$app->get('/cliente', function() use ($app){
    $dados['nome'] = "Cliente";
    $dados['email'] = "email@cliente.com";

    $result = $app['clienteService']->insert($dados);

    return $app->json($result);
});

$app->run();