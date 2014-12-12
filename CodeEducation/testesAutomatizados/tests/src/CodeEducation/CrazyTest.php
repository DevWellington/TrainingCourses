<?php

namespace CodeEducation;

class CrazyTest extends \PHPUnit_Framework_TestCase
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
        
        $this->assertEquals("Minha frase", $crazy->getFrase());
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