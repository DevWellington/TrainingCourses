<?php

namespace CodeEducation\Cliente;

class ClienteAgregatorTest extends \PHPUnit_Framework_TestCase
{

    public function testVerificarFuncionamentoDoClienteAgregator()
    {
        $cliente1 = $this->getMock('\CodeEducation\Cliente\Cliente', array('getNome'));
        $cliente1
            ->expects($this->any())
            ->method('getNome')
            ->willReturn('Wellington Ribeiro')
        ;

        $cliente2 = $this->getMock('\CodeEducation\Cliente\Cliente', array('getNome'));
        $cliente2
            ->expects($this->any())
            ->method('getNome')
            ->willReturn('Wellington Ribeiro 2')
        ;

        $clAgregator = new ClienteAgregator();
        $clAgregator->addCliente($cliente1);
        $clAgregator->addCliente($cliente2);

        $clientes = $clAgregator->getClientes();

        $this->assertEquals("Wellington Ribeiro", $clientes[0]->getNome());
        $this->assertEquals("Wellington Ribeiro 2", $clientes[1]->getNome());


    }

}