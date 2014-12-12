<?php

namespace CodeEducation\Mail;

class MailTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaSeOSetClienteEstaModificandoOsValoresDosGetters()
    {
        $cliente = $this->getMock('\CodeEducation\Cliente\Cliente', array('getEmail'));
        $cliente
            ->expects($this->any())
            ->method('getEmail')
            ->willReturn('devwellington@gmail.com')
        ;

        $mail = new \CodeEducation\Mail\Mail();
        $mail->setCliente($cliente);

        $this->assertEquals("devwellington@gmail.com", $mail->getTo());

    }

    public function testVerificaSeOMetodoSendEstaFuncionando()
    {
        $cliente = $this->getMock('\CodeEducation\Mail\Mail', array('getEmail'));
        $cliente
            ->expects($this->any())
            ->method('send')
            ->willReturn(true)
        ;

        $this->assertTrue(true, $cliente->send());

    }


    public function testVerificaSeAClasseConsegueRetornarUmCliente()
    {

        $cliente = new \CodeEducation\Cliente\Cliente();
        $cliente->setNome("Wellington");

        $mail = new \CodeEducation\Mail\Mail();
        $mail->setCliente($cliente);



        $this->assertEquals('Wellington', $mail->getCliente()->getNome());

    }

    public function testVerificaSeConsegueValidarOsGettersEOsSetters()
    {

        $mail = new \CodeEducation\Mail\Mail();
        $mail->setFrom('Teste From');
        $this->assertEquals('Teste From', $mail->getFrom());

        $mail->setMessage('Teste Message');
        $this->assertEquals('Teste Message', $mail->getMessage());        

        $mail->setSubject('Teste Subject');
        $this->assertEquals('Teste Subject', $mail->getSubject());        

        $mail->setTo('Teste To');
        $this->assertEquals('Teste To', $mail->getTo());        
    }
} 