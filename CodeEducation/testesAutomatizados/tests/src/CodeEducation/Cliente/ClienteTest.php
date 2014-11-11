<?php

namespace CodeEducation\Cliente;

class ClienteTest extends \PHPUnit_Framework_TestCase
{

    public function testVerificarSeOGetESetNome()
    {
        $cliente = new \CodeEducation\Cliente\Cliente();
        $cliente->setNome("Wellington");

        $this->assertEquals("Wellington", $cliente->getNome());
    }

    public function testVerificarSeOGetESetEmail()
    {
        $cliente = new \CodeEducation\Cliente\Cliente();
        $cliente->setEmail("devwellington@gmail.com");

        $this->assertEquals("devwellington@gmail.com", $cliente->getEmail());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testVerificaSeEmailColocadoEInvalido()
    {
        $cliente = new \CodeEducation\Cliente\Cliente();
        $cliente->setEmail("devwellingtonemail.com");

    }

    public function testVerificaSeConsegueEnviarEmail()
    {

        $mailTransport = $this->getMock('\CodeEducation\Mail\SendMail', array('send'));
        $mailTransport
            ->expects($this->once())
            ->method('send')
            ->willReturn(true)
        ;

        $cliente = new \CodeEducation\Cliente\Cliente();
        $cliente->setMailTransport($mailTransport);

        $this->assertTrue($cliente->sendEmail());
    }

}