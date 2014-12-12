<?php

namespace CodeEducation\Mail;

class SendMailTest extends \PHPUnit_Framework_TestCase
{
    public function testVerificaSeConsegueEnviarUmEmailMock()
    {
        $sendMail = $this->getMock('\CodeEducation\Mail\SendMail', array('send'));
        $sendMail
            ->expects($this->any())
            ->method('send')
            ->with($this->equalTo('to'),$this->equalTo('subject'),$this->equalTo('msg'))
            ->willReturn(true)
        ;

        $this->assertTrue($sendMail->send('to', 'subject', 'msg'));

    }

    public function testVerificaSeNaoConsegueEnviarUmEmailNoMock()
    {
        $sendMail = new SendMail();

        $this->assertFalse($sendMail->send('to', 'subject', 'msg'));
    }

    public function testVerificaSeNaoConsegueEnviarUmEmail()
    {
        $sendMail = $this->getMock('\CodeEducation\Mail\SendMail', array('send'));
        $sendMail
            ->expects($this->any())
            ->method('send')
            ->with($this->equalTo(false),$this->equalTo(false),$this->equalTo(true))
            ->willReturn(false)
        ;

        $this->assertFalse($sendMail->send(false, false, true));

    }    
}