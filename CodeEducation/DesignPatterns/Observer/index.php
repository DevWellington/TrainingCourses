<?php
require_once 'autoloader.php';

$produtoObservador = new \CodeEducation\Produto\ProdutoObservador();

$produto = new \CodeEducation\Produto\Produto(1, 'Mouse');
$produto->attach($produtoObservador);
$produto->setNome('Teclado');
