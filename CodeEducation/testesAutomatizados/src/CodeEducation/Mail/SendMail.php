<?php

namespace CodeEducation\Mail;

class SendMail {

    public function send($to, $subject, $message)
    {
        if(mail($to, $subject, $message))
            return true;

        return false;
    }
} 