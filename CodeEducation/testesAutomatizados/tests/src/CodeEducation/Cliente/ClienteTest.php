<?php

namespace CodeEducation\Cliente;

class ClienteTest extends \PHPUnit_Framework_TestCase
{
 
    public function setUp()
    {

    }

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

    public function testVerificaSeNaoConsegueEnviarEmail()
    {

        $mailTransport = $this->getMock('\CodeEducation\Mail\SendMail', array('send'));
        $mailTransport
            ->expects($this->once())
            ->method('send')
            ->willReturn(false)
        ;

        $cliente = new \CodeEducation\Cliente\Cliente();
        $cliente->setMailTransport($mailTransport);

        $this->assertFalse($cliente->sendEmail());
    }    

    public function testVerificaSeGetMailTransportRetornaUmSendMail()
    {

        $mailTransport = $this->getMock('\CodeEducation\Mail\SendMail', array('send'));
        
        $cliente = new Cliente();
        $cliente->setMailTransport($mailTransport);

        $this->assertInstanceOf('\CodeEducation\Mail\SendMail', $cliente->getMailTransport());
    }        

}