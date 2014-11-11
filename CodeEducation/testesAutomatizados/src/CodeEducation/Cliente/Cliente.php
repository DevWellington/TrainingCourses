<?php

namespace CodeEducation\Cliente;

use Doctrine\Instantiator\Exception\InvalidArgumentException;

class Cliente
{

    private $nome;
    private $email;

    /**
     * @var \CodeEducation\Mail\SendMail
     */
    private $mailTransport;

    public function sendEmail()
    {
        if ($this->mailTransport->send("devwellington@gmail.com", "Assunto", "Mensagem"))
            return true;

        return false;
    }


    /**
     * @return \CodeEducation\Mail\SendMail
     */
    public function getMailTransport()
    {
        return $this->mailTransport;
    }

    /**
     * @param \CodeEducation\Mail\SendMail $mailTransport
     */
    public function setMailTransport($mailTransport)
    {
        $this->mailTransport = $mailTransport;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param $email|InvalidArgumentException
     */
    public function setEmail($email)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            throw new \InvalidArgumentException();

        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * @param mixed $nome
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    }

}