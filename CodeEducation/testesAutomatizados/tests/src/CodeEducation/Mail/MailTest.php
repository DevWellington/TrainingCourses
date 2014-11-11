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

} 