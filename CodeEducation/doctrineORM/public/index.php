<?php

require_once __DIR__."/../bootstrap.php";

use Symfony\Component\HttpFoundation\Response;
use CodeEducation\Sistema\Service\ClienteService;
use CodeEducation\Sistema\Entity\Cliente;
use CodeEducation\Sistema\Mapper\ClienteMapper;
use Symfony\Component\HttpFoundation\Request;

$response = new Response();

$app['clienteService'] = function() use ($em)
{
    $clienteEntity = new Cliente;
    $clienteMapper = new ClienteMapper($em);
    $clienteService = new ClienteService($clienteEntity, $clienteMapper);

    return $clienteService;
};

// $app->get('/', function() use ($response){
//     $response->setContent('Hello world!');
//     return $response;
// });

// $app->get('/ola/{nome}', function($nome){
//     return "Ola {$nome}";
// });

$app->get('/', function() use ($app){
    return $app['twig']->render('index.twig', []);
})
	->bind('index');

$app->get('/ola/{nome}', function($nome) use ($app){
    return $app['twig']->render('ola.twig', ['nome' => $nome]);
});

$app->post('/api/clientes', function(Request $request) use ($app){

    $dados['nome'] = $request->get('nome');
    $dados['email'] = $request->get('email');    
    
    $result = $app['clienteService']->insert($dados);
    
    return $app->json($result);
});

$app->put('/api/clientes/{id}', function(Request $request) use ($app){

    $dados['nome'] = $request->get('nome');
    $dados['email'] = $request->get('email');    
    
    $result = $app['clienteService']->update($dados);
    
    return $app->json($result);
});

$app->delete('/api/clientes/{id}', function(Request $request) use ($app){

    $result = $app['clienteService']->delete($dados);
    
    return $app->json($result);
});

$app->get('/clientes', function() use ($app){
    
    $dados = $app['clienteService']->fetchAll();

    return $app['twig']->render('list.twig', ['clientes' => $dados]);
    
});

$app->get('/cliente', function() use ($app){
    $dados['nome'] = "Cliente";
    $dados['email'] = "email@cliente.com";

    $result = $app['clienteService']->insert($dados);

    return $app->json($result);
});

$app->run();